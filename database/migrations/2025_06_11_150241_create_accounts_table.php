<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('accounts')) {
            Schema::create('accounts', function (Blueprint $table) {
                $table->id();
                $table->string('number_account', 10)->unique();
                $table->string('account_number')->unique();
                $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
                $table->tinyInteger('type')->nullable();
                $table->string('password', 100);
                $table->boolean('is_primary')->default(false);
                $table->tinyInteger('status')->nullable();
                $table->decimal('balance', 15, 2)->default(0);
                $table->timestamps();

                // Indexes
                $table->index(['customer_id', 'status']);
                $table->index(['status', 'created_at']);
                $table->index('account_number');
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};