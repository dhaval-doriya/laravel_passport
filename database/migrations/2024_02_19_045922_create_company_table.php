<?php

use App\Models\User;
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
            if (!Schema::hasTable('companies')) {
                Schema::create('companies', function (Blueprint $table) {
                    $table->uuid('id');
                    $table->string('name');
                    $table->string('descritpion')->nullable();
                    $table->timestamps();
                });
            }
            DB::table('companies')->insert(['id' => uuid_create(), 'name' => 'company_1']);
            DB::table('companies')->insert(['id' => uuid_create(), 'name' => 'company_2']);

            Schema::table('users', function (Blueprint $table) {
                $table->uuid('company_id');
            });

            $company_id =   DB::table('companies')->where('name', 'company_1')->first()->id;
            User::where('name', '!=', null)->update(['company_id' => $company_id]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
