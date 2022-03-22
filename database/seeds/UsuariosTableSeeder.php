<?php

use Illuminate\Database\Seeder;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert(
            array(
                'name'=>'Juan Cruz',	
                'email'=>'admin@admin.com',
                'password'=>bcrypt('admin')
            )
        );
    }
}
