<?php

namespace App\Test\Controller;

use App\Entity\BiotechLabServices;
use App\Repository\BiotechLabServicesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BiotechLabServicesControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var BiotechLabServicesRepository */
    private $repository;
    private $path = '/biotech/lab/services/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(BiotechLabServices::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('BiotechLabService index');

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
            'biotech_lab_service[service]' => 'Testing',
            'biotech_lab_service[biotech_labs]' => 'Testing',
        ]);

        self::assertResponseRedirects('/biotech/lab/services/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new BiotechLabServices();
        $fixture->setService('My Title');
        $fixture->setBiotech_labs('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('BiotechLabService');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new BiotechLabServices();
        $fixture->setService('My Title');
        $fixture->setBiotech_labs('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'biotech_lab_service[service]' => 'Something New',
            'biotech_lab_service[biotech_labs]' => 'Something New',
        ]);

        self::assertResponseRedirects('/biotech/lab/services/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getService());
        self::assertSame('Something New', $fixture[0]->getBiotech_labs());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new BiotechLabServices();
        $fixture->setService('My Title');
        $fixture->setBiotech_labs('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/biotech/lab/services/');
    }
}
