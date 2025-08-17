<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchBar extends Component
{
    public $buttonId;
    public $buttonText;
    public $tabId;

    /**
     * Create a new component instance.
     */
    public function __construct($buttonId = 'search-button', $buttonText = 'Tìm kiếm', $tabId = 'nha-dat-ban')
    {
        $this->buttonId = $buttonId;
        $this->buttonText = $buttonText;
        $this->tabId = $tabId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-bar');
    }
}
