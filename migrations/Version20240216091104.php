<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240216091104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achat_url (id INT AUTO_INCREMENT NOT NULL, livres_id INT DEFAULT NULL, url LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_1C8F3D2BEBF07F38 (livres_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_livre (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livre_categorie_livre (livre_id INT NOT NULL, categorie_livre_id INT NOT NULL, INDEX IDX_A4005D1A37D925CB (livre_id), INDEX IDX_A4005D1AF5E64A1 (categorie_livre_id), PRIMARY KEY(livre_id, categorie_livre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE achat_url ADD CONSTRAINT FK_1C8F3D2BEBF07F38 FOREIGN KEY (livres_id) REFERENCES livre (id)');
        $this->addSql('ALTER TABLE livre_categorie_livre ADD CONSTRAINT FK_A4005D1A37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_categorie_livre ADD CONSTRAINT FK_A4005D1AF5E64A1 FOREIGN KEY (categorie_livre_id) REFERENCES categorie_livre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE achat_url DROP FOREIGN KEY FK_1C8F3D2BEBF07F38');
        $this->addSql('ALTER TABLE livre_categorie_livre DROP FOREIGN KEY FK_A4005D1A37D925CB');
        $this->addSql('ALTER TABLE livre_categorie_livre DROP FOREIGN KEY FK_A4005D1AF5E64A1');
        $this->addSql('DROP TABLE achat_url');
        $this->addSql('DROP TABLE categorie_livre');
        $this->addSql('DROP TABLE livre_categorie_livre');
    }
}
