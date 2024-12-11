<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRememberTokenAndRoleToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Check if the 'remember_token' column exists before adding it
            if (!Schema::hasColumn('users', 'remember_token')) {
                $table->string('remember_token')->nullable();
            }

            // Check if the 'role' column exists before adding it
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop 'remember_token' if it exists
            if (Schema::hasColumn('users', 'remember_token')) {
                $table->dropColumn('remember_token');
            }

            // Drop 'role' if it exists
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
}
