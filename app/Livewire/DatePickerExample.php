<?php

namespace App\Livewire;

use Livewire\Component;

class DatePickerExample extends Component
{

    public $date;
    public function render()
    {
        return view('livewire.date-picker-example');
    }
}
