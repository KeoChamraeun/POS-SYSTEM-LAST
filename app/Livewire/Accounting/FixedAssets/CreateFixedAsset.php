<?php

namespace App\Livewire\Accounting\FixedAssets;

use Livewire\Component;

class CreateFixedAsset extends Component
{
    public $type = 1;

    public function updatedType($value)
    {
        if ($value == 1) {
            $this->type = $value;
        } else {
            $this->type = $value;
        }
    }

    public function mount()
    {
        $this->type = $this->type;
    }

    public function render()
    {
        return view('livewire.accounting.fixed-assets.create-fixed-asset');
    }
}