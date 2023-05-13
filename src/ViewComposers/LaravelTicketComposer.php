<?php

namespace Binshops\LaravelTicket\ViewComposers;

use Binshops\LaravelTicket\Controllers\ToolsController;
use Binshops\LaravelTicket\Helpers\EditorLocale;
use Binshops\LaravelTicket\Models\Agent;
use Binshops\LaravelTicket\Models\Setting;

class LaravelTicketComposer
{
    public static function settings(&$u)
    {
        view()->composer('laravelticket::*', function ($view) use (&$u) {
            if (auth()->check()) {
                if ($u === null) {
                    $u = Agent::find(auth()->user()->id);
                }
                $view->with('u', $u);
            }
            $setting = new Setting();
            $view->with('setting', $setting);
        });
    }

    public static function general()
    {
        // Passing to views the master view value from the setting file
        view()->composer('laravelticket::*', function ($view) {
            $tools = new ToolsController();
            $master = Setting::grab('master_template');
            $email = Setting::grab('email.template');
            $view->with(compact('master', 'email', 'tools'));
        });
    }

    public static function codeMirror()
    {
        // Passing to views the master view value from the setting file
        view()->composer('laravelticket::*', function ($view) {
            $editor_enabled = Setting::grab('editor_enabled');
            $codemirror_enabled = Setting::grab('editor_html_highlighter');
            $codemirror_theme = Setting::grab('codemirror_theme');
            $view->with(compact('editor_enabled', 'codemirror_enabled', 'codemirror_theme'));
        });
    }

    public static function summerNotes()
    {
        view()->composer('laravelticket::tickets.partials.summernote', function ($view) {

            $editor_locale = EditorLocale::getEditorLocale();
            $editor_options = file_get_contents(base_path(Setting::grab('summernote_options_json_file')));

            $view->with(compact('editor_locale', 'editor_options'));
        });
    }

    public static function sharedAssets()
    {
        //inlude font awesome css or not
        view()->composer('laravelticket::shared.assets', function ($view) {
            $include_font_awesome = Setting::grab('include_font_awesome');
            $view->with(compact('include_font_awesome'));
        });
    }
}
