<?php

namespace App\Test\Controller;

use App\Entity\ResearchPermits;
use App\Repository\ResearchPermitsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ResearchPermitsControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var ResearchPermitsRepository */
    private $repository;
    private $path = '/research/permits/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(ResearchPermits::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ResearchPermit index');

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
            'research_permit[title]' => 'Testing',
            'research_permit[description]' => 'Testing',
            'research_permit[file_type]' => 'Testing',
            'research_permit[size]' => 'Testing',
            'research_permit[created_at]' => 'Testing',
        ]);

        self::assertResponseRedirects('/research/permits/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new ResearchPermits();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setFile_type('My Title');
        $fixture->setSize('My Title');
        $fixture->setCreated_at('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ResearchPermit');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new ResearchPermits();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setFile_type('My Title');
        $fixture->setSize('My Title');
        $fixture->setCreated_at('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'research_permit[title]' => 'Something New',
            'research_permit[description]' => 'Something New',
            'research_permit[file_type]' => 'Something New',
            'research_permit[size]' => 'Something New',
            'research_permit[created_at]' => 'Something New',
        ]);

        self::assertResponseRedirects('/research/permits/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getFile_type());
        self::assertSame('Something New', $fixture[0]->getSize());
        self::assertSame('Something New', $fixture[0]->getCreated_at());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new ResearchPermits();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setFile_type('My Title');
        $fixture->setSize('My Title');
        $fixture->setCreated_at('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/research/permits/');
    }
}
