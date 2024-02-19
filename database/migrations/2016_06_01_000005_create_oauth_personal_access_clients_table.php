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
            Schema::create('oauth_personal_access_clients', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->uuid('client_id');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oauth_personal_access_clients');
    }
};
