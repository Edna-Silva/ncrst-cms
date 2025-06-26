<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250625020323 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ai_initiatives (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, participants VARCHAR(100) DEFAULT NULL, projects VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE biotech_lab_services (id INT AUTO_INCREMENT NOT NULL, biotech_labs_id INT NOT NULL, service VARCHAR(100) DEFAULT NULL, INDEX IDX_A169FB2ED07B8D0 (biotech_labs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE biotech_labs (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, location VARCHAR(255) DEFAULT NULL, equipment LONGTEXT DEFAULT NULL, cerification VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE board_commissioner_committees (id INT AUTO_INCREMENT NOT NULL, board_commissioner_id INT NOT NULL, committee VARCHAR(100) DEFAULT NULL, INDEX IDX_2848A490A35FD9D8 (board_commissioner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE board_commissioners (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, role VARCHAR(100) NOT NULL, expertise VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_departments (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) DEFAULT NULL, contact VARCHAR(100) DEFAULT NULL, phone VARCHAR(50) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE council_members (id INT AUTO_INCREMENT NOT NULL, council_id INT NOT NULL, name VARCHAR(100) DEFAULT NULL, role VARCHAR(50) DEFAULT NULL, expertise VARCHAR(255) DEFAULT NULL, institution VARCHAR(255) DEFAULT NULL, community VARCHAR(255) DEFAULT NULL, INDEX IDX_323826FB970B0D6D (council_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE councils (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, members_count INT DEFAULT NULL, link VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ecosystem_partner_examples (id INT AUTO_INCREMENT NOT NULL, ecosystem_partner_id INT NOT NULL, example VARCHAR(100) DEFAULT NULL, INDEX IDX_F2CBD1493D9AD258 (ecosystem_partner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ecosystem_partners (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) DEFAULT NULL, partner_count INT DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE iks_council_members (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) DEFAULT NULL, role VARCHAR(100) DEFAULT NULL, expertise VARCHAR(255) DEFAULT NULL, community VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE iks_iniative_outcomes (id INT AUTO_INCREMENT NOT NULL, iks_iniatives_id INT NOT NULL, outcome VARCHAR(255) DEFAULT NULL, INDEX IDX_5AC6E1B7A71B9DDC (iks_iniatives_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE iks_iniatives (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, timeline VARCHAR(100) DEFAULT NULL, communities VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE iks_knowledge_area_examples (id INT AUTO_INCREMENT NOT NULL, iks_knowlegde_area_id INT NOT NULL, example VARCHAR(255) DEFAULT NULL, INDEX IDX_9A12100045C8A10C (iks_knowlegde_area_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE iks_knowledge_areas (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) DEFAULT NULL, description LONGTEXT DEFAULT NULL, icon VARCHAR(50) DEFAULT NULL, color VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE iks_resources (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, type VARCHAR(50) DEFAULT NULL, acess VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE innovation_challenge_categories (id INT AUTO_INCREMENT NOT NULL, innovation_challenge_id INT NOT NULL, category VARCHAR(100) DEFAULT NULL, INDEX IDX_B076BC7F62B6D74 (innovation_challenge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE innovation_challenges (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, duration VARCHAR(100) DEFAULT NULL, participants VARCHAR(100) DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, deadline DATE DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE innovators (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, company VARCHAR(255) DEFAULT NULL, sector VARCHAR(100) DEFAULT NULL, innovation LONGTEXT DEFAULT NULL, impact LONGTEXT DEFAULT NULL, funding VARCHAR(255) DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE internship_benefits (id INT AUTO_INCREMENT NOT NULL, internship_programs_id INT NOT NULL, benefit VARCHAR(100) DEFAULT NULL, INDEX IDX_863A23471FB5CBC6 (internship_programs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE internship_departments (id INT AUTO_INCREMENT NOT NULL, internship_programs_id INT NOT NULL, department VARCHAR(100) DEFAULT NULL, INDEX IDX_E819F2E1FB5CBC6 (internship_programs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE internship_programs (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, duration VARCHAR(50) DEFAULT NULL, intake VARCHAR(100) DEFAULT NULL, eligibility VARCHAR(255) DEFAULT NULL, stipend VARCHAR(100) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news_articles (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, title VARCHAR(255) NOT NULL, excerpt LONGTEXT DEFAULT NULL, content LONGTEXT DEFAULT NULL, read_time VARCHAR(20) DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, featured TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_F6E3923912469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news_categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE procurement_bids (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, category VARCHAR(50) DEFAULT NULL, reference VARCHAR(50) DEFAULT NULL, description LONGTEXT DEFAULT NULL, value VARCHAR(100) DEFAULT NULL, closing_date DATE DEFAULT NULL, publish_date DATE DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, is_awarded TINYINT(1) DEFAULT NULL, vendor VARCHAR(255) DEFAULT NULL, awarded_value VARCHAR(100) NOT NULL, awarded_date DATE DEFAULT NULL, contract_period VARCHAR(50) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE procurement_documents (id INT AUTO_INCREMENT NOT NULL, procurement_bids_id INT NOT NULL, document_name VARCHAR(100) DEFAULT NULL, INDEX IDX_5B3B776C206161D1 (procurement_bids_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE research_grants (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, deadline DATE DEFAULT NULL, amount VARCHAR(100) DEFAULT NULL, category VARCHAR(100) DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE research_permits (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, file_type VARCHAR(10) DEFAULT NULL, size VARCHAR(20) DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE research_priorities (id INT AUTO_INCREMENT NOT NULL, priority VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resource_categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resources (id INT AUTO_INCREMENT NOT NULL, resource_categories_id INT NOT NULL, title VARCHAR(255) NOT NULL, yer VARCHAR(10) DEFAULT NULL, description LONGTEXT DEFAULT NULL, file_type VARCHAR(10) DEFAULT NULL, size VARCHAR(20) NOT NULL, downloads INT DEFAULT NULL, date DATE DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_EF66EBAEEBFE3271 (resource_categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE science_events (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, date DATE DEFAULT NULL, location VARCHAR(100) DEFAULT NULL, category VARCHAR(50) DEFAULT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE science_programs (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, icon VARCHAR(50) DEFAULT NULL, color VARCHAR(50) DEFAULT NULL, link VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE uploads (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, file_name VARCHAR(255) DEFAULT NULL, file_path VARCHAR(255) NOT NULL, file_type VARCHAR(50) DEFAULT NULL, file_size INT DEFAULT NULL, uploaded_at DATETIME NOT NULL, INDEX IDX_96117F18A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, password_hash VARCHAR(255) NOT NULL, role VARCHAR(100) NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacancies (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, department VARCHAR(100) DEFAULT NULL, location VARCHAR(100) DEFAULT NULL, type VARCHAR(50) NOT NULL, level VARCHAR(50) DEFAULT NULL, closing_date DATE DEFAULT NULL, publish_date DATE DEFAULT NULL, salary VARCHAR(100) DEFAULT NULL, create_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacancy_requirements (id INT AUTO_INCREMENT NOT NULL, vacancy_id INT NOT NULL, requirement LONGTEXT DEFAULT NULL, INDEX IDX_2A7C5349433B78C4 (vacancy_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacancy_responsabilities (id INT AUTO_INCREMENT NOT NULL, vacancy_id INT NOT NULL, responsability LONGTEXT DEFAULT NULL, INDEX IDX_F2ED61C5433B78C4 (vacancy_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE biotech_lab_services ADD CONSTRAINT FK_A169FB2ED07B8D0 FOREIGN KEY (biotech_labs_id) REFERENCES biotech_labs (id)');
        $this->addSql('ALTER TABLE board_commissioner_committees ADD CONSTRAINT FK_2848A490A35FD9D8 FOREIGN KEY (board_commissioner_id) REFERENCES board_commissioners (id)');
        $this->addSql('ALTER TABLE council_members ADD CONSTRAINT FK_323826FB970B0D6D FOREIGN KEY (council_id) REFERENCES councils (id)');
        $this->addSql('ALTER TABLE ecosystem_partner_examples ADD CONSTRAINT FK_F2CBD1493D9AD258 FOREIGN KEY (ecosystem_partner_id) REFERENCES ecosystem_partners (id)');
        $this->addSql('ALTER TABLE iks_iniative_outcomes ADD CONSTRAINT FK_5AC6E1B7A71B9DDC FOREIGN KEY (iks_iniatives_id) REFERENCES iks_iniatives (id)');
        $this->addSql('ALTER TABLE iks_knowledge_area_examples ADD CONSTRAINT FK_9A12100045C8A10C FOREIGN KEY (iks_knowlegde_area_id) REFERENCES iks_knowledge_areas (id)');
        $this->addSql('ALTER TABLE innovation_challenge_categories ADD CONSTRAINT FK_B076BC7F62B6D74 FOREIGN KEY (innovation_challenge_id) REFERENCES innovation_challenges (id)');
        $this->addSql('ALTER TABLE internship_benefits ADD CONSTRAINT FK_863A23471FB5CBC6 FOREIGN KEY (internship_programs_id) REFERENCES internship_programs (id)');
        $this->addSql('ALTER TABLE internship_departments ADD CONSTRAINT FK_E819F2E1FB5CBC6 FOREIGN KEY (internship_programs_id) REFERENCES internship_programs (id)');
        $this->addSql('ALTER TABLE news_articles ADD CONSTRAINT FK_F6E3923912469DE2 FOREIGN KEY (category_id) REFERENCES news_categories (id)');
        $this->addSql('ALTER TABLE procurement_documents ADD CONSTRAINT FK_5B3B776C206161D1 FOREIGN KEY (procurement_bids_id) REFERENCES procurement_bids (id)');
        $this->addSql('ALTER TABLE resources ADD CONSTRAINT FK_EF66EBAEEBFE3271 FOREIGN KEY (resource_categories_id) REFERENCES resource_categories (id)');
        $this->addSql('ALTER TABLE uploads ADD CONSTRAINT FK_96117F18A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vacancy_requirements ADD CONSTRAINT FK_2A7C5349433B78C4 FOREIGN KEY (vacancy_id) REFERENCES vacancies (id)');
        $this->addSql('ALTER TABLE vacancy_responsabilities ADD CONSTRAINT FK_F2ED61C5433B78C4 FOREIGN KEY (vacancy_id) REFERENCES vacancies (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biotech_lab_services DROP FOREIGN KEY FK_A169FB2ED07B8D0');
        $this->addSql('ALTER TABLE board_commissioner_committees DROP FOREIGN KEY FK_2848A490A35FD9D8');
        $this->addSql('ALTER TABLE council_members DROP FOREIGN KEY FK_323826FB970B0D6D');
        $this->addSql('ALTER TABLE ecosystem_partner_examples DROP FOREIGN KEY FK_F2CBD1493D9AD258');
        $this->addSql('ALTER TABLE iks_iniative_outcomes DROP FOREIGN KEY FK_5AC6E1B7A71B9DDC');
        $this->addSql('ALTER TABLE iks_knowledge_area_examples DROP FOREIGN KEY FK_9A12100045C8A10C');
        $this->addSql('ALTER TABLE innovation_challenge_categories DROP FOREIGN KEY FK_B076BC7F62B6D74');
        $this->addSql('ALTER TABLE internship_benefits DROP FOREIGN KEY FK_863A23471FB5CBC6');
        $this->addSql('ALTER TABLE internship_departments DROP FOREIGN KEY FK_E819F2E1FB5CBC6');
        $this->addSql('ALTER TABLE news_articles DROP FOREIGN KEY FK_F6E3923912469DE2');
        $this->addSql('ALTER TABLE procurement_documents DROP FOREIGN KEY FK_5B3B776C206161D1');
        $this->addSql('ALTER TABLE resources DROP FOREIGN KEY FK_EF66EBAEEBFE3271');
        $this->addSql('ALTER TABLE uploads DROP FOREIGN KEY FK_96117F18A76ED395');
        $this->addSql('ALTER TABLE vacancy_requirements DROP FOREIGN KEY FK_2A7C5349433B78C4');
        $this->addSql('ALTER TABLE vacancy_responsabilities DROP FOREIGN KEY FK_F2ED61C5433B78C4');
        $this->addSql('DROP TABLE ai_initiatives');
        $this->addSql('DROP TABLE biotech_lab_services');
        $this->addSql('DROP TABLE biotech_labs');
        $this->addSql('DROP TABLE board_commissioner_committees');
        $this->addSql('DROP TABLE board_commissioners');
        $this->addSql('DROP TABLE contact_departments');
        $this->addSql('DROP TABLE council_members');
        $this->addSql('DROP TABLE councils');
        $this->addSql('DROP TABLE ecosystem_partner_examples');
        $this->addSql('DROP TABLE ecosystem_partners');
        $this->addSql('DROP TABLE iks_council_members');
        $this->addSql('DROP TABLE iks_iniative_outcomes');
        $this->addSql('DROP TABLE iks_iniatives');
        $this->addSql('DROP TABLE iks_knowledge_area_examples');
        $this->addSql('DROP TABLE iks_knowledge_areas');
        $this->addSql('DROP TABLE iks_resources');
        $this->addSql('DROP TABLE innovation_challenge_categories');
        $this->addSql('DROP TABLE innovation_challenges');
        $this->addSql('DROP TABLE innovators');
        $this->addSql('DROP TABLE internship_benefits');
        $this->addSql('DROP TABLE internship_departments');
        $this->addSql('DROP TABLE internship_programs');
        $this->addSql('DROP TABLE news_articles');
        $this->addSql('DROP TABLE news_categories');
        $this->addSql('DROP TABLE procurement_bids');
        $this->addSql('DROP TABLE procurement_documents');
        $this->addSql('DROP TABLE research_grants');
        $this->addSql('DROP TABLE research_permits');
        $this->addSql('DROP TABLE research_priorities');
        $this->addSql('DROP TABLE resource_categories');
        $this->addSql('DROP TABLE resources');
        $this->addSql('DROP TABLE science_events');
        $this->addSql('DROP TABLE science_programs');
        $this->addSql('DROP TABLE uploads');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vacancies');
        $this->addSql('DROP TABLE vacancy_requirements');
        $this->addSql('DROP TABLE vacancy_responsabilities');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
