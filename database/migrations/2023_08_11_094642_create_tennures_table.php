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

        CREATE TABLE tennures (

            id                          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            agreement_id                INT UNSIGNED NOT NULL,
            status                      ENUM('Active', 'Inactive') NOT NULL DEFAULT 'Active',
            invoice_no                  VARCHAR(255) NOT NULL,
            payment_receipt             VARCHAR(255) NULL,
            start_date                  DATE NOT NULL,
            end_date                    DATE NULL,
            period                      INT NOT NULL,

            FOREIGN KEY (agreement_id)  REFERENCES agreements(id),

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
        Schema::dropIfExists('tennures');
    }
};
