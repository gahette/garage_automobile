<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230913114706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images ADD file VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE opening_hours CHANGE day day VARCHAR(255) NOT NULL, CHANGE am_open_hours am_open_hours VARCHAR(255) NOT NULL, CHANGE am_close_hours am_close_hours VARCHAR(255) NOT NULL, CHANGE pm_open_hours pm_open_hours VARCHAR(255) NOT NULL, CHANGE pm_close_hours pm_close_hours VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opening_hours CHANGE day day VARCHAR(255) DEFAULT NULL, CHANGE am_open_hours am_open_hours VARCHAR(255) DEFAULT NULL, CHANGE am_close_hours am_close_hours VARCHAR(255) DEFAULT NULL, CHANGE pm_open_hours pm_open_hours VARCHAR(255) DEFAULT NULL, CHANGE pm_close_hours pm_close_hours VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE images DROP file');
    }
}
