<?php

    return [
        [
            'icon' => 'fas fa-th nav-icon', 
            'route' => 'dashboard.dashboard',
            'title' => 'Dashboard', 
            'active' => 'dashboard.dashboard',
        ],

        [
            'icon' => 'fas fa-tags nav-icon', 
            'route' => 'dashboard.category.index',
            'title' => 'Category', 
            'badge' => 'new badge',
            'active' => 'dashboard.category.*',
            'ability' => 'category.view',
        ],

        [
            'icon' => 'fas fa-box nav-icon', 
            'route' => 'dashboard.products.index',
            'title' => 'Products', 
            'badge' => 'new badge',
            'active' => 'dashboard.products.*',
            'ability' => 'product.view',
        ],

        [
            'icon' => 'fas fa-shield nav-icon ', 
            'route' => 'dashboard.roles.index',
            'title' => 'Roles', 
            'active' => 'dashboard.roles.*',
            // 'ability' => 'product.view',
        ],

        // [
        //     'icon' => 'fas fa-users nav-icon', 
        //     'route' => 'dashboard.users.index',
        //     'title' => 'Users', 
        //     'badge' => 'new badge',
        //     'active' => 'dashboard.users.*',
        //     'ability' => 'user.view',
        // ],

        [
            'icon' => 'fas fa-users nav-icon', 
            'route' => 'dashboard.admins.index',
            'title' => 'Admins', 
            'badge' => 'new badge',
            'active' => 'dashboard.admins.*',
            'ability' => 'admin.view',
        ],

    ];

