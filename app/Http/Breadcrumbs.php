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
Breadcrumbs::register('products', function($breadcrumbs, $id)
{
    $page = \App\Http\Models\Categorie::findOrFail($id);
    $breadcrumbs->parent('categories');
    $breadcrumbs->push($page->name, route('products', ['id' =>$page->id]));
});

//Home > shoppingcart
Breadcrumbs::register('shoppingcart', function($breadcrumbs)
{
    $breadcrumbs->parent('categories');
    $breadcrumbs->push('Shopping cart', route('shoppingcart'));

});

//Home > shoppingcart >checkout
Breadcrumbs::register('checkout', function($breadcrumbs)
{
    $breadcrumbs->parent('categories');
    $breadcrumbs->push('Shopping cart', route('shoppingcart'));
    $breadcrumbs->push('Check out', route('checkout'));

});

