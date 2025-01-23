<?php

namespace App\Livewire;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SideBar extends Component
{

    public $user_role;

    public function mount(){
        $this->user_role = Auth::user()->role;
    }

        /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.side-bar');
    }
}