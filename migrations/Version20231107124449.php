<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231107124449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opinions DROP FOREIGN KEY FK_BEAF78D067B3B43D');
        $this->addSql('DROP INDEX UNIQ_BEAF78D0989D9B62 ON opinions');
        $this->addSql('DROP INDEX IDX_BEAF78D067B3B43D ON opinions');
        $this->addSql('ALTER TABLE opinions DROP users_id, DROP slug');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE opinions ADD users_id INT DEFAULT NULL, ADD slug VARCHAR(128) NOT NULL');
        $this->addSql('ALTER TABLE opinions ADD CONSTRAINT FK_BEAF78D067B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BEAF78D0989D9B62 ON opinions (slug)');
        $this->addSql('CREATE INDEX IDX_BEAF78D067B3B43D ON opinions (users_id)');
    }
}
