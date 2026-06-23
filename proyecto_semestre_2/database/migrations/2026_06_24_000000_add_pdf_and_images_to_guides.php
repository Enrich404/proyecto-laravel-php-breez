<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('guides', function (Blueprint $table) {
            $table->string('pdf_path')->nullable()->after('file_path');
            $table->string('pdf_type', 120)->nullable()->after('pdf_path');
            $table->json('image_paths')->nullable()->after('pdf_type');
        });
    }

    public function down(): void
    {
        Schema::table('guides', function (Blueprint $table) {
            $table->dropColumn(['pdf_path', 'pdf_type', 'image_paths']);
        });
    }
};
