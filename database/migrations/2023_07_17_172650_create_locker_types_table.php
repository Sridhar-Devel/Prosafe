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
        $sql = <<<'SQL'

        CREATE TABLE locker_types (
            id                      INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name                    VARCHAR(255) NOT NULL UNIQUE,
            description             VARCHAR(255) NOT NULL,
            status                  ENUM('Active', 'Inactive') NOT NULL DEFAULT 'Active',
            created_at              TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at              TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
            deleted_at              TIMESTAMP DEFAULT NULL
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
        Schema::dropIfExists('locker_types');
    }
};
