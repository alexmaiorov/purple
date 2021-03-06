<?php

namespace App\View\Components\Header;

use Illuminate\View\Component;

class ControlBlock extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->requstedFriendships = auth()->user()->requestedFriendships;
    }

    public function isRequested(){
        return $this->requstedFriendships->count() > 0;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.header.control-block', ['requestedFriendships' => $this->requstedFriendships]);
    }
}
