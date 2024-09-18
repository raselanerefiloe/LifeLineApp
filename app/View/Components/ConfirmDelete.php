<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmDelete extends Component
{
    public $title;
    public $message;
    public $action;
    public $triggerText;

    public function __construct($title, $message, $action, $triggerText)
    {
        $this->title = $title;
        $this->message = $message;
        $this->action = $action;
        $this->triggerText = $triggerText;
    }

    public function render()
    {
        return view('components.confirm-delete');
    }
}
