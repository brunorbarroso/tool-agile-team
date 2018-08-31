<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collaborator = Role::create([
            'name' => 'Collaborator', 
            'slug' => 'collaborator',
            'permissions' => json_encode([
                'view-score' => true,
            ])
        ]);
        
        $coordinator = Role::create([
            'name' => 'Coordinator', 
            'slug' => 'coordinator',
            'permissions' => json_encode([
                'create-task' => true,
                'update-task' => true,
                'view-task' => true,
                'destroy-task' => true,

                'create-parameter' => true,
                'update-parameter' => true,
                'view-parameter' => true,
                'destroy-parameter' => true,
            ])
        ]);

        $administrator = Role::create([
            'name' => 'Administrator', 
            'slug' => 'administrator',
            'permissions' => json_encode([
                'create-task' => true,
                'update-task' => true,
                'view-task' => true,
                'destroy-task' => true,

                'create-user' => true,
                'update-user' => true,
                'view-user' => true,
                'destroy-user' => true,

                'create-parameter' => true,
                'update-parameter' => true,
                'view-parameter' => true,
                'destroy-parameter' => true,
            ])
        ]);
    }
}
