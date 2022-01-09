<?php

use Illuminate\Database\Seeder;
use App\User;
//use App\Theme;
//use App\Article;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create();
    }
}
