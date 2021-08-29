<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Add unique index to currency code
 */
final class Version20210828220654 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6956883F77153098 ON currency (code)');
        $this->addSql('ALTER TABLE currency_rate RENAME INDEX idx_555b7c4de7a78adf TO IDX_555B7C4DD947DF01');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX UNIQ_6956883F77153098 ON currency');
        $this->addSql('ALTER TABLE currency_rate RENAME INDEX idx_555b7c4dd947df01 TO IDX_555B7C4DE7A78ADF');
    }
}
