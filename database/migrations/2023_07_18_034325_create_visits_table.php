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

        CREATE TABLE visits (

            id                          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            locker_id                   INT UNSIGNED NOT NULL,
            customer_id                 INT UNSIGNED NOT NULL,
            customer2_id                INT UNSIGNED NULL,
            customer3_id                INT UNSIGNED NULL,
            customer1_photo             VARCHAR(255) NOT NULL,
            customer2_photo             VARCHAR(255) NULL,
            customer3_photo             VARCHAR(255) NULL,
            time_in                     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            time_out                    TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
            user_id                     BIGINT UNSIGNED NOT NULL,

            FOREIGN KEY (locker_id)     REFERENCES lockers(id),
            FOREIGN KEY (customer_id)   REFERENCES customers(id),
            FOREIGN KEY (customer2_id)  REFERENCES customers(id),
            FOREIGN KEY (customer3_id)  REFERENCES customers(id),
            FOREIGN KEY (user_id)       REFERENCES users(id),

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
        Schema::dropIfExists('visits');
    }
};
