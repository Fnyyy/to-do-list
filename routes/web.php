<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Notifications
    Route::get('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::get('/notifications/read-all', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');

    // Test Notification Route
    Route::get('/test-notification', function () {
        $user = Auth::user();

        // 1. Task Assigned (Existing)
        $task = new \stdClass();
        $task->id = rand(100, 999);
        $task->title = 'Review Q3 Financial Reports';
        $task->project_id = 1;
        $user->notify(new \App\Notifications\TaskAssigned($task));

        // 2. Project Access (Success)
        $user->notify(new \App\Notifications\SimpleNotification(
            'Project Access Granted',
            'You have been added to the "Website Redesign" project team.',
            'success',
            route('projects.index')
        ));

        // 3. System Alert (Warning)
        $user->notify(new \App\Notifications\SimpleNotification(
            'System Maintenance',
            'Scheduled maintenance will occur on Saturday at 2:00 AM UTC. Please save your work.',
            'warning',
            '#'
        ));

        // 4. New Comment (Info)
        $user->notify(new \App\Notifications\SimpleNotification(
            'New Comment',
            'Sarah left a comment on "Homepage Hero Section".',
            'info',
            '#'
        ));

        return back()->with('success', 'Test notifications sent!');
    })->name('notifications.test');

    // Projects
    Route::resource('projects', ProjectController::class);

    // Tasks (Nested in Projects or Standalone handling)
    Route::post('/projects/{project}/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';