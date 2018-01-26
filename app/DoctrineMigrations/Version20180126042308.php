<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180126042308 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, profile_id INT DEFAULT NULL, client_id INT DEFAULT NULL, username VARCHAR(45) NOT NULL, slug VARCHAR(255) DEFAULT NULL, device_code VARCHAR(100) DEFAULT NULL, password VARCHAR(100) DEFAULT NULL, salt VARCHAR(45) DEFAULT NULL, dni VARCHAR(8) DEFAULT NULL, name VARCHAR(100) NOT NULL, last_name VARCHAR(100) DEFAULT NULL, dob DATE DEFAULT NULL, address VARCHAR(100) DEFAULT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(45) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, user_create INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, user_update INT DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\' NOT NULL, last_access DATETIME DEFAULT NULL, INDEX FK_8D93D649CCFA12B8 (profile_id), INDEX fk_user_client1_idx (client_id), UNIQUE INDEX email_UNIQUE (email), UNIQUE INDEX username_UNIQUE (username), UNIQUE INDEX dni_UNIQUE (dni), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_has_point_of_sale (user_id INT NOT NULL, point_of_sale_id INT NOT NULL, INDEX IDX_AD4176D6A76ED395 (user_id), INDEX IDX_AD4176D66B7E9A73 (point_of_sale_id), PRIMARY KEY(user_id, point_of_sale_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pointofsale (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(45) DEFAULT NULL, name VARCHAR(150) NOT NULL, slug VARCHAR(150) DEFAULT NULL, created_at DATETIME NOT NULL, user_create INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, user_update INT DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupofusers (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(45) DEFAULT NULL, name VARCHAR(150) NOT NULL, slug VARCHAR(150) DEFAULT NULL, created_at DATETIME NOT NULL, user_create INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, user_update INT DEFAULT NULL, is_active TINYINT(1) DEFAULT \'1\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649CCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64919EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE user_has_point_of_sale ADD CONSTRAINT FK_AD4176D6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_has_point_of_sale ADD CONSTRAINT FK_AD4176D66B7E9A73 FOREIGN KEY (point_of_sale_id) REFERENCES pointofsale (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_has_point_of_sale DROP FOREIGN KEY FK_AD4176D6A76ED395');
        $this->addSql('ALTER TABLE user_has_point_of_sale DROP FOREIGN KEY FK_AD4176D66B7E9A73');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_has_point_of_sale');
        $this->addSql('DROP TABLE pointofsale');
        $this->addSql('DROP TABLE groupofusers');
    }
}
