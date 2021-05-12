<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GuestLayout extends Component
{
    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return view('layouts.guest');
    }
}
