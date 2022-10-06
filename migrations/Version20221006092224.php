<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221006092224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grquizz ADD bonne_reponse VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE grstand ADD grquizz_id INT DEFAULT NULL, ADD uuid VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE grstand ADD CONSTRAINT FK_370CEE74D1550888 FOREIGN KEY (grquizz_id) REFERENCES grquizz (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_370CEE74D17F50A6 ON grstand (uuid)');
        $this->addSql('CREATE INDEX IDX_370CEE74D1550888 ON grstand (grquizz_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grquizz DROP bonne_reponse');
        $this->addSql('ALTER TABLE grstand DROP FOREIGN KEY FK_370CEE74D1550888');
        $this->addSql('DROP INDEX UNIQ_370CEE74D17F50A6 ON grstand');
        $this->addSql('DROP INDEX IDX_370CEE74D1550888 ON grstand');
        $this->addSql('ALTER TABLE grstand DROP grquizz_id, DROP uuid');
    }
}
