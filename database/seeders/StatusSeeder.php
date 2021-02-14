<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Pro přidání nového statusu přidejte do $statuses pole podle vzoru a přepište hodnoty podle potřeby
         */
        $statuses = [
            [
                "type" => "movie",
                "planning" => "Plan to Watch",
                "completed" => "Completed",
                "in_progress" => "Watching",
                "none" => "None"
            ],

            [
                "type" => "book",
                "planning" => "Plan to Read",
                "completed" => "Completed",
                "in_progress" => "Reading",
                "none" => "None"
             ]
        ];
        foreach ($statuses as $status) {
            DB::table('statuses')->insert($status);
        }
    }
}
