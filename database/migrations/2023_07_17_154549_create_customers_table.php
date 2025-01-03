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

        CREATE TABLE customers (
            id                              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            customer_title                  ENUM('Mr', 'Mrs', 'Ms', 'Dr', 'Other') NOT NULL,
            customer_name                   VARCHAR(255) NOT NULL,
            occupation                      VARCHAR(255) NOT NULL,
            guardian                        ENUM('Father', 'Husband') NULL,
            guardian_title                  ENUM('Mr', 'Mrs', 'Ms', 'Dr', 'Other') NULL,
            guardian_name                   VARCHAR(255) NULL,
            dob                             DATE NOT NULL,
            gender                          ENUM('Male', 'Female', 'Other') NOT NULL,
            nationality                     VARCHAR(255) NOT NULL,
            marital_status                  ENUM('Single', 'Married') NOT NULL,
            email                           VARCHAR(255) NOT NULL UNIQUE,
            phone                           VARCHAR(255) NOT NULL UNIQUE,
            phone2                          VARCHAR(255) NULL UNIQUE,
            residence_landline              VARCHAR(255) NULL,
            pa_door_no                      VARCHAR(255) NOT NULL,
            pa_apartment_name               VARCHAR(255) NULL,
            pa_street_name                  VARCHAR(255) NOT NULL,
            pa_city                         VARCHAR(255) NOT NULL,
            pa_state_id                     INT UNSIGNED NOT NULL,
            pa_pincode                      INT UNSIGNED NOT NULL,
            ca_door_no                      VARCHAR(255) NOT NULL,
            ca_apartment_name               VARCHAR(255) NULL,
            ca_street_name                  VARCHAR(255) NOT NULL,
            ca_city                         VARCHAR(255) NOT NULL,
            ca_state_id                     INT UNSIGNED NOT NULL,
            ca_pincode                      INT UNSIGNED NOT NULL,
            same_address                    VARCHAR(255) NOT NULL,
            pan_card_no                     VARCHAR(10) NOT NULL,
            identity_proof_id               INT UNSIGNED NOT NULL,
            identity_proof_no               VARCHAR(255) NOT NULL,
            proof_of_identity               VARCHAR(255) NOT NULL,
            address_proof_id                INT UNSIGNED NOT NULL,
            address_proof_no                VARCHAR(255) NOT NULL,
            proof_of_address                VARCHAR(255) NOT NULL,
            customer_photo                  VARCHAR(255) NOT NULL,
            customer_sign                   VARCHAR(255) NOT NULL,

            FOREIGN KEY (pa_state_id)       REFERENCES states(id),
            FOREIGN KEY (ca_state_id)       REFERENCES states(id),
            FOREIGN KEY (identity_proof_id) REFERENCES proof_types(id),
            FOREIGN KEY (address_proof_id)  REFERENCES proof_types(id),

            created_at                      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at                      TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
            deleted_at                      TIMESTAMP NULL
        );

        SQL;

        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
