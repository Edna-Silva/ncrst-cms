<?php

namespace App\Test\Controller;

use App\Entity\BiotechLabs;
use App\Repository\BiotechLabsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BiotechLabsControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var BiotechLabsRepository */
    private $repository;
    private $path = '/biotech/labs/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(BiotechLabs::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('BiotechLab index');

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
            'biotech_lab[name]' => 'Testing',
            'biotech_lab[location]' => 'Testing',
            'biotech_lab[equipment]' => 'Testing',
            'biotech_lab[cerification]' => 'Testing',
        ]);

        self::assertResponseRedirects('/biotech/labs/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new BiotechLabs();
        $fixture->setName('My Title');
        $fixture->setLocation('My Title');
        $fixture->setEquipment('My Title');
        $fixture->setCerification('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('BiotechLab');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new BiotechLabs();
        $fixture->setName('My Title');
        $fixture->setLocation('My Title');
        $fixture->setEquipment('My Title');
        $fixture->setCerification('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'biotech_lab[name]' => 'Something New',
            'biotech_lab[location]' => 'Something New',
            'biotech_lab[equipment]' => 'Something New',
            'biotech_lab[cerification]' => 'Something New',
        ]);

        self::assertResponseRedirects('/biotech/labs/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getLocation());
        self::assertSame('Something New', $fixture[0]->getEquipment());
        self::assertSame('Something New', $fixture[0]->getCerification());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new BiotechLabs();
        $fixture->setName('My Title');
        $fixture->setLocation('My Title');
        $fixture->setEquipment('My Title');
        $fixture->setCerification('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/biotech/labs/');
    }
}
