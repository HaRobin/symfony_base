<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240911064827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE burger_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE commentaire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE image_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE oignon_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pain_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sauce_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE burger (id INT NOT NULL, pain_id INT DEFAULT NULL, oignon_id INT DEFAULT NULL, image_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EFE35A0D64775A84 ON burger (pain_id)');
        $this->addSql('CREATE INDEX IDX_EFE35A0D8F038184 ON burger (oignon_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EFE35A0D3DA5256D ON burger (image_id)');
        $this->addSql('CREATE TABLE burger_sauce (burger_id INT NOT NULL, sauce_id INT NOT NULL, PRIMARY KEY(burger_id, sauce_id))');
        $this->addSql('CREATE INDEX IDX_F889AB0F17CE5090 ON burger_sauce (burger_id)');
        $this->addSql('CREATE INDEX IDX_F889AB0F7AB984B7 ON burger_sauce (sauce_id)');
        $this->addSql('CREATE TABLE commentaire (id INT NOT NULL, burger_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_67F068BC17CE5090 ON commentaire (burger_id)');
        $this->addSql('CREATE TABLE image (id INT NOT NULL, burger_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C53D045F17CE5090 ON image (burger_id)');
        $this->addSql('CREATE TABLE oignon (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pain (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE sauce (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE sauce_burger (sauce_id INT NOT NULL, burger_id INT NOT NULL, PRIMARY KEY(sauce_id, burger_id))');
        $this->addSql('CREATE INDEX IDX_DF62E3017AB984B7 ON sauce_burger (sauce_id)');
        $this->addSql('CREATE INDEX IDX_DF62E30117CE5090 ON sauce_burger (burger_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0D64775A84 FOREIGN KEY (pain_id) REFERENCES pain (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0D8F038184 FOREIGN KEY (oignon_id) REFERENCES oignon (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE burger ADD CONSTRAINT FK_EFE35A0D3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE burger_sauce ADD CONSTRAINT FK_F889AB0F17CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE burger_sauce ADD CONSTRAINT FK_F889AB0F7AB984B7 FOREIGN KEY (sauce_id) REFERENCES sauce (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC17CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F17CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sauce_burger ADD CONSTRAINT FK_DF62E3017AB984B7 FOREIGN KEY (sauce_id) REFERENCES sauce (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sauce_burger ADD CONSTRAINT FK_DF62E30117CE5090 FOREIGN KEY (burger_id) REFERENCES burger (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE burger_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE commentaire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE image_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE oignon_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pain_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sauce_id_seq CASCADE');
        $this->addSql('ALTER TABLE burger DROP CONSTRAINT FK_EFE35A0D64775A84');
        $this->addSql('ALTER TABLE burger DROP CONSTRAINT FK_EFE35A0D8F038184');
        $this->addSql('ALTER TABLE burger DROP CONSTRAINT FK_EFE35A0D3DA5256D');
        $this->addSql('ALTER TABLE burger_sauce DROP CONSTRAINT FK_F889AB0F17CE5090');
        $this->addSql('ALTER TABLE burger_sauce DROP CONSTRAINT FK_F889AB0F7AB984B7');
        $this->addSql('ALTER TABLE commentaire DROP CONSTRAINT FK_67F068BC17CE5090');
        $this->addSql('ALTER TABLE image DROP CONSTRAINT FK_C53D045F17CE5090');
        $this->addSql('ALTER TABLE sauce_burger DROP CONSTRAINT FK_DF62E3017AB984B7');
        $this->addSql('ALTER TABLE sauce_burger DROP CONSTRAINT FK_DF62E30117CE5090');
        $this->addSql('DROP TABLE burger');
        $this->addSql('DROP TABLE burger_sauce');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE oignon');
        $this->addSql('DROP TABLE pain');
        $this->addSql('DROP TABLE sauce');
        $this->addSql('DROP TABLE sauce_burger');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
