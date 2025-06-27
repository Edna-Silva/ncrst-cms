<?php

namespace App\Test\Controller;

use App\Entity\ScienceEvents;
use App\Repository\ScienceEventsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ScienceEventsControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var ScienceEventsRepository */
    private $repository;
    private $path = '/science/events/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(ScienceEvents::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ScienceEvent index');

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
            'science_event[title]' => 'Testing',
            'science_event[date]' => 'Testing',
            'science_event[location]' => 'Testing',
            'science_event[category]' => 'Testing',
            'science_event[description]' => 'Testing',
        ]);

        self::assertResponseRedirects('/science/events/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new ScienceEvents();
        $fixture->setTitle('My Title');
        $fixture->setDate('My Title');
        $fixture->setLocation('My Title');
        $fixture->setCategory('My Title');
        $fixture->setDescription('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ScienceEvent');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new ScienceEvents();
        $fixture->setTitle('My Title');
        $fixture->setDate('My Title');
        $fixture->setLocation('My Title');
        $fixture->setCategory('My Title');
        $fixture->setDescription('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'science_event[title]' => 'Something New',
            'science_event[date]' => 'Something New',
            'science_event[location]' => 'Something New',
            'science_event[category]' => 'Something New',
            'science_event[description]' => 'Something New',
        ]);

        self::assertResponseRedirects('/science/events/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getDate());
        self::assertSame('Something New', $fixture[0]->getLocation());
        self::assertSame('Something New', $fixture[0]->getCategory());
        self::assertSame('Something New', $fixture[0]->getDescription());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new ScienceEvents();
        $fixture->setTitle('My Title');
        $fixture->setDate('My Title');
        $fixture->setLocation('My Title');
        $fixture->setCategory('My Title');
        $fixture->setDescription('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/science/events/');
    }
}
