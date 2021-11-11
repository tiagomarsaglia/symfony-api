<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211111013417 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carteira (id INT AUTO_INCREMENT NOT NULL, usuario_id INT DEFAULT NULL, saldo DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_307D6881DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operacao (id INT AUTO_INCREMENT NOT NULL, carteira_id INT NOT NULL, tipo_operacao INT NOT NULL, valor DOUBLE PRECISION NOT NULL, create_at DATETIME NOT NULL, INDEX IDX_334A53235265899 (carteira_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pessoa (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pessoa_fisica (id INT AUTO_INCREMENT NOT NULL, pessoa_id INT DEFAULT NULL, cpf VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_35AF3375DF6FA0A5 (pessoa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pessoa_juridica (id INT AUTO_INCREMENT NOT NULL, pessoa_id INT DEFAULT NULL, cnpj VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_776DFB0EDF6FA0A5 (pessoa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo_operacao (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, pessoa_id INT NOT NULL, email VARCHAR(255) NOT NULL, senha VARCHAR(255) NOT NULL, INDEX IDX_2265B05DDF6FA0A5 (pessoa_id), UNIQUE INDEX TB_USUARIO_DS_EMAIL_UQ (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carteira ADD CONSTRAINT FK_307D6881DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE operacao ADD CONSTRAINT FK_334A53235265899 FOREIGN KEY (carteira_id) REFERENCES carteira (id)');
        $this->addSql('ALTER TABLE pessoa_fisica ADD CONSTRAINT FK_35AF3375DF6FA0A5 FOREIGN KEY (pessoa_id) REFERENCES pessoa (id)');
        $this->addSql('ALTER TABLE pessoa_juridica ADD CONSTRAINT FK_776DFB0EDF6FA0A5 FOREIGN KEY (pessoa_id) REFERENCES pessoa (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05DDF6FA0A5 FOREIGN KEY (pessoa_id) REFERENCES pessoa (id)');

        $this->addSql('INSERT INTO tipo_operacao (id, nome) VALUES(1, \'sacar\')');
        $this->addSql('INSERT INTO tipo_operacao (id, nome) VALUES(2, \'receber\')');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE operacao DROP FOREIGN KEY FK_334A53235265899');
        $this->addSql('ALTER TABLE pessoa_fisica DROP FOREIGN KEY FK_35AF3375DF6FA0A5');
        $this->addSql('ALTER TABLE pessoa_juridica DROP FOREIGN KEY FK_776DFB0EDF6FA0A5');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05DDF6FA0A5');
        $this->addSql('ALTER TABLE carteira DROP FOREIGN KEY FK_307D6881DB38439E');
        $this->addSql('DROP TABLE carteira');
        $this->addSql('DROP TABLE operacao');
        $this->addSql('DROP TABLE pessoa');
        $this->addSql('DROP TABLE pessoa_fisica');
        $this->addSql('DROP TABLE pessoa_juridica');
        $this->addSql('DROP TABLE tipo_operacao');
        $this->addSql('DROP TABLE usuario');
    }
}
