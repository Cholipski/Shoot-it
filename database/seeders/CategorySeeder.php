<?php

namespace Database\Seeders;

use App\Models\Question\QuestionCategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuestionCategory::create([
            "name" => "Ustawa o bronii i amunicji",
            "short_name" => "UOBiA",
            "description" => "Ustawa z dnia 21 maja 1999 r. o broni i amunicji – polska ustawa regulująca zasady wydawania i cofania pozwoleń na broń, procedur obrotu bronią i amunicją, zasady jej posiadania przez cudzoziemców oraz zasady działania strzelnic"
        ]);

        QuestionCategory::create([
            "name" => "Regulamin strzelecki",
            "short_name" => "Regulamin strzelecki",
            "description" => "Regulamin"
        ]);
    }
}
