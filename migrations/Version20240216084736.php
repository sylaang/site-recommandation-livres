<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240216084736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE livre (id INT AUTO_INCREMENT NOT NULL, couverture VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre_admin (livre_id INT NOT NULL, admin_id INT NOT NULL, INDEX IDX_1B0D951037D925CB (livre_id), INDEX IDX_1B0D9510642B8210 (admin_id), PRIMARY KEY(livre_id, admin_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE livre_admin ADD CONSTRAINT FK_1B0D951037D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_admin ADD CONSTRAINT FK_1B0D9510642B8210 FOREIGN KEY (admin_id) REFERENCES `admin` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livre_admin DROP FOREIGN KEY FK_1B0D951037D925CB');
        $this->addSql('ALTER TABLE livre_admin DROP FOREIGN KEY FK_1B0D9510642B8210');
        $this->addSql('DROP TABLE livre');
        $this->addSql('DROP TABLE livre_admin');
    }
}
