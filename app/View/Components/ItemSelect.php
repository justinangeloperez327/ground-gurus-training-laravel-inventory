<?php

namespace App\View\Components;

use App\Models\Item;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ItemSelect extends Component
{
    public $options;

    public function __construct()
    {
        $this->options = Item::all()->pluck('name', 'id')->toArray();
    }

    public function render()
    {
        return view('components.item-select');
    }
}
