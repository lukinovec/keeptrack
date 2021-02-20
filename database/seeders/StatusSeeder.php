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
            // Pro přidání nového typu do tohoto pole přidáte nový typ po vzoru těch, které tam už jsou
            // Jsou nastaveny výchozí hodnoty (viz App/Classes/Type)
            [
                Type::new("movie")->change("in_progress", "Watching")->change("planning", "Plan to Watch")->change("restrict_type", "game"),
                Type::new("book")->change("in_progress", "Reading")->change("planning", "Plan to Read"),
                Type::new("anime")->change("in_progress", "Watching")->change("planning", "Plan to Watch")->change("plural", "anime"),
            ]
         as $status) {
            DB::table('statuses')->insert((array) $status);
        }
    }
}
