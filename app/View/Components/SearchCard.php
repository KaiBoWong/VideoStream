<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $smovie;
    public $genres;
    public $genrestv;

    public function __construct($smovie, $genres, $genrestv)
    {
        $this->smovie = $smovie;
        $this->genres = $genres;
        $this->genrestv = $genrestv;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-card');
    }
}
