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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('category')->nullable();
            $table->decimal('selling_price', 12, 2);
            $table->decimal('purchase_price', 12, 2);
            $table->integer('stock')->default(0);
            $table->string('packaging')->nullable();
            $table->date('expiration_date')->nullable();
            $table->enum('drug_class', ['Over-the-counter', 'Prescription', 'Limited OTC'])->default('Over-the-counter');
            $table->string('standard_name')->nullable();
            $table->text('description')->nullable();
            $table->string('images')->nullable();
            $table->string('usage_instruction')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
