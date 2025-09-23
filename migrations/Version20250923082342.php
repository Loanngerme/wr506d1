<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250923082342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acteur ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE dob dob DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', CHANGE dod dod DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acteur DROP created_at, CHANGE dob dob DATETIME NOT NULL, CHANGE dod dod DATETIME DEFAULT NULL');
    }
}
