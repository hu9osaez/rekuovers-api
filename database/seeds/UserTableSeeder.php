<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(3)->make();

        $data = array_map(function ($value) {
            return $value->getAttributes();
        }, $users->all());

        User::insert($data);
    }
}
