<?php

namespace App\Livewire\Management\Branches;

use Livewire\Component;
use App\Models\Branch;
use Livewire\WithPagination;

class BranchList extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = [
        'refresh-branches' => '$refresh',
    ];

    public function openCreateBranchModal()
    {
        $this->dispatch('open-create-branch-modal');
    }

    public function editBranch($branchId)
    {
        $this->dispatch('open-update-branch-modal', branchId: $branchId);
    }

    public function render()
    {
        $branches = Branch::query()
            ->when($this->search, function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('code', 'like', "%{$this->search}%")
                  ->orWhere('phone', 'like', "%{$this->search}%")
                  ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(10);

        return view('livewire.management.branches.branch-list', [
            'branches' => $branches,
        ]);
    }
}