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

        CREATE TABLE documents (

            id                          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            customer_id                 INT UNSIGNED NOT NULL,
            document_type               VARCHAR(255) NOT NULL,
            document_name               VARCHAR(255) NOT NULL,
            document_path               VARCHAR(255) NOT NULL,
            status                      ENUM('Active', 'Inactive') NOT NULL DEFAULT 'Active',

            FOREIGN KEY (customer_id)   REFERENCES customers(id),

            created_at                  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at                  TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
            deleted_at                  TIMESTAMP DEFAULT NULL

        );

        SQL;

        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
