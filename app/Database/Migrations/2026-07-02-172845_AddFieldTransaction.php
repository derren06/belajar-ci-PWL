<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldTransaction extends Migration
{
    public function up()
    {
        $this->forge->addColumn('transaction', [
            'ppn' => [
                'type' => 'BIGINT',
                'null' => false,
                'default' => 0,
            ],
            'biaya_admin' => [
                'type' => 'BIGINT',
                'null' => false,
                'default' => 0,
            ],
            'kupon_code' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'diskon_kupon' => [
                'type' => 'BIGINT',
                'null' => false,
                'default' => 0,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('transaction', [
            'ppn',
            'biaya_admin',
            'kupon_code',
            'diskon_kupon'
        ]);
    }
}
