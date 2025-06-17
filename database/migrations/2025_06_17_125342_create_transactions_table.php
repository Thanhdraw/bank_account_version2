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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->unique(); // Mã giao dịch
            $table->foreignId('from_account_id')->nullable()->constrained('accounts')->onDelete('set null');
            $table->foreignId('to_account_id')->nullable()->constrained('accounts')->onDelete('set null');
            $table->tinyInteger('type')->nullable();
            $table->decimal('amount', 15, 2);
            $table->tinyInteger('status')->nullable(); //trạng thái giao dịch
            $table->text('description')->nullable();
            $table->text('notes')->nullable();
            $table->json('metadata')->nullable(); // Dữ liệu bổ sung (JSON)
            $table->timestamp('processed_at')->nullable(); // Thời gian xử lý
            $table->string('processed_by')->nullable(); // Người xử lý
            $table->timestamps();

            // Indexes
            $table->index(['from_account_id', 'status', 'created_at']);
            $table->index(['to_account_id', 'status', 'created_at']);
            $table->index(['type', 'status']);
            $table->index(['status', 'created_at']);
            $table->index('transaction_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};