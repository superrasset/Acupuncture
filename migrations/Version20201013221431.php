<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201013221431 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, professeur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE synthese ADD matiere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE synthese ADD CONSTRAINT FK_89E59D02F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id)');
        $this->addSql('CREATE INDEX IDX_89E59D02F46CD258 ON synthese (matiere_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE synthese DROP FOREIGN KEY FK_89E59D02F46CD258');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP INDEX IDX_89E59D02F46CD258 ON synthese');
        $this->addSql('ALTER TABLE synthese DROP matiere_id');
    }
}
