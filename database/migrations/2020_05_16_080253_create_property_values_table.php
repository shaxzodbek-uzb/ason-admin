<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value');
            $table->string('color', 64)->nullable();
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade');
            $table->boolean('is_active')->default(1);
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->foreign('property_id')
                ->references('id')->on('properties')
                ->onDelete('cascade');
            
            $table->index(['property_id', 'is_active'], 'active_property_value');
            $table->index('order', 'position');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_values');
    }
}
