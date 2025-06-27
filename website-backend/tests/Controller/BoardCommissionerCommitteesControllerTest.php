<?php

namespace App\Test\Controller;

use App\Entity\BoardCommissionerCommittees;
use App\Repository\BoardCommissionerCommitteesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BoardCommissionerCommitteesControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var BoardCommissionerCommitteesRepository */
    private $repository;
    private $path = '/board/commissioner/committees/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(BoardCommissionerCommittees::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('BoardCommissionerCommittee index');

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
            'board_commissioner_committee[committee]' => 'Testing',
            'board_commissioner_committee[board_commissioner]' => 'Testing',
        ]);

        self::assertResponseRedirects('/board/commissioner/committees/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new BoardCommissionerCommittees();
        $fixture->setCommittee('My Title');
        $fixture->setBoard_commissioner('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('BoardCommissionerCommittee');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new BoardCommissionerCommittees();
        $fixture->setCommittee('My Title');
        $fixture->setBoard_commissioner('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'board_commissioner_committee[committee]' => 'Something New',
            'board_commissioner_committee[board_commissioner]' => 'Something New',
        ]);

        self::assertResponseRedirects('/board/commissioner/committees/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getCommittee());
        self::assertSame('Something New', $fixture[0]->getBoard_commissioner());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new BoardCommissionerCommittees();
        $fixture->setCommittee('My Title');
        $fixture->setBoard_commissioner('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/board/commissioner/committees/');
    }
}
