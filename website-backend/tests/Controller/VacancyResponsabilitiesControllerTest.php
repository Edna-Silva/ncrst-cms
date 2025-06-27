<?php

namespace App\Test\Controller;

use App\Entity\VacancyResponsabilities;
use App\Repository\VacancyResponsabilitiesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VacancyResponsabilitiesControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var VacancyResponsabilitiesRepository */
    private $repository;
    private $path = '/vacancy/responsabilities/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(VacancyResponsabilities::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('VacancyResponsability index');

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
            'vacancy_responsability[responsability]' => 'Testing',
            'vacancy_responsability[vacancy]' => 'Testing',
        ]);

        self::assertResponseRedirects('/vacancy/responsabilities/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new VacancyResponsabilities();
        $fixture->setResponsability('My Title');
        $fixture->setVacancy('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('VacancyResponsability');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new VacancyResponsabilities();
        $fixture->setResponsability('My Title');
        $fixture->setVacancy('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'vacancy_responsability[responsability]' => 'Something New',
            'vacancy_responsability[vacancy]' => 'Something New',
        ]);

        self::assertResponseRedirects('/vacancy/responsabilities/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getResponsability());
        self::assertSame('Something New', $fixture[0]->getVacancy());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new VacancyResponsabilities();
        $fixture->setResponsability('My Title');
        $fixture->setVacancy('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/vacancy/responsabilities/');
    }
}
