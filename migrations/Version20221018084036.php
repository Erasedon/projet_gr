<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221018084036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gruser DROP stand1, DROP stand2, DROP stand3, DROP stand4, DROP stand5');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gruser ADD stand1 TINYINT(1) NOT NULL, ADD stand2 TINYINT(1) NOT NULL, ADD stand3 TINYINT(1) NOT NULL, ADD stand4 TINYINT(1) NOT NULL, ADD stand5 TINYINT(1) NOT NULL');
    }
}
