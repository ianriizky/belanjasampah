<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabase extends Migration
{
    public function up()
    {
        // Bank section
        // banks
        Schema::create('banks', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('user_id', 15);
            $table->string('name', 50);
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('order_number');
            // $table->string('picture')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users');
        });
        // codes
        Schema::create('codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->enum('type', ['+', '-']);
            $table->boolean('active')->default(true);
        });
        // customers
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id', 15);
            $table->string('bank_id', 10);
            // $table->decimal('balance');
            $table->unsignedInteger('family_member');
            $table->boolean('active')->default(true);
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('bank_id')->references('id')->on('banks');
        });
        // transactions
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->decimal('value');
            $table->timestamps();

            // $table->foreign('code_id')->references('id')->on('codes');
            // $table->foreign('customer_id')->references('id')->on('customers');
        });

        // Koperasi section
        // categorys
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->string('unit')->nullable();
            $table->boolean('active')->default(true);
        });
        // koperasis
        Schema::create('koperasis', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('user_id', 15);
            $table->string('name', 50);
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('order_number');
            // $table->string('picture')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();

            // $table->foreign('user_id')->references('id')->on('users');
        });
        // goods
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('koperasi_id', 10);
            $table->integer('category_id')->unsigned();
            $table->string('name', 50);
            $table->text('description')->nullable();
            $table->enum('priority', ['high', 'standard'])->default('standard');
            $table->decimal('price');
            // $table->integer('stock');
            $table->string('picture')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();

            // $table->foreign('koperasi_id')->references('id')->on('koperasis');
            // $table->foreign('category_id')->references('id')->on('categories');
        });
        // stocks
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('good_id')->unsigned();
            $table->string('user_id', 15);
            $table->integer('value');
            $table->timestamps();

            // $table->foreign('good_id')->references('id')->on('goods');
        });
        // receipts
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('koperasi_id', 10);
            $table->integer('customer_id')->unsigned();
            $table->enum('status', ['processed', 'verified'])->default('processed');
            // $table->decimal('total');
            $table->timestamps();

            // $table->foreign('customer_id')->references('id')->on('customers');
        });
        // detailreceipts
        Schema::create('detailreceipts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('receipt_id')->unsigned();
            $table->integer('good_id')->unsigned();
            $table->integer('damount');
            $table->decimal('dprice');
            $table->decimal('dtotal');
            // $table->timestamps();

            // $table->foreign('receipt_id')->references('id')->on('receipts');
            // $table->foreign('good_id')->references('id')->on('goods');
        });        
    }

    public function down()
    {
        Schema::dropIfExists('banks');
        Schema::dropIfExists('nasabahs');
        Schema::dropIfExists('koperasis');
    }
}
