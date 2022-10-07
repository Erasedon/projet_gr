<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221006140110 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE grimage (id INT AUTO_INCREMENT NOT NULL, link VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grquizz (id INT AUTO_INCREMENT NOT NULL, grimage_id INT DEFAULT NULL, grstand_id INT DEFAULT NULL, question VARCHAR(255) NOT NULL, reponse1 VARCHAR(100) NOT NULL, reponse2 VARCHAR(100) NOT NULL, reponse3 VARCHAR(100) NOT NULL, reponse4 VARCHAR(100) NOT NULL, bonne_reponse VARCHAR(100) NOT NULL, INDEX IDX_2FC261FF56636628 (grimage_id), INDEX IDX_2FC261FFFCF297C2 (grstand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grstand (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, uuid VARCHAR(180) NOT NULL, nom_stand VARCHAR(100) NOT NULL, position_x VARCHAR(255) NOT NULL, position_y VARCHAR(255) NOT NULL, nombre_participant INT NOT NULL, qr_code VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_370CEE74D17F50A6 (uuid), INDEX IDX_370CEE74C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE grtype_stand (id INT AUTO_INCREMENT NOT NULL, nom_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gruser (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, telephone VARCHAR(50) NOT NULL, classement INT DEFAULT NULL, stand1 TINYINT(1) NOT NULL, stand2 TINYINT(1) NOT NULL, stand3 TINYINT(1) NOT NULL, stand4 TINYINT(1) NOT NULL, stand5 TINYINT(1) NOT NULL, is_verified TINYINT(1) NOT NULL, banned TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8BF624BBE7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE grquizz ADD CONSTRAINT FK_2FC261FF56636628 FOREIGN KEY (grimage_id) REFERENCES grimage (id)');
        $this->addSql('ALTER TABLE grquizz ADD CONSTRAINT FK_2FC261FFFCF297C2 FOREIGN KEY (grstand_id) REFERENCES grstand (id)');
        $this->addSql('ALTER TABLE grstand ADD CONSTRAINT FK_370CEE74C54C8C93 FOREIGN KEY (type_id) REFERENCES grtype_stand (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE grquizz DROP FOREIGN KEY FK_2FC261FF56636628');
        $this->addSql('ALTER TABLE grquizz DROP FOREIGN KEY FK_2FC261FFFCF297C2');
        $this->addSql('ALTER TABLE grstand DROP FOREIGN KEY FK_370CEE74C54C8C93');
        $this->addSql('DROP TABLE grimage');
        $this->addSql('DROP TABLE grquizz');
        $this->addSql('DROP TABLE grstand');
        $this->addSql('DROP TABLE grtype_stand');
        $this->addSql('DROP TABLE gruser');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
