<?php

namespace App\Livewire\Admin;

use App\Models\Artifact;
use App\Models\Contributor;
use App\Models\VisitorRecord;
use App\Models\User;
use App\Models\Visitor;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $total_visits;
    public $daily_visits;
    public $artifacts_count;
    public $contributors_count;
    public $monthly_visitors = []; // Array to store visitors per month
    public $months = []; // Array to store month labels
    public $top_municipalities = [];

    public function mount()
    {
        //$user = auth()->user();
        
        $this->daily_visits = VisitorRecord::whereDate('created_at', today())
            ->whereNotNull('approved_by')
            ->count();

        $this->total_visits = VisitorRecord::whereNotNull('approved_by')->count();

        $this->artifacts_count = Artifact::count();

        $this->contributors_count = Contributor::whereHas('artifact', function ($q) {
            $q->where('status', 'Approved');
        })->count();

        // Fetch visitor count per month for the last 12 months
        $this->monthly_visitors = VisitorRecord::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereNotNull('approved_by')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // // Format months as labels (Jan, Feb, Mar, etc.)
        for ($i = 1; $i <= 12; $i++) {
            $this->months[] = Carbon::create()->month($i)->format('M');
            $this->monthly_visitors[$i] = $this->monthly_visitors[$i] ?? 0;
        }

        // Sort by month
        ksort($this->monthly_visitors);

        // Query the top 10 municipalities (cities) with the most visitors
        $this->top_municipalities = Visitor::select('city', DB::raw('COUNT(*) as count'))
            ->groupBy('city')
            ->orderByDesc('count')
            ->limit(10)
            ->get();
    }

    public function render()
    {

        return view('livewire.admin.dashboard');
    }
}
