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

        CREATE TABLE agreements (

            id                          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            agreement_no                VARCHAR(255) NOT NULL UNIQUE,
            locker_id                   INT UNSIGNED NOT NULL,
            customer_id_1               INT UNSIGNED NOT NULL,
            customer_id_2               INT UNSIGNED NULL,
            customer_id_3               INT UNSIGNED NULL,
            operation_type              ENUM('Single', 'Joint', 'Any') NOT NULL DEFAULT 'Single',
            customer_count              ENUM('1', '2', '3') NOT NULL DEFAULT '1',
            start_date                  DATE NOT NULL,
            end_date                    DATE NOT NULL,
            status                      ENUM('Active', 'Inactive') NOT NULL DEFAULT 'Active',
            agreement_proof             VARCHAR(255) NOT NULL,
            nominee_name                VARCHAR(255) NULL,
            nominee_relationship        ENUM('Parent', 'Guardian', 'Spouse', 'Child', 'Sibling', 'Other') NULL,
            nominee_phone_no            VARCHAR(255) NULL,
            nominee_email               VARCHAR(255) NULL,
            is_non_individual           BOOLEAN NOT NULL DEFAULT FALSE,
            business_gst_no             VARCHAR(255) NULL,
            business_pan_no             VARCHAR(255) NULL,
            business_address            VARCHAR(255) NULL,
            board_resolution            VARCHAR(255) NULL,

            FOREIGN KEY (locker_id)     REFERENCES lockers(id),
            FOREIGN KEY (customer_id_1) REFERENCES customers(id),
            FOREIGN KEY (customer_id_2) REFERENCES customers(id),
            FOREIGN KEY (customer_id_3) REFERENCES customers(id),

            created_at                  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at                  TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
            deleted_at                  TIMESTAMP DEFAULT NULL

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
        Schema::dropIfExists('agreements');
    }
};
