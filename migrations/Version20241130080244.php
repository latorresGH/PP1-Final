<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241130080244 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE favorito (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, pelicula_id INT DEFAULT NULL, serie_id INT DEFAULT NULL, fecha_agregado DATETIME NOT NULL, INDEX IDX_881067C7DB38439E (usuario_id), INDEX IDX_881067C770713909 (pelicula_id), INDEX IDX_881067C7D94388BD (serie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pelicula (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, duracion INT NOT NULL, imagen VARCHAR(255) NOT NULL, archivo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, duracion INT NOT NULL, temporadas INT NOT NULL, imagen VARCHAR(255) NOT NULL, archivo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ver_mas_tarde (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, pelicula_id INT DEFAULT NULL, serie_id INT DEFAULT NULL, fecha_agregado DATETIME NOT NULL, INDEX IDX_3E042F55DB38439E (usuario_id), INDEX IDX_3E042F5570713909 (pelicula_id), INDEX IDX_3E042F55D94388BD (serie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE favorito ADD CONSTRAINT FK_881067C7DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE favorito ADD CONSTRAINT FK_881067C770713909 FOREIGN KEY (pelicula_id) REFERENCES pelicula (id)');
        $this->addSql('ALTER TABLE favorito ADD CONSTRAINT FK_881067C7D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
        $this->addSql('ALTER TABLE ver_mas_tarde ADD CONSTRAINT FK_3E042F55DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE ver_mas_tarde ADD CONSTRAINT FK_3E042F5570713909 FOREIGN KEY (pelicula_id) REFERENCES pelicula (id)');
        $this->addSql('ALTER TABLE ver_mas_tarde ADD CONSTRAINT FK_3E042F55D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE favorito DROP FOREIGN KEY FK_881067C7DB38439E');
        $this->addSql('ALTER TABLE favorito DROP FOREIGN KEY FK_881067C770713909');
        $this->addSql('ALTER TABLE favorito DROP FOREIGN KEY FK_881067C7D94388BD');
        $this->addSql('ALTER TABLE ver_mas_tarde DROP FOREIGN KEY FK_3E042F55DB38439E');
        $this->addSql('ALTER TABLE ver_mas_tarde DROP FOREIGN KEY FK_3E042F5570713909');
        $this->addSql('ALTER TABLE ver_mas_tarde DROP FOREIGN KEY FK_3E042F55D94388BD');
        $this->addSql('DROP TABLE favorito');
        $this->addSql('DROP TABLE pelicula');
        $this->addSql('DROP TABLE serie');
        $this->addSql('DROP TABLE ver_mas_tarde');
    }
}
