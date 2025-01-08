<?php

namespace App\Livewire;

use Livewire\Component;

class Activity extends Component
{
    public $headers = ['Name', 'Email', 'Role'];
    public $rows = [
        ['John Doe', 'johndoe@example.com', 'Admin'],
        ['Jane Smith', 'janesmith@example.com', 'Attendee'],
        ['Bob Johnson', 'bobjohnson@example.com', 'Organizer'],
    ];

    public function render()
    {
        return view('livewire.activity');
    }
}
