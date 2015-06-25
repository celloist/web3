<?php
/**
 * @author Alhric Lacle <alhriclacle@gmail.com>
 * @project Web3
 * @created 25-Jun-15 11:21 AM
 */


// Home
Breadcrumbs::register('categories', function($breadcrumbs)
{
    $breadcrumbs->push('Categories', route('categories'));
});

// Home > About
Breadcrumbs::register('about', function($breadcrumbs)
{
    $breadcrumbs->parent('categories');
    $breadcrumbs->push('About', route('about'));
});

Breadcrumbs::register('policy', function($breadcrumbs)
{
    $breadcrumbs->parent('categories');
    $breadcrumbs->push('Policy', route('policy'));
});

// Home > Contact
Breadcrumbs::register('contact', function($breadcrumbs)
{
    $breadcrumbs->parent('categories');
    $breadcrumbs->push('Contact', route('contact'));
});


// Home > Blog > [Category] > [Page]
Breadcrumbs::register('product', function($breadcrumbs, $page)
{
    $breadcrumbs->parent('categories', $page->category);
    $breadcrumbs->push($page->title, route('categories{id}', $page->id));
});
