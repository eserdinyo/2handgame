<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181127112854 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE admincategory (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, keywords VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE games DROP createdAt, DROP updatedAt, CHANGE status status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE sales CHANGE oyun_id oyun_id VARCHAR(255) NOT NULL, CHANGE status status VARCHAR(255) NOT NULL, CHANGE username username VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE admincategory');
        $this->addSql('ALTER TABLE games ADD createdAt DATETIME DEFAULT CURRENT_TIMESTAMP, ADD updatedAt DATETIME DEFAULT NULL, CHANGE status status VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE sales CHANGE oyun_id oyun_id VARCHAR(11) DEFAULT \'0\' NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE username username VARCHAR(255) DEFAULT \'eserdinyo\' COLLATE utf8mb4_unicode_ci, CHANGE status status VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
