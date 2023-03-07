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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_code')->unique();
            $table->string('subject');
            $table->text('description');
            $table->boolean('is_follow_up')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_phone')->nullable();
            $table->boolean('with_email')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('department_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('type_id')->nullable()->constrained('ticket_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('status_id')->nullable()->constrained('ticket_statuses')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('priority_id')->nullable()->constrained('ticket_priorities')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('concern_id')->nullable()->constrained('ticket_concerns')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('status_updated_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
