<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210906140526 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE musique (id INT AUTO_INCREMENT NOT NULL, artiste_id INT DEFAULT NULL, album_id INT DEFAULT NULL, genre_id INT NOT NULL, titre VARCHAR(255) NOT NULL, nb_visionnage INT DEFAULT NULL, INDEX IDX_EE1D56BC21D25844 (artiste_id), INDEX IDX_EE1D56BC1137ABCF (album_id), INDEX IDX_EE1D56BC4296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE musique ADD CONSTRAINT FK_EE1D56BC21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('ALTER TABLE musique ADD CONSTRAINT FK_EE1D56BC1137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('ALTER TABLE musique ADD CONSTRAINT FK_EE1D56BC4296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE musique');
    }
}
