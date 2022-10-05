<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221005131615 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_2FC261FFD17F50A6 ON grquizz');
        $this->addSql('ALTER TABLE grquizz DROP uuid');
        $this->addSql('ALTER TABLE gruser ADD banned TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grquizz ADD uuid VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FC261FFD17F50A6 ON grquizz (uuid)');
        $this->addSql('ALTER TABLE gruser DROP banned');
    }
}
