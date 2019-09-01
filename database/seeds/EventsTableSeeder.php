<?php

use App\Http\Controllers\Events;
use App\Event;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::truncate();
        for ($i = 0; $i < 2; $i++) {
            Article::create([
                'user_id' => 1,
                'name' => 'Event number #'.$i,
                'start_time' => '2019-09-0'.($i+1).'T03:00:00+05:30',
                'end_time' => '2019-09-0'.($i+1).'T08:30:00+05:30',
            ]);
        }
    }
}
