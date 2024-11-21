<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', url('/'));
});

// Home > documents.offer
Breadcrumbs::for('documents', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Документы', route('documents'));
});

// Home > documents.offer
Breadcrumbs::for('documents.offer', function (BreadcrumbTrail $trail) {
    $trail->parent('documents');
    $trail->push('Оферта', route('documents.offer'));
});

// Home > documents.contract
Breadcrumbs::for('documents.contract', function (BreadcrumbTrail $trail) {
    $trail->parent('documents');
    $trail->push('Договор', route('documents.contract'));
});

// Home > documents.agreement
Breadcrumbs::for('documents.agreement', function (BreadcrumbTrail $trail) {
    $trail->parent('documents');
    $trail->push('Соглашение на обработку персональных данных', route('documents.agreement'));
});

// Home > Blog > [Category]
Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('offer');
    $trail->push($category, route('category', $category));
});