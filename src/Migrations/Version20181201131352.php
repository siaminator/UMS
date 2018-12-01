<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181201131352 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ums_group (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ums_member (group_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_68A214AFFE54D947 (group_id), INDEX IDX_68A214AFA76ED395 (user_id), PRIMARY KEY(group_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ums_user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ums_member ADD CONSTRAINT FK_68A214AFFE54D947 FOREIGN KEY (group_id) REFERENCES ums_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ums_member ADD CONSTRAINT FK_68A214AFA76ED395 FOREIGN KEY (user_id) REFERENCES ums_user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ums_member DROP FOREIGN KEY FK_68A214AFFE54D947');
        $this->addSql('ALTER TABLE ums_member DROP FOREIGN KEY FK_68A214AFA76ED395');
        $this->addSql('DROP TABLE ums_group');
        $this->addSql('DROP TABLE ums_member');
        $this->addSql('DROP TABLE ums_user');
    }
}
