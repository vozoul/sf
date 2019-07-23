<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190723112446 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags_quack (tags_id INT NOT NULL, quack_id INT NOT NULL, INDEX IDX_E8B0B9378D7B4FB4 (tags_id), INDEX IDX_E8B0B937D3950CA9 (quack_id), PRIMARY KEY(tags_id, quack_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tags_quack ADD CONSTRAINT FK_E8B0B9378D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tags_quack ADD CONSTRAINT FK_E8B0B937D3950CA9 FOREIGN KEY (quack_id) REFERENCES quack (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quack DROP tags');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tags_quack DROP FOREIGN KEY FK_E8B0B9378D7B4FB4');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE tags_quack');
        $this->addSql('ALTER TABLE quack ADD tags LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:array)\'');
    }
}
