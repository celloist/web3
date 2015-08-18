<?php
/**
 * @author Alhric Lacle <alhriclacle@gmail.com>
 * @project Web3
 * @created 24-Jun-15 1:15 PM
 */

namespace App\Http\ViewComposers;

use App\Http\Models\Navigation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Requests;

class MenuComposer {

    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $menus = Navigation::allSorted()->get();

        if(session('pCount')==null)
        {
            $pCount = 0;
        }
        else
        {
            $pCount = session('pCount');
        }

        $view->with('menus', $menus)->with('pCount',$pCount);
    }

}