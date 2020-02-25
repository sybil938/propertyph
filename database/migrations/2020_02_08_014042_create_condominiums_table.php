<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCondominiumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condominiums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');  
            $table->bigInteger('type')->unsigned()->nullable();
            $table->foreign('type')->references('id')->on('metas')->onUpdate('cascade')->onDelete('set null');                 
            $table->text('name')->nullable();
            $table->text('unit_number')->nullable();
            $table->text('street')->nullable();
            $table->text('city')->nullable();
            $table->text('province')->nullable();
            $table->text('postal_code')->nullable();
            $table->text('country')->nullable();
            $table->text('units')->nullable();
            $table->text('amenities')->nullable();
            $table->text('description')->nullable();
            $table->text('terms')->nullable();
            $table->longText('images')->nullable();
            $table->bigInteger('status')->unsigned()->nullable();
            $table->foreign('status')->references('id')->on('metas')->onUpdate('cascade')->onDelete('set null');   
            $table->text('monthly_rental')->nullable();
            $table->text('deposit')->nullable();
            $table->text('advance')->nullable();
            $table->text('electric_bill')->nullable();
            $table->text('water_bill')->nullable();
            $table->text('penalty')->nullable();                      
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('condominiums');
    }
}
