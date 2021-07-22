<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210722181732 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movies (
        id CHAR(36) NOT NULL, 
        ext_id CHAR(36) NOT NULL, 
        title TEXT NOT NULL, 
        startYear DATETIME NOT NULL,
        duration INT DEFAULT NULL, 
        PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');

        $this->addSql("SET @@SESSION.sql_mode='ALLOW_INVALID_DATES'");

        $this->addSql("INSERT INTO movies
        SELECT UUID(), C1, C3, STR_TO_DATE(C6, '%Y'), C8 FROM data
        WHERE C5 = 0 AND C6 > 1949 AND C2 = 'movie'
        ");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE movies');
    }
}
