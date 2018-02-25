<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(150)->make();

        $data = array_map(function ($value) {
            return $value->getAttributes();
        }, $users->all());

        User::create([
            'name' => 'Rekuovers',
            'username' => 'rekuovers',
            'email' => 'hu9o.saez@gmail.com',
            'password' => 'hola123'
        ]);

        User::insert($data);
    }
}
