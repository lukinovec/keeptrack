<?php

namespace Database\Seeders;

use App\Classes\Type;
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
        foreach (
            [
                Type::new("movie")->change("in_progress", "Watching")->change("planning", "Plan to Watch"),
                Type::new("book")->change("in_progress", "Reading")->change("planning", "Plan to Read"),
            ]
         as $status) {
            DB::table('statuses')->insert((array) $status);
        }
    }
}
