<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return view('layouts.app');
    }
}
