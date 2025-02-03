<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Domain;
use Illuminate\Support\Facades\DB;

class DashboardStats extends Component
{
    public $userCount;
    public $activeDomains;
    public $expiringDomains;
    public $lastUpdated;

    protected $listeners = ['refreshStats' => '$refresh'];

    public function mount()
    {
        $this->lastUpdated = now();
        $this->loadStats();
    }

    public function loadStats()
    {
        $this->userCount = User::count();
        $this->activeDomains = Domain::count();
        $this->expiringDomains = Domain::where('expires_date', '<', now()->addDays(30))->count();
        $this->lastUpdated = now();
    }

    public function render()
    {
        $this->loadStats();
        return view('livewire.pages.dashboard.dashboard-stats');
    }
}
