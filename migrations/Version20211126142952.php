<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211126142952 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, id_sender_id INT NOT NULL, id_receiver_id INT NOT NULL, sent_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', content LONGTEXT NOT NULL, INDEX IDX_B6BD307F76110FBA (id_sender_id), INDEX IDX_B6BD307FD5412041 (id_receiver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F76110FBA FOREIGN KEY (id_sender_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FD5412041 FOREIGN KEY (id_receiver_id) REFERENCES users (id)');
        $this->addSql('DROP INDEX UNIQ_E00CEDDEE5F14372 ON booking');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E00CEDDEE5F14372 ON booking (id_car_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP INDEX UNIQ_E00CEDDEE5F14372 ON booking');
        $this->addSql('CREATE INDEX UNIQ_E00CEDDEE5F14372 ON booking (id_car_id)');
    }
}
