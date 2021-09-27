<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pakets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('idgaleri')->nullable()->constrained('galeris')->onDelete('CASCADE');
            $table->foreignId('photographer_id')->nullable()->constrained('photographers')->onDelete('CASCADE');
            $table->foreignId('videographer_id')->nullable()->constrained('videographers')->onDelete('CASCADE');
            $table->foreignId('workhour_id')->nullable()->constrained('workhours')->onDelete('CASCADE');

            $table->string('namapaket')->nullable();
            $table->string('kategori')->nullable();
            $table->string('day')->nullable();
            $table->tinyInteger('flashdisk')->default(1);
            $table->string('edited')->nullable();
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
        Schema::dropIfExists('pakets');
    }
}
