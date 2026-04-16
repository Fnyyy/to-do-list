<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Workspace;
use App\Models\Project;
use App\Models\Task;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Demo User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $workspace = Workspace::create([
            'name' => 'HQ Workspace',
            'slug' => 'hq-workspace',
            'owner_id' => $user->id,
            'description' => 'Main workspace for company operations.'
        ]);

        $projects = [
            ['name' => 'Website Redesign', 'status' => 'active', 'due_date' => now()->addDays(30)],
            ['name' => 'Q1 Marketing', 'status' => 'in_progress', 'due_date' => now()->addDays(15)],
            ['name' => 'Mobile App Launch', 'status' => 'active', 'due_date' => now()->addDays(60)],
        ];

        foreach ($projects as $projData) {
            $project = Project::create([
                'name' => $projData['name'],
                'description' => 'Detailed project plan for ' . $projData['name'],
                'status' => 'active',
                'due_date' => $projData['due_date'],
                'workspace_id' => $workspace->id,
                'user_id' => $user->id,
            ]);

            Task::create(['title' => 'Initial Planning', 'status' => 'done', 'priority' => 'high', 'project_id' => $project->id, 'assigned_to' => $user->id]);
            Task::create(['title' => 'Design Mockups', 'status' => 'in_progress', 'priority' => 'medium', 'project_id' => $project->id, 'assigned_to' => $user->id]);
            Task::create(['title' => 'Client Review', 'status' => 'todo', 'priority' => 'urgent', 'project_id' => $project->id, 'assigned_to' => $user->id]);
        }
    }
}
