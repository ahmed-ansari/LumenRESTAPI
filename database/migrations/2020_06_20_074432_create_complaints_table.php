<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->increments('id', true )->unsigned();
            $table->integer('user_id')->unsigned();
            // $table->integer('user_id')->unsigned()->unique();
            $table->string('title');
            $table->string('image_path');
            // $table->string('category');
            $table->enum('category', ['low', 'medium','high']);

            $table->string('desc')->nullable();
            $table->boolean('record_deleted')->default(0);
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            // $table->timestamps();
        });

        Schema::table('complaints', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
        });

        // DB::statement("ALTER TABLE packages MODIFY weight_unit ENUM('Grams', 'Kgs', 'Pounds') NOT NULL");

        DB::table('complaints')->insert([
            [
                'title' => 'first complaint',
                'category' => 'low',
                'desc' => 'nothing more',
                'image_path' => 'test path',
                'user_id' => 1
            ],
            [
                'title' => 'Second complaint',
                'category' => 'low',
                'desc' => 'nothing more',
                'image_path' => 'test path',
                'user_id' => 1
            ],
            [
                'title' => 'third complaint',
                'category' => 'low',
                'desc' => 'nothing more',
                'image_path' => 'test path',
                'user_id' => 2
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
        Schema::dropIfExists('complaints');
    }
}
