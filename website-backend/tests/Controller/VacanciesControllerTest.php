<?php

namespace App\Test\Controller;

use App\Entity\Vacancies;
use App\Repository\VacanciesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VacanciesControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var VacanciesRepository */
    private $repository;
    private $path = '/vacancies/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Vacancies::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Vacancy index');

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
            'vacancy[title]' => 'Testing',
            'vacancy[department]' => 'Testing',
            'vacancy[location]' => 'Testing',
            'vacancy[type]' => 'Testing',
            'vacancy[level]' => 'Testing',
            'vacancy[closing_date]' => 'Testing',
            'vacancy[publish_date]' => 'Testing',
            'vacancy[salary]' => 'Testing',
            'vacancy[create_at]' => 'Testing',
        ]);

        self::assertResponseRedirects('/vacancies/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Vacancies();
        $fixture->setTitle('My Title');
        $fixture->setDepartment('My Title');
        $fixture->setLocation('My Title');
        $fixture->setType('My Title');
        $fixture->setLevel('My Title');
        $fixture->setClosing_date('My Title');
        $fixture->setPublish_date('My Title');
        $fixture->setSalary('My Title');
        $fixture->setCreate_at('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Vacancy');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Vacancies();
        $fixture->setTitle('My Title');
        $fixture->setDepartment('My Title');
        $fixture->setLocation('My Title');
        $fixture->setType('My Title');
        $fixture->setLevel('My Title');
        $fixture->setClosing_date('My Title');
        $fixture->setPublish_date('My Title');
        $fixture->setSalary('My Title');
        $fixture->setCreate_at('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'vacancy[title]' => 'Something New',
            'vacancy[department]' => 'Something New',
            'vacancy[location]' => 'Something New',
            'vacancy[type]' => 'Something New',
            'vacancy[level]' => 'Something New',
            'vacancy[closing_date]' => 'Something New',
            'vacancy[publish_date]' => 'Something New',
            'vacancy[salary]' => 'Something New',
            'vacancy[create_at]' => 'Something New',
        ]);

        self::assertResponseRedirects('/vacancies/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getDepartment());
        self::assertSame('Something New', $fixture[0]->getLocation());
        self::assertSame('Something New', $fixture[0]->getType());
        self::assertSame('Something New', $fixture[0]->getLevel());
        self::assertSame('Something New', $fixture[0]->getClosing_date());
        self::assertSame('Something New', $fixture[0]->getPublish_date());
        self::assertSame('Something New', $fixture[0]->getSalary());
        self::assertSame('Something New', $fixture[0]->getCreate_at());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Vacancies();
        $fixture->setTitle('My Title');
        $fixture->setDepartment('My Title');
        $fixture->setLocation('My Title');
        $fixture->setType('My Title');
        $fixture->setLevel('My Title');
        $fixture->setClosing_date('My Title');
        $fixture->setPublish_date('My Title');
        $fixture->setSalary('My Title');
        $fixture->setCreate_at('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/vacancies/');
    }
}
