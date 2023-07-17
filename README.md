# Laravel Ticket System
A simple helpdesk ticketing system for Laravel 5.1+ (5.1 – 5.8 and 6.* - 7.* - 8.* - 9.* - 10.*) which integrates smoothly with Laravel default users and auth system. 
It will integrate into your current Laravel project within minutes, and you can offer your customers and your team a nice and simple support ticket system. 

## Features:
1. Three main users roles users, agents, and admins
2. Users can create tickets, keep track of their tickets status, giving comments, and close their own tickets (access permissions are configurable)
3. Auto assigning agents to tickets, the system searches for agents in specific department and auto select the agent with lowest queue
4. Simple admin panel 
5. Localization (Arabic, Brazilian Portuguese, Deutsch (German), English, Farsi, French, Hungarian, Italian, Persian, Russian, and Spanish language packs are included)
6. Very simple installation and integration process
7. Admin dashboard with statistics and performance tracking graphs
8. Simple text editor for tickets descriptions and comments allows images upload

## Quick Installation:

### Requirements
**First Make sure you have got this Laravel setup working:**

1. [Laravel](http://laravel.com/docs#installation)
2. [Users table](http://laravel.com/docs/authentication)
3. [Laravel email configuration](http://laravel.com/docs/mail#sending-mail)
4. Bootstrap 3, or Bootstrap 4
5. Jquery

**Dependencies that are getting installed and configured automatically by LaravelTicket (no action required from you)**

1. [Spatie HTML](https://github.com/spatie/laravel-html)
2. [Laravel Datatables v1.13.4](https://github.com/yajra/laravel-datatables)
3. [HTML Purifier](https://github.com/mewebstudio/Purifier)

### Installation steps (<5 minutes)

Step 1. Run this code via your terminal
```shell
composer require 'binshops/laravel-ticket'
```

Step 2. After installing the package, you have to add this line on your `config/app.php` in Service Providers section.
```
Binshops\LaravelTicket\LaravelTicketServiceProvider::class
```

Step 3. Check if App\Models exists

Step 4. Make sure you have [authentication](https://laravel.com/docs/10.x/authentication) set up. In 5.2+, you can use `php artisan make:auth`

Step 5. [Setting up your master view for LaravelTicket integration](#integrating-laravel-ticket-views-with-your-project-template)

Step 6. Register at least one user into the system and log it in.

Step 7. Go ahead to http://your-project-url/tickets-install to finalize the installation.

Default laravel-ticket front route: http://your-project-url/tickets

Default laravel-ticket admin route: http://your-project-url/tickets-admin

**Notes:**

Make sure you have created at least one status, one priority, and one category before you start creating tickets.

If you move your installation folder to another path (or server), you need to update the row with slug='routes' in table `laravelticketsettings`. After that, don't forget to flush the entire cache.

## Documentation
[LaravelTicket Wiki](https://github.com/binshops/laravel-ticket/wiki)

## Integrating Laravel Ticket views with your project template

### Configuring the master view
Laravel Ticket views system is developed to integrate with the current project master view (Laravel Ticket uses Bootstrap framework). The master view file is the main view file that is using "yield" to call header, content, footer sections. It should be located at resources/views (ex. `resources/views/layouts/master.blade.php`), open it and make sure it yields for page, content, and footer.

@yield('page') Page section for passing the current page title
```html
<head> ...
<title>My website - @yield('page')</title>
</head>
```

@yield('content') Content section for the content
```html
<body> ...
@yield('content')
...
</body>
```

@yield('footer') Footer section for passing the jquery scripts, so make sure it is called after you call the jquery
```html
<body> ...
@yield('content')
...
<script src="/js/jquery.min.js"></script>
..
@yield('footer')
</body>
```

Here's a [quick example](https://github.com/binshops/laravel-ticket/tree/master/src/Views/sample-app.blade.php) of a layout file.
