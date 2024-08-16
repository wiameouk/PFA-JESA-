<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240816073208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE approval (id INT AUTO_INCREMENT NOT NULL, approval_status VARCHAR(255) NOT NULL, date_approuval DATE NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE approval_user (approval_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_5943CCA6FE65F000 (approval_id), INDEX IDX_5943CCA6A76ED395 (user_id), PRIMARY KEY(approval_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE idea (id INT AUTO_INCREMENT NOT NULL, appro_idea_id INT DEFAULT NULL, project_number VARCHAR(255) NOT NULL, confidentiality TINYINT(1) NOT NULL, project_phase VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, idea_source VARCHAR(255) NOT NULL, idea_status VARCHAR(255) NOT NULL, sectors_and_programs VARCHAR(255) NOT NULL, type_of_vc JSON NOT NULL COMMENT \'(DC2Type:json)\', department VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', title_of_vc VARCHAR(255) NOT NULL, customer_name VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_A8BCA453D1A5CE7 (appro_idea_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_idea (user_id INT NOT NULL, idea_id INT NOT NULL, INDEX IDX_700A868CA76ED395 (user_id), INDEX IDX_700A868C5B6FEF7D (idea_id), PRIMARY KEY(user_id, idea_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_approval (user_id INT NOT NULL, approval_id INT NOT NULL, INDEX IDX_F66D712BA76ED395 (user_id), INDEX IDX_F66D712BFE65F000 (approval_id), PRIMARY KEY(user_id, approval_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE approval_user ADD CONSTRAINT FK_5943CCA6FE65F000 FOREIGN KEY (approval_id) REFERENCES approval (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE approval_user ADD CONSTRAINT FK_5943CCA6A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE idea ADD CONSTRAINT FK_A8BCA453D1A5CE7 FOREIGN KEY (appro_idea_id) REFERENCES approval (id)');
        $this->addSql('ALTER TABLE user_idea ADD CONSTRAINT FK_700A868CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_idea ADD CONSTRAINT FK_700A868C5B6FEF7D FOREIGN KEY (idea_id) REFERENCES idea (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_approval ADD CONSTRAINT FK_F66D712BA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_approval ADD CONSTRAINT FK_F66D712BFE65F000 FOREIGN KEY (approval_id) REFERENCES approval (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE approval_user DROP FOREIGN KEY FK_5943CCA6FE65F000');
        $this->addSql('ALTER TABLE approval_user DROP FOREIGN KEY FK_5943CCA6A76ED395');
        $this->addSql('ALTER TABLE idea DROP FOREIGN KEY FK_A8BCA453D1A5CE7');
        $this->addSql('ALTER TABLE user_idea DROP FOREIGN KEY FK_700A868CA76ED395');
        $this->addSql('ALTER TABLE user_idea DROP FOREIGN KEY FK_700A868C5B6FEF7D');
        $this->addSql('ALTER TABLE user_approval DROP FOREIGN KEY FK_F66D712BA76ED395');
        $this->addSql('ALTER TABLE user_approval DROP FOREIGN KEY FK_F66D712BFE65F000');
        $this->addSql('DROP TABLE approval');
        $this->addSql('DROP TABLE approval_user');
        $this->addSql('DROP TABLE idea');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_idea');
        $this->addSql('DROP TABLE user_approval');
    }
}
