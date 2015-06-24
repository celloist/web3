<?php
/**
 * @author Alhric Lacle <alhriclacle@gmail.com>
 * @project Web3
 * @created 24-Jun-15 1:15 PM
 */

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class MenuComposer {

    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    $menus = Navigation::all();

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        // Dependencies automatically resolved by service container...
        $this->users = $users;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('count', $this->users->count());
    }

}