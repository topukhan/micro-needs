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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('tab_slug');
            $table->string('tab_display_name');
            $table->string('field_key')->unique();
            $table->string('field_label');
            $table->text('field_value')->nullable();
            $table->string('field_type')->default('text');
            $table->string('placeholder')->nullable();
            $table->text('hint')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
