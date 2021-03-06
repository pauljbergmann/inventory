<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('category_id')->nullable();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('metric_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();

            /*
            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('restrict')
                ->onDelete('set null');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('set null');

            $table->foreign('metric_id')->references('id')->on('metrics')
                ->onUpdate('restrict')
                ->onDelete('cascade');
            */
        });

        Schema::create('inventory_stocks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('inventory_id')->nullable();
            $table->foreignId('location_id');
            $table->decimal('quantity', 8, 3)->default(0);
            $table->string('aisle')->nullable();
            $table->string('row')->nullable();
            $table->string('bin')->nullable();

            /*
             * This allows only one inventory stock
             * to be created on a single location
             */
            $table->unique(['inventory_id', 'location_id']);

            /*
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('set null');

            $table->foreign('inventory_id')->references('id')->on('inventories')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('location_id')->references('id')->on('locations')
                ->onUpdate('restrict')
                ->onDelete('cascade');
            */
        });

        Schema::create('inventory_stock_movements', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('stock_id');
            $table->foreignId('created_by')->nullable();
            $table->decimal('before', 8, 3)->default(0);
            $table->decimal('after', 8, 3)->default(0);
            $table->decimal('cost', 8, 3)->default(0)->nullable();
            $table->string('reason')->nullable();

            /*
            $table->foreign('stock_id')->references('id')->on('inventory_stocks')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('set null');
            */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('inventory_stock_movements');
        Schema::dropIfExists('inventory_stocks');
        Schema::dropIfExists('inventories');
    }
}
