<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');          
            $table->text('phone')->nullable();
            $table->text('birthday')->nullable();
            $table->text('house_number')->nullable();
            $table->text('street')->nullable();            
            $table->text('city')->nullable();
            $table->text('province')->nullable();
            $table->text('postal_code')->nullable();
            $table->text('country')->nullable();
            $table->longText('image')->nullable();
            $table->longText('image_id')->nullable();      
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
