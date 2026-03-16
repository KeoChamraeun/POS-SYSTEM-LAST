<?php

namespace App\Livewire\Users;

use Livewire\Component;

class ManageUser extends Component
{
    public $action  = 'list';
    public function render()
    {
        return view('livewire.users.manage-user')->title("User - " . ucfirst($this->action));;
    }
    public function mount($slug)
    {
        $this->action = $slug;
    }
}
