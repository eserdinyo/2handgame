<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181219090401 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE setting (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, keywords VARCHAR(255) NOT NULL, company VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, fax VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, smtpserver VARCHAR(255) NOT NULL, smtpmail VARCHAR(255) NOT NULL, smtppassword VARCHAR(255) NOT NULL, smtpport VARCHAR(255) NOT NULL, aboutus VARCHAR(255) NOT NULL, contact VARCHAR(255) NOT NULL, referances VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category DROP createdAt, DROP updatedAt');
        $this->addSql('ALTER TABLE games DROP createdAt, DROP updatedAt');
        $this->addSql('ALTER TABLE image DROP createdAt, DROP updatedAt');
        $this->addSql('ALTER TABLE messages DROP createdAt, DROP updatedAt, CHANGE name name VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE subject subject VARCHAR(255) NOT NULL, CHANGE message message VARCHAR(255) NOT NULL, CHANGE comment comment VARCHAR(255) NOT NULL, CHANGE status status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE sliders DROP createdAt, DROP updatedAt');
        $this->addSql('ALTER TABLE sales DROP createdAt, DROP updatedAt');
        $this->addSql('ALTER TABLE users DROP createdAt, DROP updatedAt');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE setting');
        $this->addSql('ALTER TABLE category ADD createdAt DATETIME DEFAULT CURRENT_TIMESTAMP, ADD updatedAt DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE games ADD createdAt DATETIME DEFAULT CURRENT_TIMESTAMP, ADD updatedAt DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD createdAt DATETIME DEFAULT CURRENT_TIMESTAMP, ADD updatedAt DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE messages ADD createdAt DATETIME DEFAULT CURRENT_TIMESTAMP, ADD updatedAt DATETIME DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE subject subject VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE message message VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE comment comment VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE status status VARCHAR(255) DEFAULT \'Okunacak\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE sales ADD createdAt DATETIME DEFAULT CURRENT_TIMESTAMP, ADD updatedAt DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sliders ADD createdAt DATETIME DEFAULT CURRENT_TIMESTAMP, ADD updatedAt DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD createdAt DATETIME DEFAULT CURRENT_TIMESTAMP, ADD updatedAt DATETIME DEFAULT NULL');
    }
}
