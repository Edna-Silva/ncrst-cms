<?php

namespace App\Test\Controller;

use App\Entity\IksResources;
use App\Repository\IksResourcesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IksResourcesControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var IksResourcesRepository */
    private $repository;
    private $path = '/iks/resources/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(IksResources::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('IksResource index');

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
            'iks_resource[title]' => 'Testing',
            'iks_resource[description]' => 'Testing',
            'iks_resource[type]' => 'Testing',
            'iks_resource[acess]' => 'Testing',
        ]);

        self::assertResponseRedirects('/iks/resources/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new IksResources();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setType('My Title');
        $fixture->setAcess('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('IksResource');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new IksResources();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setType('My Title');
        $fixture->setAcess('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'iks_resource[title]' => 'Something New',
            'iks_resource[description]' => 'Something New',
            'iks_resource[type]' => 'Something New',
            'iks_resource[acess]' => 'Something New',
        ]);

        self::assertResponseRedirects('/iks/resources/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getType());
        self::assertSame('Something New', $fixture[0]->getAcess());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new IksResources();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setType('My Title');
        $fixture->setAcess('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/iks/resources/');
    }
}
