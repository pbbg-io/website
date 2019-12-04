<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extensions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('version')->default('dev');
            $table->bigInteger('author')->unsigned();
            $table->integer('rating')->unsigned()->default(0);
            $table->integer('ratings')->unsigned()->default(0);
            $table->integer('installs')->unsigned()->default(0);

            $table->string('slug');
            $table->timestamps();

            $table->foreign('author')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extensions');
    }
}
