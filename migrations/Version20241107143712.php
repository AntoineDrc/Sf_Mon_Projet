<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241107143712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_DF7DFD0EBCF5E72D ON seance (categorie_id)');
        $this->addSql('ALTER TABLE serie ADD exercice_id INT NOT NULL');
        $this->addSql('ALTER TABLE serie ADD CONSTRAINT FK_AA3A933489D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id)');
        $this->addSql('CREATE INDEX IDX_AA3A933489D40298 ON serie (exercice_id)');
        $this->addSql('ALTER TABLE user ADD avatar VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0EBCF5E72D');
        $this->addSql('DROP INDEX IDX_DF7DFD0EBCF5E72D ON seance');
        $this->addSql('ALTER TABLE serie DROP FOREIGN KEY FK_AA3A933489D40298');
        $this->addSql('DROP INDEX IDX_AA3A933489D40298 ON serie');
        $this->addSql('ALTER TABLE serie DROP exercice_id');
        $this->addSql('ALTER TABLE user DROP avatar');
    }
}
