<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventorySupplierTables extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('contact_title')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_fax')->nullable();
            $table->string('contact_email')->nullable();
        });

        Schema::create('inventory_suppliers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('inventory_id');
            $table->unsignedInteger('supplier_id');
            $table->foreignId('created_by')->nullable();

            /*
            $table->foreign('inventory_id')->references('id')->on('inventories')
                ->onUpdate('restrict')
                ->onDelete('cascade');

            $table->foreign('supplier_id')->references('id')->on('suppliers')
                ->onUpdate('restrict')
                ->onDelete('cascade');
            */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('inventory_suppliers');
        Schema::dropIfExists('suppliers');
    }
}
