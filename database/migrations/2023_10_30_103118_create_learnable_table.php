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
        Schema::create('learnables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('parent_id')->nullable()->constrained('learnables')->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('type', ['public_package', 'private_package', 'category', 'recorded_lecture', 'live_lecture', 'attachment']);
            $table->foreignId('subject_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('educational_stage_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->float('price')->unsigned()->nullable(); // for packages, attachments
            $table->integer('sort')->unsigned()->nullable(); // for lectures, attachments
            $table->string('name_ar')->nullable(); // for all
            $table->string('name_en')->nullable(); // for all
            $table->text('description_ar')->nullable(); // for all except categories, lectures
            $table->text('description_en')->nullable(); // for all except categories, lectures
            $table->string('image')->nullable(); // for all except categories, lectures
            $table->enum('introduction_platform', ['youtube', 'vimeo', 'swarmify', 'zoom'])->nullable(); // for packages
            $table->string('introduction_url')->nullable(); // for packages
            $table->integer('duration_in_hours')->nullable(); // for packages, lectures
            $table->integer('duration_in_days')->nullable(); // for packages,
            $table->integer('subscription_days')->nullable(); // for packages
            $table->timestamp('from')->nullable(); // for lectures
            $table->timestamp('to')->nullable(); // for lectures
            $table->enum('source_platform', ['youtube', 'vimeo', 'swarmify', 'zoom','teams'])->nullable(); // for lectures
            $table->string('source_url')->nullable(); // for lectures, attachments
            $table->boolean('is_individually_sellable')->nullable(); // for attachment
            $table->boolean('is_active')->nullable(); // for packages and lectures
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learnables');
    }
};
