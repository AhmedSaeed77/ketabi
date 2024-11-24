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
        Schema::table('users', function (Blueprint $table) {
            $table->after('educational_stage_id', function () use ($table) {
                $table->foreignId('bank_id')->nullable()->constrained()->nullOnDelete()->cascadeOnUpdate();
                $table->string('bank_account_number')->nullable();
                $table->string('bank_account_name')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['bank_id']);
            $table->dropColumn('bank_id');
            $table->dropColumn('bank_account_number');
            $table->dropColumn('bank_account_name');
        });
    }
};
