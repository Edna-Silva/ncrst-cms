<?php

namespace App\Test\Controller;

use App\Entity\IksKnowledgeAreaExamples;
use App\Repository\IksKnowledgeAreaExamplesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IksKnowledgeAreaExamplesControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var IksKnowledgeAreaExamplesRepository */
    private $repository;
    private $path = '/iks/knowledge/area/examples/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(IksKnowledgeAreaExamples::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('IksKnowledgeAreaExample index');

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
            'iks_knowledge_area_example[example]' => 'Testing',
            'iks_knowledge_area_example[iks_knowlegde_area]' => 'Testing',
        ]);

        self::assertResponseRedirects('/iks/knowledge/area/examples/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new IksKnowledgeAreaExamples();
        $fixture->setExample('My Title');
        $fixture->setIks_knowlegde_area('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('IksKnowledgeAreaExample');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new IksKnowledgeAreaExamples();
        $fixture->setExample('My Title');
        $fixture->setIks_knowlegde_area('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'iks_knowledge_area_example[example]' => 'Something New',
            'iks_knowledge_area_example[iks_knowlegde_area]' => 'Something New',
        ]);

        self::assertResponseRedirects('/iks/knowledge/area/examples/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getExample());
        self::assertSame('Something New', $fixture[0]->getIks_knowlegde_area());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new IksKnowledgeAreaExamples();
        $fixture->setExample('My Title');
        $fixture->setIks_knowlegde_area('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/iks/knowledge/area/examples/');
    }
}
