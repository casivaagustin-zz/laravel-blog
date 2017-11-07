<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $this->call(Sections::class);
       $this->call(Tags::class);
       $this->call(PostsSeed::class);
    }
}
