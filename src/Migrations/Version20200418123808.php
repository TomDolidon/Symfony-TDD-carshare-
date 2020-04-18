<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200418123808 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, lat DOUBLE PRECISION NOT NULL, lon DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE path_user (path_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_E0FF5F1ED96C566B (path_id), INDEX IDX_E0FF5F1EA76ED395 (user_id), PRIMARY KEY(path_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE path_user ADD CONSTRAINT FK_E0FF5F1ED96C566B FOREIGN KEY (path_id) REFERENCES path (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE path_user ADD CONSTRAINT FK_E0FF5F1EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE path ADD start_location_id INT NOT NULL, ADD end_location_id INT NOT NULL, ADD driver_id INT NOT NULL, ADD seats INT NOT NULL, ADD start_time DATETIME NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('CREATE INDEX IDX_B548B0F5C3A313A ON path (start_location_id)');
        $this->addSql('CREATE INDEX IDX_B548B0FC43C7F1 ON path (end_location_id)');
        $this->addSql('CREATE INDEX IDX_B548B0FC3423909 ON path (driver_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE path DROP FOREIGN KEY FK_B548B0F5C3A313A');
        $this->addSql('ALTER TABLE path DROP FOREIGN KEY FK_B548B0FC43C7F1');
        $this->addSql('ALTER TABLE path DROP FOREIGN KEY FK_B548B0FC3423909');
        $this->addSql('ALTER TABLE path_user DROP FOREIGN KEY FK_E0FF5F1EA76ED395');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE path_user');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE path MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX IDX_B548B0F5C3A313A ON path');
        $this->addSql('DROP INDEX IDX_B548B0FC43C7F1 ON path');
        $this->addSql('DROP INDEX IDX_B548B0FC3423909 ON path');
        $this->addSql('ALTER TABLE path DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE path DROP start_location_id, DROP end_location_id, DROP driver_id, DROP seats, DROP start_time, CHANGE id id INT NOT NULL');
    }
}
