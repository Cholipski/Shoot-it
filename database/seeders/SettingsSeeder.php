<?php

namespace Database\Seeders;

use App\Models\Settings\AppSettings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppSettings::create([
            'key' => "exam",
            'value' => '{"examDuration": 20, "questionsCount": 10, "mandatoryCategory": 1, "mandatoryQuestionsCount": 4}'
        ]);
    }
}
