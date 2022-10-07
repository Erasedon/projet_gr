<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221007090357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grquizz DROP FOREIGN KEY FK_2FC261FF56636628');
        $this->addSql('DROP TABLE grimage');
        $this->addSql('DROP INDEX IDX_2FC261FF56636628 ON grquizz');
        $this->addSql('ALTER TABLE grquizz ADD image VARCHAR(255) DEFAULT NULL, DROP grimage_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE grimage (id INT AUTO_INCREMENT NOT NULL, link VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE grquizz ADD grimage_id INT DEFAULT NULL, DROP image');
        $this->addSql('ALTER TABLE grquizz ADD CONSTRAINT FK_2FC261FF56636628 FOREIGN KEY (grimage_id) REFERENCES grimage (id)');
        $this->addSql('CREATE INDEX IDX_2FC261FF56636628 ON grquizz (grimage_id)');
    }
}
