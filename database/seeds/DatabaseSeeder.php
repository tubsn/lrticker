<?php

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

    factory(App\Models\User::class, 20)->create();
    factory(App\Models\Ticker::class, 10)->create();
    factory(App\Models\Post::class, 50)->create();

    }
}
