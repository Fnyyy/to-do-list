<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'projects' => \App\Models\Project::where('user_id', $user->id)->where('status', 'active')->count(),
            'pending_tasks' => \App\Models\Task::where('assigned_to', $user->id)->whereIn('status', ['todo', 'in_progress'])->count(),
            'upcoming_deadlines' => \App\Models\Task::where('assigned_to', $user->id)
                ->whereNotNull('due_date')
                ->whereBetween('due_date', [now(), now()->addDays(7)])
                ->count(),
        ];

        $recentProjects = \App\Models\Project::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', [
            'stats' => $stats,
            'recentProjects' => $recentProjects,
        ]);
    }
}
