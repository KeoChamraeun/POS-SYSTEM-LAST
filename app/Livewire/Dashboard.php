<?php

namespace App\Livewire;

use App\Models\StaffMovement;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public $start_date;
    public $end_date;
    public $month;

    public $staffCount;
    public $lastMonthStaffCount;
    public $staffPercent;

    public function mount()
    {
        $this->month = now()->format('Y-m');
    }

    public function render()
    {
        $date = Carbon::createFromFormat('Y-m', $this->month);

        // Current month
        $currentStart = $date->copy()->startOfMonth();
        $currentEnd = $date->copy()->endOfMonth();

        // Previous month
        $previousStart = $date->copy()->subMonth()->startOfMonth();
        $previousEnd = $date->copy()->subMonth()->endOfMonth();
        $this->staffCount = StaffMovement::whereBetween(
            'joined_date',
            [$currentStart, $currentEnd]
        )->count();

        $this->lastMonthStaffCount = StaffMovement::whereBetween(
            'joined_date',
            [$previousStart, $previousEnd]
        )->count();
        if ($this->lastMonthStaffCount > 0) {
            $this->staffPercent = round(
                (($this->staffCount - $this->lastMonthStaffCount) / $this->lastMonthStaffCount) * 100,
                2
            );
        } else {
            $this->staffPercent = $this->staffCount > 0 ? 100 : 0;
        }

        return view('livewire.dashboard')
            ->title('Fixed Assets | Dashboard');
    }
}
