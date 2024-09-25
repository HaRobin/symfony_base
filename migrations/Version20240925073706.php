<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240925073706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_efe35a0d3da5256d');
        $this->addSql('CREATE INDEX IDX_EFE35A0D3DA5256D ON burger (image_id)');
        $this->addSql('ALTER TABLE image DROP CONSTRAINT fk_c53d045f17ce5090');
        $this->addSql('DROP INDEX uniq_c53d045f17ce5090');
        $this->addSql('ALTER TABLE image DROP burger_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX IDX_EFE35A0D3DA5256D');
        $this->addSql('CREATE UNIQUE INDEX uniq_efe35a0d3da5256d ON burger (image_id)');
        $this->addSql('ALTER TABLE image ADD burger_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT fk_c53d045f17ce5090 FOREIGN KEY (burger_id) REFERENCES burger (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_c53d045f17ce5090 ON image (burger_id)');
    }
}
