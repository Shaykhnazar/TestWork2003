<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->unsignedSmallInteger('permission_id');
            $table->unsignedSmallInteger('role_id');

            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

            $table->unique(['permission_id', 'role_id']);

            $table->comment('Pivot table to establish the relationship between roles and permissions');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permission_role');
    }
};
