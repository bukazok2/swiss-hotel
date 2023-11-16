<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateHotelsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 12,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'attachment_id' => [
                'type' => 'INT',
                'constraint' => 12,
            ],
            'hotel_id' => [
                'type' => 'INT',
                'constraint' => 12,
                'unique' => true,
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => '1024',
            ],
            'hotel_name' => [
                'type' => 'VARCHAR',
                'constraint' => '2048',
            ],
            'latitude' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'longitude' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'star' => [
                'type' => 'TINYINT',
                'constraint' => 2,
                'unsigned' => true,
            ],
            'zip' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
                'on update CURRENT_TIMESTAMP' => true,
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('hotels');
    }

    public function down()
    {
        $this->forge->dropTable('hotels');
    }
}
