<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181229085556 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comments (id INT AUTO_INCREMENT NOT NULL, oyun_id INT NOT NULL, comment VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders DROP createdAt, DROP updatedAt, CHANGE shipinfo shipinfo VARCHAR(255) NOT NULL, CHANGE note note VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE games CHANGE status status VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE sales CHANGE oyun_id oyun_id VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE comments');
        $this->addSql('ALTER TABLE games CHANGE status status VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE description description LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE orders ADD createdAt DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, ADD updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, CHANGE shipinfo shipinfo VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE note note VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE sales CHANGE oyun_id oyun_id VARCHAR(255) DEFAULT \'\' NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
