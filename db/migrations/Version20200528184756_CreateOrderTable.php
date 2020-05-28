<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200528184756_CreateOrderTable extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $table = $schema->createTable('_order');

        $table->addColumn('id', 'integer', [
            'notnull' => true,
        ]);
        $table->addColumn('created_at', Types::DATETIME_MUTABLE, [
            'notnull' => true
        ]);
        $table->addColumn('updated_at', Types::DATETIME_MUTABLE, [
            'notnull' => false
        ]);
        $table->addColumn('mark_datetime', Types::DATETIME_MUTABLE, [
            'notnull' => false
        ]);
        $table->addColumn('country_iso', Types::STRING, [
            'notnull' => true,
            'length' => 255,
        ]);
        $table->addColumn('first_name', Types::STRING, [
            'notnull' => true,
            'length' => 255,
        ]);
        $table->addColumn('last_name', Types::STRING, [
            'notnull' => true,
            'length' => 255,
        ]);
        $table->addColumn('order_type', Types::STRING, [
            'notnull' => true,
            'length' => 255,
        ]);
        $table->addColumn('email', Types::STRING, [
            'notnull' => false,
            'length' => 255,
        ]);
        $table->addColumn('total_price', Types::FLOAT, [
            'notnull' => true,
        ]);
        $table->addColumn('price_with_discount', Types::FLOAT, [
            'notnull' => true,
        ]);
        $table->addColumn('personal_discount', Types::FLOAT, [
            'notnull' => true,
        ]);

        $table->addUniqueIndex(['id']);
        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
