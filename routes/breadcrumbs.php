<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > Parse
Breadcrumbs::for('parse', function ($trail) {
    $trail->parent('home');
    $trail->push('Parse', route('parse'));
});

// Home > Parse > [Category]
Breadcrumbs::for('category', function ($trail) {
    $trail->parent('parse');
    $trail->push('Category', route('category'));
});

// Home > Parse > [Manufacturer]
Breadcrumbs::for('manufacturer', function ($trail) {
    $trail->parent('parse');
    $trail->push('Manufacturer', route('manufacturer'));
});

// Home > Parse > [Product]
Breadcrumbs::for('product', function ($trail) {
    $trail->parent('parse');
    $trail->push('Product', route('product'));
});

// Home > Parse > [Subcategory]
Breadcrumbs::for('subcategory', function ($trail) {
    $trail->parent('parse');
    $trail->push('Subcategory', route('subcategory'));
});

// Home > Configurations
Breadcrumbs::for('configurations', function ($trail) {
    $trail->parent('home');
    $trail->push('Configurations', route('configurations'));
});

// Home > Logs
Breadcrumbs::for('logs', function ($trail) {
    $trail->parent('home');
    $trail->push('Logs', route('logs'));
});

// Home > Statistics
Breadcrumbs::for('statistics', function ($trail) {
    $trail->parent('home');
    $trail->push('Statistics', route('statistics'));
});