<?php

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181219193310 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE setting CHANGE title title VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE keywords keywords VARCHAR(255) NOT NULL, CHANGE company company VARCHAR(255) NOT NULL, CHANGE adress adress VARCHAR(255) NOT NULL, CHANGE fax fax VARCHAR(255) NOT NULL, CHANGE phone phone VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE smtpserver smtpserver VARCHAR(255) NOT NULL, CHANGE smtpmail smtpmail VARCHAR(255) NOT NULL, CHANGE smtppassword smtppassword VARCHAR(255) NOT NULL, CHANGE smtpport smtpport VARCHAR(255) NOT NULL, CHANGE aboutus aboutus VARCHAR(255) NOT NULL, CHANGE contact contact VARCHAR(255) NOT NULL, CHANGE referances referances VARCHAR(255) NOT NULL, CHANGE status status VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE setting CHANGE title title VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE description description VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE keywords keywords VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE company company VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE adress adress VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE fax fax VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE phone phone VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE smtpserver smtpserver VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE smtpmail smtpmail VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE smtppassword smtppassword VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE smtpport smtpport VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci, CHANGE aboutus aboutus LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE contact contact LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE referances referances LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE status status VARCHAR(255) DEFAULT \'\' COLLATE utf8mb4_unicode_ci');
    }
}
