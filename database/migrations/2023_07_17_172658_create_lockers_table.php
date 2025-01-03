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

        CREATE TABLE lockers (

            id                      INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            number                  VARCHAR(255) NOT NULL,
            status_id               INT UNSIGNED NOT NULL,
            floor_id                INT UNSIGNED NOT NULL,
            locker_type_id          INT UNSIGNED NOT NULL,
            key_no                  VARCHAR(255) NOT NULL,

            FOREIGN KEY (status_id) REFERENCES statuses(id),
            FOREIGN KEY (floor_id)  REFERENCES floors(id),
            FOREIGN KEY (locker_type_id) REFERENCES locker_types(id),

            created_at              TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at              TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
            deleted_at              TIMESTAMP DEFAULT NULL,

            UNIQUE KEY unique_locker_per_floor (number, floor_id)
            -- UNIQUE KEY unique_key_per_floor (key_no, floor_id)
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
        Schema::dropIfExists('lockers');
    }
};
