<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240108161934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE song_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE song (id INT NOT NULL, user_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, genre TEXT DEFAULT NULL, location VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, reproduced INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_33EDEEA19D86650F ON song (user_id_id)');
        $this->addSql('COMMENT ON COLUMN song.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN song.genre IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE song ADD CONSTRAINT FK_33EDEEA19D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE song_id_seq CASCADE');
        $this->addSql('ALTER TABLE song DROP CONSTRAINT FK_33EDEEA19D86650F');
        $this->addSql('DROP TABLE song');
    }
}
