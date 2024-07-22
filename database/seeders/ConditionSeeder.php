<?php

namespace Database\Seeders;

use App\Models\Condition;
use Illuminate\Database\Seeder;

class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conditions = ["Later","Reading","Done"];

        foreach($conditions as $condition)
            Condition::create([
                "name" => $condition
            ]);
    }
}
