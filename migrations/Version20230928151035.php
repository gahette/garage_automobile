<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230928151035 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images ADD attachment VARCHAR(255) DEFAULT NULL, ADD attachment_file VARCHAR(255) DEFAULT NULL, DROP path, DROP file');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images ADD path VARCHAR(255) DEFAULT NULL, ADD file VARCHAR(255) DEFAULT NULL, DROP attachment, DROP attachment_file');
    }
}
