<?php

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
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345'),
        ]);

        DB::table('profiles')->insert([
            'id' => 1,
            'name' => 'asdasdas',
            'residence' => 'asdasdas',
            'zipcode' => '1212',
            'cuitnumber' => '1212',
            'phone' => '1212',
            'rpaenrollment' => '1212',
            'fiscalsituation' => '1212',
            'email' => 'admin@admin.com',
            'website' => 'asdads',
            'user_id' => 1,
        ]);
    }
}
