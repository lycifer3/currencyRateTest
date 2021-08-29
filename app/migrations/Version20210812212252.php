<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Create tables currency and currency_rate
 */
final class Version20210812212252 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(3) NOT NULL, symbol VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency_rate (id INT AUTO_INCREMENT NOT NULL, base_currency_id INT NOT NULL, currency_exchange_id INT NOT NULL, cost DOUBLE PRECISION NOT NULL, datetime DATETIME NOT NULL, INDEX IDX_555B7C4D3101778E (base_currency_id), INDEX IDX_555B7C4DE7A78ADF (currency_exchange_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE currency_rate ADD CONSTRAINT FK_555B7C4D3101778E FOREIGN KEY (base_currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE currency_rate ADD CONSTRAINT FK_555B7C4DE7A78ADF FOREIGN KEY (currency_exchange_id) REFERENCES currency (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE currency_rate DROP FOREIGN KEY FK_555B7C4D3101778E');
        $this->addSql('ALTER TABLE currency_rate DROP FOREIGN KEY FK_555B7C4DE7A78ADF');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE currency_rate');
    }
}
