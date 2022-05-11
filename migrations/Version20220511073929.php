<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220511073929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE report2 (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, area VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, year1 VARCHAR(255) NOT NULL, year2 VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE report3 (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, year VARCHAR(255) NOT NULL, age1 VARCHAR(255) NOT NULL, age2 VARCHAR(255) NOT NULL, age3 VARCHAR(255) NOT NULL, born1 VARCHAR(255) NOT NULL, born2 VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE report4 (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, year VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, age1 VARCHAR(255) NOT NULL, age2 VARCHAR(255) NOT NULL, age3 VARCHAR(255) NOT NULL, age4 VARCHAR(255) NOT NULL, age5 VARCHAR(255) NOT NULL, age6 VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE report5 (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, year VARCHAR(255) NOT NULL, women VARCHAR(255) NOT NULL, men VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE report2');
        $this->addSql('DROP TABLE report3');
        $this->addSql('DROP TABLE report4');
        $this->addSql('DROP TABLE report5');
    }
}
