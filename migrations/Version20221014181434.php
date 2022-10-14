<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221014181434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carrito (id INT AUTO_INCREMENT NOT NULL, cliente_id INT NOT NULL, precio_total NUMERIC(12, 2) NOT NULL, fecha DATE NOT NULL, INDEX IDX_77E6BED5DE734E51 (cliente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carrito_detalle (id INT AUTO_INCREMENT NOT NULL, producto_id INT NOT NULL, carrito_id INT NOT NULL, cantidad INT NOT NULL, INDEX IDX_412915887645698E (producto_id), INDEX IDX_41291588DE2CF6E7 (carrito_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cliente (id INT AUTO_INCREMENT NOT NULL, user_name VARCHAR(25) NOT NULL, nombre VARCHAR(50) NOT NULL, apellido VARCHAR(100) NOT NULL, dni SMALLINT NOT NULL, telefono VARCHAR(11) NOT NULL, correo VARCHAR(100) NOT NULL, direccion VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producto (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(75) NOT NULL, precio NUMERIC(12, 2) NOT NULL, stock INT NOT NULL, descripcion LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carrito ADD CONSTRAINT FK_77E6BED5DE734E51 FOREIGN KEY (cliente_id) REFERENCES cliente (id)');
        $this->addSql('ALTER TABLE carrito_detalle ADD CONSTRAINT FK_412915887645698E FOREIGN KEY (producto_id) REFERENCES producto (id)');
        $this->addSql('ALTER TABLE carrito_detalle ADD CONSTRAINT FK_41291588DE2CF6E7 FOREIGN KEY (carrito_id) REFERENCES carrito (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE carrito DROP FOREIGN KEY FK_77E6BED5DE734E51');
        $this->addSql('ALTER TABLE carrito_detalle DROP FOREIGN KEY FK_412915887645698E');
        $this->addSql('ALTER TABLE carrito_detalle DROP FOREIGN KEY FK_41291588DE2CF6E7');
        $this->addSql('DROP TABLE carrito');
        $this->addSql('DROP TABLE carrito_detalle');
        $this->addSql('DROP TABLE cliente');
        $this->addSql('DROP TABLE producto');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
