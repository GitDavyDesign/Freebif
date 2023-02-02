<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230202145155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE freelance (id INT AUTO_INCREMENT NOT NULL, categories LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', experience LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', skills LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', localisation VARCHAR(255) NOT NULL, choice_localisation LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', free_phone VARCHAR(255) DEFAULT NULL, presentation VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, portfolio VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE freelance');
    }
}
