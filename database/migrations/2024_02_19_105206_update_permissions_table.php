<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $dbName = DB::connection()->getDatabaseName();
        if ($dbName == env('DB_DATABASE')) {
            Schema::table('permissions', function (Blueprint $table) {
                $table->string('name')->unique()->change();
            });
            DB::table('permissions')->truncate();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $dbName = DB::connection()->getDatabaseName();
        if ($dbName == env('DB_DATABASE')) {
            Schema::table('permissions', function (Blueprint $table) {
                $table->string('name')->change();
            });
        }
    }
};
