<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    /* ------------------------------------   Admin Login    ------------------------------------ */
    $routes->add('admin_login', '/login')
        ->controller([\App\Controller\SecurityController::class, 'login'])
        ->methods(['GET', 'POST']);

    $routes->add('logout', '/logout')
        ->methods(['GET']);

    /* ------------------------------------   Admin Area    ------------------------------------ */
    $routes->add('admin_dashboard', '/admin/dashboard')
        ->controller([\App\Controller\Admin\DashboardController::class, 'index'])
        ->methods(['GET']);
};