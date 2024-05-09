<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TrendMoviesCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $Trendmovie;
    public $genres;
    public $genrestv;

    public function __construct($Trendmovie, $genres, $genrestv)
    {
        $this->Trendmovie = $Trendmovie;
        $this->genres = $genres;
        $this->genrestv = $genrestv;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.trend-movies-card');
    }
}
