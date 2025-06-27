<?php

namespace App\Test\Controller;

use App\Entity\Resources;
use App\Repository\ResourcesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ResourcesControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var ResourcesRepository */
    private $repository;
    private $path = '/resources/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Resources::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Resource index');

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
            'resource[title]' => 'Testing',
            'resource[yer]' => 'Testing',
            'resource[description]' => 'Testing',
            'resource[file_type]' => 'Testing',
            'resource[size]' => 'Testing',
            'resource[downloads]' => 'Testing',
            'resource[date]' => 'Testing',
            'resource[created_at]' => 'Testing',
            'resource[resource_categories]' => 'Testing',
        ]);

        self::assertResponseRedirects('/resources/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Resources();
        $fixture->setTitle('My Title');
        $fixture->setYer('My Title');
        $fixture->setDescription('My Title');
        $fixture->setFile_type('My Title');
        $fixture->setSize('My Title');
        $fixture->setDownloads('My Title');
        $fixture->setDate('My Title');
        $fixture->setCreated_at('My Title');
        $fixture->setResource_categories('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Resource');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Resources();
        $fixture->setTitle('My Title');
        $fixture->setYer('My Title');
        $fixture->setDescription('My Title');
        $fixture->setFile_type('My Title');
        $fixture->setSize('My Title');
        $fixture->setDownloads('My Title');
        $fixture->setDate('My Title');
        $fixture->setCreated_at('My Title');
        $fixture->setResource_categories('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'resource[title]' => 'Something New',
            'resource[yer]' => 'Something New',
            'resource[description]' => 'Something New',
            'resource[file_type]' => 'Something New',
            'resource[size]' => 'Something New',
            'resource[downloads]' => 'Something New',
            'resource[date]' => 'Something New',
            'resource[created_at]' => 'Something New',
            'resource[resource_categories]' => 'Something New',
        ]);

        self::assertResponseRedirects('/resources/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getYer());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getFile_type());
        self::assertSame('Something New', $fixture[0]->getSize());
        self::assertSame('Something New', $fixture[0]->getDownloads());
        self::assertSame('Something New', $fixture[0]->getDate());
        self::assertSame('Something New', $fixture[0]->getCreated_at());
        self::assertSame('Something New', $fixture[0]->getResource_categories());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Resources();
        $fixture->setTitle('My Title');
        $fixture->setYer('My Title');
        $fixture->setDescription('My Title');
        $fixture->setFile_type('My Title');
        $fixture->setSize('My Title');
        $fixture->setDownloads('My Title');
        $fixture->setDate('My Title');
        $fixture->setCreated_at('My Title');
        $fixture->setResource_categories('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/resources/');
    }
}
