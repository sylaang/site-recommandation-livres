<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240216125746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE livre_cat_livre (livre_id INT NOT NULL, cat_livre_id INT NOT NULL, INDEX IDX_BF7E2FDE37D925CB (livre_id), INDEX IDX_BF7E2FDEB5F16088 (cat_livre_id), PRIMARY KEY(livre_id, cat_livre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE livre_cat_livre ADD CONSTRAINT FK_BF7E2FDE37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_cat_livre ADD CONSTRAINT FK_BF7E2FDEB5F16088 FOREIGN KEY (cat_livre_id) REFERENCES cat_livre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_categorie_livre DROP FOREIGN KEY FK_A4005D1A37D925CB');
        $this->addSql('ALTER TABLE livre_categorie_livre DROP FOREIGN KEY FK_A4005D1AF5E64A1');
        $this->addSql('DROP TABLE categorie_livre');
        $this->addSql('DROP TABLE livre_categorie_livre');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie_livre (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE livre_categorie_livre (livre_id INT NOT NULL, categorie_livre_id INT NOT NULL, INDEX IDX_A4005D1A37D925CB (livre_id), INDEX IDX_A4005D1AF5E64A1 (categorie_livre_id), PRIMARY KEY(livre_id, categorie_livre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE livre_categorie_livre ADD CONSTRAINT FK_A4005D1A37D925CB FOREIGN KEY (livre_id) REFERENCES livre (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_categorie_livre ADD CONSTRAINT FK_A4005D1AF5E64A1 FOREIGN KEY (categorie_livre_id) REFERENCES categorie_livre (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livre_cat_livre DROP FOREIGN KEY FK_BF7E2FDE37D925CB');
        $this->addSql('ALTER TABLE livre_cat_livre DROP FOREIGN KEY FK_BF7E2FDEB5F16088');
        $this->addSql('DROP TABLE livre_cat_livre');
    }
}
