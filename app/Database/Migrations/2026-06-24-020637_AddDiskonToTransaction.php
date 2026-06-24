<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDiskonToTransaction extends Migration
{
    public function up()
    {
        $this->forge->addColumn('transaction', [
            'diskon' => [
                'type' => 'BIGINT',
                'null' => true,
                'default' => 0
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('transaction', 'diskon');
    }
}
