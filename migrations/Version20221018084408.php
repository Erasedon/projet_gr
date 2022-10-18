<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221018084408 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE grcheckpoint (id INT AUTO_INCREMENT NOT NULL, nom_stands VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grcheckpoint_gruser (grcheckpoint_id INT NOT NULL, gruser_id INT NOT NULL, INDEX IDX_AC92185CF8E5192B (grcheckpoint_id), INDEX IDX_AC92185CA7C62C5 (gruser_id), PRIMARY KEY(grcheckpoint_id, gruser_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE grcheckpoint_gruser ADD CONSTRAINT FK_AC92185CF8E5192B FOREIGN KEY (grcheckpoint_id) REFERENCES grcheckpoint (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE grcheckpoint_gruser ADD CONSTRAINT FK_AC92185CA7C62C5 FOREIGN KEY (gruser_id) REFERENCES gruser (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grcheckpoint_gruser DROP FOREIGN KEY FK_AC92185CF8E5192B');
        $this->addSql('ALTER TABLE grcheckpoint_gruser DROP FOREIGN KEY FK_AC92185CA7C62C5');
        $this->addSql('DROP TABLE grcheckpoint');
        $this->addSql('DROP TABLE grcheckpoint_gruser');
    }
}
