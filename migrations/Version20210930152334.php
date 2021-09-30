<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210930152334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469C872EC465');
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469CDC2902E0');
        $this->addSql('DROP INDEX IDX_649B469CDC2902E0 ON statistic');
        $this->addSql('DROP INDEX IDX_649B469C872EC465 ON statistic');
        $this->addSql('ALTER TABLE statistic ADD beer_id INT NOT NULL, ADD client_id INT NOT NULL, DROP beer_id_id, DROP client_id_id');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469CD0989053 FOREIGN KEY (beer_id) REFERENCES beer (id)');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469C19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_649B469CD0989053 ON statistic (beer_id)');
        $this->addSql('CREATE INDEX IDX_649B469C19EB6921 ON statistic (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469CD0989053');
        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469C19EB6921');
        $this->addSql('DROP INDEX IDX_649B469CD0989053 ON statistic');
        $this->addSql('DROP INDEX IDX_649B469C19EB6921 ON statistic');
        $this->addSql('ALTER TABLE statistic ADD beer_id_id INT NOT NULL, ADD client_id_id INT NOT NULL, DROP beer_id, DROP client_id');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469C872EC465 FOREIGN KEY (beer_id_id) REFERENCES beer (id)');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469CDC2902E0 FOREIGN KEY (client_id_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_649B469CDC2902E0 ON statistic (client_id_id)');
        $this->addSql('CREATE INDEX IDX_649B469C872EC465 ON statistic (beer_id_id)');
    }
}
