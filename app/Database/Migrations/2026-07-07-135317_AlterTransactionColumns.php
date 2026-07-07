<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTransactionColumns extends Migration
{
    public function up()
    {
        $this->db->query("
            ALTER TABLE `transaction`
            MODIFY ppn DOUBLE NULL,
            MODIFY biaya_admin DOUBLE NULL,
            MODIFY kupon_code VARCHAR(20) NULL,
            MODIFY diskon_kupon DOUBLE NULL
        ");
    }

    public function down()
    {
        $this->db->query("
            ALTER TABLE `transaction`
            MODIFY ppn BIGINT NOT NULL DEFAULT 0,
            MODIFY biaya_admin BIGINT NOT NULL DEFAULT 0,
            MODIFY kupon_code VARCHAR(50) NULL,
            MODIFY diskon_kupon BIGINT NOT NULL DEFAULT 0
        ");
    }
}