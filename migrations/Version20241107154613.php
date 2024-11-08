<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241107154613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74DE3797A94 FOREIGN KEY (seance_id) REFERENCES seance (id)');
        $this->addSql('CREATE INDEX IDX_E418C74DE3797A94 ON exercice (seance_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice DROP FOREIGN KEY FK_E418C74DE3797A94');
        $this->addSql('DROP INDEX IDX_E418C74DE3797A94 ON exercice');
    }
}
