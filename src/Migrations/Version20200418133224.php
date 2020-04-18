<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200418133224 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE path (id INT AUTO_INCREMENT NOT NULL, start_location_id INT NOT NULL, end_location_id INT NOT NULL, driver_id INT NOT NULL, seats INT NOT NULL, start_time DATETIME NOT NULL, INDEX IDX_B548B0F5C3A313A (start_location_id), INDEX IDX_B548B0FC43C7F1 (end_location_id), INDEX IDX_B548B0FC3423909 (driver_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE path ADD CONSTRAINT FK_B548B0F5C3A313A FOREIGN KEY (start_location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE path ADD CONSTRAINT FK_B548B0FC43C7F1 FOREIGN KEY (end_location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE path ADD CONSTRAINT FK_B548B0FC3423909 FOREIGN KEY (driver_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE path_user ADD CONSTRAINT FK_E0FF5F1ED96C566B FOREIGN KEY (path_id) REFERENCES path (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE path_user ADD CONSTRAINT FK_E0FF5F1EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE path_user DROP FOREIGN KEY FK_E0FF5F1ED96C566B');
        $this->addSql('DROP TABLE path');
        $this->addSql('ALTER TABLE path_user DROP FOREIGN KEY FK_E0FF5F1EA76ED395');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
