<?php

namespace Binshops\LaravelTicket\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Binshops\LaravelTicket\Models\Agent;
use Binshops\LaravelTicket\Models\Setting;
use Binshops\LaravelTicket\Seeds\SettingsTableSeeder;
use Binshops\LaravelTicket\Seeds\LaravelTicketTableSeeder;

class InstallController extends Controller
{
    public $migrations_tables = [];

    public function __construct()
    {
        $migrations = \File::files(dirname(dirname(__FILE__)).'/Migrations');
        foreach ($migrations as $migration) {
            $this->migrations_tables[] = basename($migration, '.php');
        }
    }

    public function publicAssets()
    {
        $public = $this->allFilesList(public_path('vendor/laravelticket'));
        $assets = $this->allFilesList(base_path('vendor/binshops/laravel-ticket/src/Public'));
        if ($public !== $assets) {
            Artisan::call('vendor:publish', [
                '--provider' => 'Binshops\\LaravelTicket\\LaravelTicketServiceProvider',
                '--tag'      => ['public'],
            ]);
        }
    }

    /*
     * Initial install form
     */

    public function index()
    {
        // if all migrations are not yet installed or missing settings table,
        // then start the initial install with admin and master template choices
        if (count($this->migrations_tables) == count($this->inactiveMigrations())
            || in_array('2015_10_08_123457_create_settings_table', $this->inactiveMigrations())
        ) {
            $views_files_list = $this->viewsFilesList(resource_path('views')) + ['another' => trans('laravelticket::install.another-file')];
            $inactive_migrations = $this->inactiveMigrations();
            // if Laravel v5.2 or 5.3
            if (version_compare(app()->version(), '5.2.0', '>=')) {
                $users_list = User::pluck('name', 'id')->toArray();
            } else { // if Laravel v5.1
                $users_list = User::lists('name', 'id')->toArray();
            }

            return view('laravelticket::install.index', compact('views_files_list', 'inactive_migrations', 'users_list'));
        }

        // other than that, Upgrade to a new version, installing new migrations and new settings slugs
        if (Agent::isAdmin()) {
            $inactive_migrations = $this->inactiveMigrations();
            $inactive_settings = $this->inactiveSettings();

            return view('laravelticket::install.upgrade', compact('inactive_migrations', 'inactive_settings'));
        }
        \Log::emergency('LaravelTicket needs upgrade, admin should login and visit laravelticket-install to activate the upgrade');

        throw new \Exception('LaravelTicket needs upgrade, admin should login and visit laravelticket install route');
    }

    /*
     * Do all pre-requested setup
     */

    public function setup(Request $request)
    {
        $master = $request->master;
        if ($master == 'another') {
            $another_file = $request->other_path;
            $views_content = strstr(substr(strstr($another_file, 'views/'), 6), '.blade.php', true);
            $master = str_replace('/', '.', $views_content);
        }
        $this->initialSettings($master);
        $admin_id = $request->admin_id;
        $admin = User::find($admin_id);
        $admin->laravelticket_admin = true;
        $admin->save();

        return redirect('/'.Setting::grab('main_route'));
    }

    /*
     * Do version upgrade
     */

    public function upgrade()
    {
        if (Agent::isAdmin()) {
            $this->initialSettings();

            return redirect('/'.Setting::grab('main_route'));
        }
        \Log::emergency('LaravelTicket upgrade path access: Only admin is allowed to upgrade');

        throw new \Exception('LaravelTicket upgrade path access: Only admin is allowed to upgrade');
    }

    /*
     * Initial installer to install migrations, seed default settings, and configure the master_template
     */

