<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('photographer_id')->nullable()->constrained('photographers')->onDelete('CASCADE');
            $table->foreignId('videographer_id')->nullable()->constrained('videographers')->onDelete('CASCADE');
            $table->foreignId('workhour_id')->nullable()->constrained('workhours')->onDelete('CASCADE');

            $table->integer('price')->nullable();

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
        Schema::dropIfExists('customs');
    }
}
