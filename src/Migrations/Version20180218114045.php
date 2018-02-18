<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180218114045 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE configs (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date_created DATETIME NOT NULL, date_modified DATETIME NOT NULL, api_key VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE config_items (id INT AUTO_INCREMENT NOT NULL, config_id INT DEFAULT NULL, item_key VARCHAR(255) NOT NULL, item_value VARCHAR(255) NOT NULL, type SMALLINT NOT NULL, environment SMALLINT NOT NULL, INDEX IDX_5C33BB0D24DB0683 (config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE config_items ADD CONSTRAINT FK_5C33BB0D24DB0683 FOREIGN KEY (config_id) REFERENCES configs (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE config_items DROP FOREIGN KEY FK_5C33BB0D24DB0683');
        $this->addSql('DROP TABLE configs');
        $this->addSql('DROP TABLE config_items');
    }
}
