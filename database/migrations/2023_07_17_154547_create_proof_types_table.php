<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateProofTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = <<<'SQL'

        CREATE TABLE proof_types (

            id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name        VARCHAR(255) NOT NULL UNIQUE,
            slug        VARCHAR(255) NOT NULL UNIQUE,
            category    VARCHAR(255) NOT NULL,
            status      ENUM('Active', 'Inactive') NOT NULL DEFAULT 'Active',

            created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at  TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
            deleted_at  TIMESTAMP DEFAULT NULL
        );

        SQL;

        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proof_lists');
    }
}
