<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabase extends Migration
{
    public function up()
    {
        // bank_sampahs
        Schema::create('banks', function (Blueprint $table) {
            $table->string('id', 10)->primary();            
            $table->string('name', 50);
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('order_number');
            $table->enum('active', ['y', 'n'])->default('y');          
            $table->timestamps();
        });

        // pegawai_banks
        Schema::create('pegawai_banks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id', 15);
            $table->string('bank_id', 10);
            $table->enum('active', ['y', 'n'])->default('y');                        
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks');
        });

        // nasabah
        Schema::create('nasabahs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id', 15);
            $table->string('bank_id', 10);
            $table->decimal('balance');
            $table->unsignedInteger('family_member'); 
            $table->enum('active', ['y', 'n'])->default('y');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks');
        });

        // koperasi
        Schema::create('koperasis', function (Blueprint $table) {
            $table->string('id', 10)->primary();            
            $table->string('name', 50);
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('order_number');
            $table->enum('active', ['y', 'n'])->default('y');          
            $table->timestamps();
        });

        // admin_koperasi
        Schema::create('admin_koperasis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id', 15);
            $table->string('koperasi_id', 10);
            $table->enum('active', ['y', 'n'])->default('y');                        
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('koperasi_id')->references('id')->on('koperasis');
        });
    }

    public function down()
    {
        Schema::dropIfExists('banks');
        Schema::dropIfExists('pegawai_banks');
        Schema::dropIfExists('nasabahs');
        Schema::dropIfExists('koperasis');
        Schema::dropIfExists('admin_koperasis');
    }
}
