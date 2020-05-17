<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug', 128);
            $table->enum('type', ['dropdown', 'radio', 'color']);
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(0);
            $table->timestamps();

            $table->index([ 'is_active', 'order'], 'active_sorted');
            $table->unique('slug', 'slug_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
