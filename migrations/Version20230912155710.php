<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230912155710 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Rectification BdD';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messages ADD cars_id INT NOT NULL, ADD phone VARCHAR(255) NOT NULL, ADD content LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E968702F506 FOREIGN KEY (cars_id) REFERENCES cars (id)');
        $this->addSql('CREATE INDEX IDX_DB021E968702F506 ON messages (cars_id)');
        $this->addSql('ALTER TABLE opening_hours CHANGE day day VARCHAR(255) NOT NULL, CHANGE am_open_hours am_open_hours VARCHAR(255) NOT NULL, CHANGE am_close_hours am_close_hours VARCHAR(255) NOT NULL, CHANGE pm_open_hours pm_open_hours VARCHAR(255) NOT NULL, CHANGE pm_close_hours pm_close_hours VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opening_hours CHANGE day day VARCHAR(255) DEFAULT NULL, CHANGE am_open_hours am_open_hours VARCHAR(255) DEFAULT NULL, CHANGE am_close_hours am_close_hours VARCHAR(255) DEFAULT NULL, CHANGE pm_open_hours pm_open_hours VARCHAR(255) DEFAULT NULL, CHANGE pm_close_hours pm_close_hours VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E968702F506');
        $this->addSql('DROP INDEX IDX_DB021E968702F506 ON messages');
        $this->addSql('ALTER TABLE messages DROP cars_id, DROP phone, DROP content');
    }
}
