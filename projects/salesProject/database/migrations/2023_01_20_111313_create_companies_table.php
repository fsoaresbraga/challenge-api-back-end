<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id()->index();
            $table->bigInteger('matrix_id')->unsigned()->nullable();
            $table->bigInteger('unity_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('name_fantasy');
            $table->string('cnpj');
            $table->timestamps();
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->foreign('matrix_id')->references('id')->on('companies')->onDelete('cascade');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->foreign('unity_id')->references('id')->on('unities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
