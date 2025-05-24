<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Client;
use App\Models\Project;
use App\Models\Invoice;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create 3 users
        $users = User::factory()->count(3)->create();

        // For each user, create multiple clients and projects and invoices
        $users->each(function ($user) {
            $clients = Client::factory()
                ->count(3)
                ->create(['user_id' => $user->id]);

            $clients->each(function ($client) {
                $projects = Project::factory()
                    ->count(rand(4, 10))
                    ->create(['client_id' => $client->id]);

                $projects->each(function ($project) use ($client) {
                    Invoice::factory()
                        ->create([
                            'client_id' => $client->id,
                            'project_id' => $project->id,
                            'amount' => $project->rate * $project->total_hours,
                        ]);
                });
            });
        });
    }
}
