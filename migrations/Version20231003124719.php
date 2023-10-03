<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231003124719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars ADD user_id INT DEFAULT NULL, ADD relation VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_95C71D14A76ED395 ON cars (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14A76ED395');
        $this->addSql('DROP INDEX IDX_95C71D14A76ED395 ON cars');
        $this->addSql('ALTER TABLE cars DROP user_id, DROP relation');
    }
}
