<?php

namespace App\Test\Controller;

use App\Entity\VacancyRequirements;
use App\Repository\VacancyRequirementsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VacancyRequirementsControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var VacancyRequirementsRepository */
    private $repository;
    private $path = '/vacancy/requirements/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(VacancyRequirements::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('VacancyRequirement index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'vacancy_requirement[requirement]' => 'Testing',
            'vacancy_requirement[vacancy]' => 'Testing',
        ]);

        self::assertResponseRedirects('/vacancy/requirements/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new VacancyRequirements();
        $fixture->setRequirement('My Title');
        $fixture->setVacancy('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('VacancyRequirement');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new VacancyRequirements();
        $fixture->setRequirement('My Title');
        $fixture->setVacancy('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'vacancy_requirement[requirement]' => 'Something New',
            'vacancy_requirement[vacancy]' => 'Something New',
        ]);

        self::assertResponseRedirects('/vacancy/requirements/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getRequirement());
        self::assertSame('Something New', $fixture[0]->getVacancy());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new VacancyRequirements();
        $fixture->setRequirement('My Title');
        $fixture->setVacancy('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/vacancy/requirements/');
    }
}
