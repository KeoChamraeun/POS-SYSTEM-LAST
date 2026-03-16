<?php

namespace App\Livewire\Accounting\FixedAssets;

use Livewire\Component;

class FixedAssetList extends Component
{
    public function render()
    {
        return view('livewire.accounting.fixed-assets.fixed-asset-list');
    }

    public function add_new_asset()
    {
        return redirect(route('purchasing-create'));
    }
}
