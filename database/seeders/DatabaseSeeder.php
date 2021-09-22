<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Quiz;
use App\Models\Quote;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Quiz::factory()->count(100)
            ->has(Quote::factory()->count(10)
                ->hasAttached(Answer::factory()->count(4), new Sequence(function ($sequence) {
                    if ($sequence->index%4 == 0) {
                        return ['is_correct' => 1];
                    }
                    return ['is_correct' => 0];
                })))->create();
    }


}

