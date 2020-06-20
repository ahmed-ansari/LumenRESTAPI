<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id', true )->unsigned();
            $table->string('name', 99)->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->bigInteger('mobile')->unsigned();
            $table->boolean('is_active')->default(1);
            $table->string('password');
            $table->string('api_token')->nullable();
            $table->rememberToken();
            $table->boolean('record_deleted')->default(0);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            // $table->timestamps();


        });

        DB::table('users')->insert([
            [
                'name' => 'ansari',
                'mobile' => '9948604488',
                'email' => 'toahmedshah@gmail.com',
                'password' => 'secret'
            ]
        ]);

        DB::table('users')->insert([
            [
                'name' => 'shabbir',
                'mobile' => '123456',
                'email' => 'creativewebdeals@gmail.com',
                'password' => 'secret'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