    public function initialSettings($master = false)
    {
        $inactive_migrations = $this->inactiveMigrations();
        if ($inactive_migrations) { // If a migration is missing, do the migrate
            Artisan::call('vendor:publish', [
                '--provider' => 'Binshops\\LaravelTicket\\LaravelTicketServiceProvider',
                '--tag'      => ['db'],
            ]);
            Artisan::call('migrate');

            $this->settingsSeeder($master);

            // if this is the first install of the html editor, seed old posts text to the new html column
            if (in_array('2016_01_15_002617_add_htmlcontent_to_laravelticket_and_comments', $inactive_migrations) &&
                !(isset($_SERVER['ARTISAN_LARAVELTICKET_INSTALLING']) && $_SERVER['ARTISAN_LARAVELTICKET_INSTALLING'])) {
                Artisan::call('laravelticket:htmlify');
            }
        } elseif ($this->inactiveSettings()) { // new settings to be installed

            $this->settingsSeeder($master);
        }
        \Cache::forget('laravelticket::settings');
    }

    /**
     * Run the settings table seeder.
     *
     * @param string $master
     */
    public function settingsSeeder($master = false)
    {
        $cli_path = 'config/laravelticket.php'; // if seeder run from cli, use the cli path
        $provider_path = '../config/laravelticket.php'; // if seeder run from provider, use the provider path
        $config_settings = [];
        $settings_file_path = false;
        if (File::isFile($cli_path)) {
            $settings_file_path = $cli_path;
        } elseif (File::isFile($provider_path)) {
            $settings_file_path = $provider_path;
        }
        if ($settings_file_path) {
            $config_settings = include $settings_file_path;
            File::move($settings_file_path, $settings_file_path.'.backup');
        }
        $seeder = new SettingsTableSeeder();
        if ($master) {
            $config_settings['master_template'] = $master;
        }
        $seeder->config = $config_settings;
        $seeder->run();
    }

    /**
     * Get list of all files in the views folder.
     *
     * @return mixed
     */
    public function viewsFilesList($dir_path)
    {
        $dir_files = File::files($dir_path);
        $files = [];
        foreach ($dir_files as $file) {
            $path = basename($file);
            $name = strstr(basename($file), '.', true);
            $files[$name] = $path;
        }

        return $files;
    }

    /**
     * Get list of all files in the views folder.
     *
     * @return mixed
     */
    public function allFilesList($dir_path)
    {
        $files = [];
        if (File::exists($dir_path)) {
            $dir_files = File::allFiles($dir_path);
            foreach ($dir_files as $file) {
                $path = basename($file);
                $name = strstr(basename($file), '.', true);
                $files[$name] = $path;
            }
        }

        return $files;
    }

    /**
     * Get all LaravelTicket Package migrations that were not migrated.
     *
     * @return array
     */
    public function inactiveMigrations()
    {
        $inactiveMigrations = [];
        $migration_arr = [];

        // Package Migrations
        $tables = $this->migrations_tables;

        // Application active migrations
        $migrations = DB::select('select * from '.DB::getTablePrefix().'migrations');

        foreach ($migrations as $migration_parent) { // Count active package migrations
            $migration_arr[] = $migration_parent->migration;
        }

        foreach ($tables as $table) {
            if (!in_array($table, $migration_arr)) {
                $inactiveMigrations[] = $table;
            }
        }

        return $inactiveMigrations;
    }

    /**
     * Check if all LaravelTicket Package settings that were not installed to setting table.
     *
     * @return bool
     */
    public function inactiveSettings()
    {
        $seeder = new SettingsTableSeeder();

        // Package Settings
        // if Laravel v5.2 or 5.3
        if (version_compare(app()->version(), '5.2.0', '>=')) {
            $installed_settings = DB::table('laravelticket_settings')->pluck('value', 'slug');
        } else { // if Laravel 5.1
            $installed_settings = DB::table('laravelticket_settings')->lists('value', 'slug');
        }

        if (!is_array($installed_settings)) {
            $installed_settings = $installed_settings->toArray();
        }

        // Application active migrations
        $default_Settings = $seeder->getDefaults();

        if (count($installed_settings) == count($default_Settings)) {
            return false;
        }

        $inactive_settings = array_diff_key($default_Settings, $installed_settings);

        return $inactive_settings;
    }

    /**
     * Generate demo users, agents, and tickets.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function demoDataSeeder()
    {
        $seeder = new LaravelTicketTableSeeder();
        $seeder->run();
        session()->flash('status', 'Demo tickets, users, and agents are seeded!');

        return redirect()->route(Setting::grab('main_route') . '.index');
    }
}
