<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210724105326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_movies (
        id CHAR(36) NOT NULL COMMENT \'(DC2Type:Id)\', 
        user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:Id)\', 
        movie_id CHAR(36) NOT NULL COMMENT \'(DC2Type:Id)\', 
        rating FLOAT DEFAULT NULL,
        created_at DATETIME NOT NULL,
        updated_at DATETIME NOT NULL,
        INDEX IDX_USER_ID (user_id), INDEX IDX_movie_ID (movie_id), PRIMARY KEY(user_id, movie_id)) 
        DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql('CREATE UNIQUE INDEX user_movies_unique_index ON user_movies(user_id, movie_id);');
        $this->addSql('ALTER TABLE user_movies ADD CONSTRAINT FK_USER_ID FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_movies ADD CONSTRAINT FK_MOVIE_ID FOREIGN KEY (movie_id) REFERENCES movies (id)');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_movies DROP FOREIGN KEY FK_MOVIE_ID');
        $this->addSql('ALTER TABLE user_movies DROP FOREIGN KEY FK_USER_ID');
        $this->addSql('DROP table user_movies');
    }
}
