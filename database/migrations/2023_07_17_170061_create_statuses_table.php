<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // create sql statement
        $sql = <<<'SQL'

        CREATE TABLE statuses (

            id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name        VARCHAR(255) NOT NULL UNIQUE,

            created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at  TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
            deleted_at  TIMESTAMP DEFAULT NULL
        );

        SQL;

        // execute sql statement
        DB::statement($sql);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
