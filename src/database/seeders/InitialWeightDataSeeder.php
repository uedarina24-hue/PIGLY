<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WeightTarget;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class InitialWeightDataSeeder extends Seeder
{

    public function run()
    {
        $user = User::create([
            'name' => '山田 太郎',
            'email' => 'yamada.tarou@example.com',
            'password' => Hash::make('password123'),
        ]);

        WeightTarget::create([
            'user_id' => $user->id,
            'target_weight' => 60.0,
        ]);

        WeightLog::factory()
            ->count(35)
            ->create([
                'user_id' => $user->id,
            ]);

    }
}
