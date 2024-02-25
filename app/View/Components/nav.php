<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class nav extends Component
{

    public $items;
    // public $active;
    
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items = $this->prepareItem(config('nav'));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav');
    }

    public function prepareItem($navItem) {

        $user = Auth::user();
        foreach($navItem as $key => $item) {
            if(isset($item['ability']) && !$user->can($item['ability'])) {
                unset($item[$key]);

            }
        }

        return $navItem;
    }
}
