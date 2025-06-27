<?php

namespace App\Test\Controller;

use App\Entity\ResearchGrants;
use App\Repository\ResearchGrantsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ResearchGrantsControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var ResearchGrantsRepository */
    private $repository;
    private $path = '/research/grants/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(ResearchGrants::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ResearchGrant index');

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
            'research_grant[title]' => 'Testing',
            'research_grant[deadline]' => 'Testing',
            'research_grant[amount]' => 'Testing',
            'research_grant[category]' => 'Testing',
            'research_grant[status]' => 'Testing',
            'research_grant[created_at]' => 'Testing',
        ]);

        self::assertResponseRedirects('/research/grants/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new ResearchGrants();
        $fixture->setTitle('My Title');
        $fixture->setDeadline('My Title');
        $fixture->setAmount('My Title');
        $fixture->setCategory('My Title');
        $fixture->setStatus('My Title');
        $fixture->setCreated_at('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ResearchGrant');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new ResearchGrants();
        $fixture->setTitle('My Title');
        $fixture->setDeadline('My Title');
        $fixture->setAmount('My Title');
        $fixture->setCategory('My Title');
        $fixture->setStatus('My Title');
        $fixture->setCreated_at('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'research_grant[title]' => 'Something New',
            'research_grant[deadline]' => 'Something New',
            'research_grant[amount]' => 'Something New',
            'research_grant[category]' => 'Something New',
            'research_grant[status]' => 'Something New',
            'research_grant[created_at]' => 'Something New',
        ]);

        self::assertResponseRedirects('/research/grants/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getDeadline());
        self::assertSame('Something New', $fixture[0]->getAmount());
        self::assertSame('Something New', $fixture[0]->getCategory());
        self::assertSame('Something New', $fixture[0]->getStatus());
        self::assertSame('Something New', $fixture[0]->getCreated_at());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new ResearchGrants();
        $fixture->setTitle('My Title');
        $fixture->setDeadline('My Title');
        $fixture->setAmount('My Title');
        $fixture->setCategory('My Title');
        $fixture->setStatus('My Title');
        $fixture->setCreated_at('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/research/grants/');
    }
}
