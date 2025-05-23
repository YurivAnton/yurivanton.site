<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('reportNumber');
            $table->integer('customer_id');
            $table->integer('office_id');
            $table->text('description');
            $table->text('descriptionResult');
            $table->string('typeDevice');
            $table->string('snDevice');
            $table->string('coolant');
            $table->integer('newCoolant');
            $table->integer('oldCoolant');
            $table->string('mainTech');
            $table->text('signTech');
            $table->string('nameCustomerSign');
            $table->text('signCustomer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
