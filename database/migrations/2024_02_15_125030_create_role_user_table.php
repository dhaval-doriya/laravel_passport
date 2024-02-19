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
    {        $dbName = DB::connection()->getDatabaseName();
        if ($dbName == env('DB_DATABASE')) {
        Schema::create('role_user', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->uuid('role_id');
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
