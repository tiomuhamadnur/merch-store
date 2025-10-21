<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')
                ->nullable()
                ->constrained('roles')
                ->after('email');

            $table->string('phone')
                ->nullable()
                ->after('role_id');

            $table->enum('status', ['active', 'inactive'])
                ->default('active')
                ->after('phone');
        });
    }


    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
