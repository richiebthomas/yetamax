<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load the JSON file
        $json = File::get(database_path('seeders/users.json'));
        
        // Decode the JSON data
        $users = json_decode($json, true);
        
        // Map the JSON keys to the database column names
        $users = array_map(function($user) {
            return [
                'name' => $user['name'],
                'email' => $user['email'],
                'roll_no' => $user['rollNumber']
            ];
        }, $users);
        
        // Insert the data into the users table
        DB::table('users')->insert($users);
    }
}
