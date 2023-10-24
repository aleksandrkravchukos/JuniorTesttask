<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::connection('mysql')->statement('DROP DATABASE IF EXISTS tmg_test');
        DB::connection('mysql')->statement('CREATE DATABASE IF NOT EXISTS tmg_test');

        // Create the 'users' table
        DB::connection('mysql_test')->statement(
            'CREATE TABLE `users` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255),
        `email` VARCHAR(255) UNIQUE,
        `email_verified_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `phone` VARCHAR(255),
        `password` VARCHAR(255),
        `remember_token` VARCHAR(255) NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)'
        );

        DB::connection('mysql_test')->beginTransaction();

        $tables = ['users'];

        foreach ($tables as $table) {
            $query = "INSERT INTO `tmg_test`.`$table` SELECT * FROM `tmg`.`$table`";
            DB::connection('mysql')->statement($query);
        }

        DB::connection('mysql_test')->commit();
        DB::connection('mysql_test')->statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copy_existing_database_for_tests');
    }
};
