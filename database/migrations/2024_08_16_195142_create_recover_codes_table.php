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
        Schema::create('recover_codes', function (Blueprint $table) {
            $table->id();
            $table->integer('userid');
            $table->integer('code');
            $table->integer('type'); // 1 - email, 2 - phone, 3 - telegram
            $table->integer('status')->default(0); // 0 - не использовано, 1 - использовано
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recover_codes');
    }
};
