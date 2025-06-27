<?php

namespace App\Test\Controller;

use App\Entity\IksKnowledgeAreas;
use App\Repository\IksKnowledgeAreasRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IksKnowledgeAreasControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var IksKnowledgeAreasRepository */
    private $repository;
    private $path = '/iks/knowledge/areas/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(IksKnowledgeAreas::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('IksKnowledgeArea index');

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
            'iks_knowledge_area[title]' => 'Testing',
            'iks_knowledge_area[description]' => 'Testing',
            'iks_knowledge_area[icon]' => 'Testing',
            'iks_knowledge_area[color]' => 'Testing',
        ]);

        self::assertResponseRedirects('/iks/knowledge/areas/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new IksKnowledgeAreas();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setIcon('My Title');
        $fixture->setColor('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('IksKnowledgeArea');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new IksKnowledgeAreas();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setIcon('My Title');
        $fixture->setColor('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'iks_knowledge_area[title]' => 'Something New',
            'iks_knowledge_area[description]' => 'Something New',
            'iks_knowledge_area[icon]' => 'Something New',
            'iks_knowledge_area[color]' => 'Something New',
        ]);

        self::assertResponseRedirects('/iks/knowledge/areas/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getIcon());
        self::assertSame('Something New', $fixture[0]->getColor());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new IksKnowledgeAreas();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setIcon('My Title');
        $fixture->setColor('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/iks/knowledge/areas/');
    }
}
