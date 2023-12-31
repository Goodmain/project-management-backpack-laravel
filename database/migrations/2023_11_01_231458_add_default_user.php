<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use RonasIT\Support\Traits\MigrationTrait;

class AddDefaultUser extends Migration
{
    use MigrationTrait;

    public function up()
    {
        if (config('app.env') !== 'testing') {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('a318afa8'),
                'role_id' => '1'
            ]);
        }
    }

    public function down()
    {
        if (config('app.env') !== 'testing') {
            User::where('email', 'admin@mail.com')->delete();
        }
    }
}
