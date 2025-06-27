<?php

namespace App\Test\Controller;

use App\Entity\BoardCommissioners;
use App\Repository\BoardCommissionersRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BoardCommissionersControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var BoardCommissionersRepository */
    private $repository;
    private $path = '/board/commissioners/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(BoardCommissioners::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('BoardCommissioner index');

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
            'board_commissioner[name]' => 'Testing',
            'board_commissioner[role]' => 'Testing',
            'board_commissioner[expertise]' => 'Testing',
            'board_commissioner[created_at]' => 'Testing',
        ]);

        self::assertResponseRedirects('/board/commissioners/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new BoardCommissioners();
        $fixture->setName('My Title');
        $fixture->setRole('My Title');
        $fixture->setExpertise('My Title');
        $fixture->setCreated_at('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('BoardCommissioner');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new BoardCommissioners();
        $fixture->setName('My Title');
        $fixture->setRole('My Title');
        $fixture->setExpertise('My Title');
        $fixture->setCreated_at('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'board_commissioner[name]' => 'Something New',
            'board_commissioner[role]' => 'Something New',
            'board_commissioner[expertise]' => 'Something New',
            'board_commissioner[created_at]' => 'Something New',
        ]);

        self::assertResponseRedirects('/board/commissioners/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getRole());
        self::assertSame('Something New', $fixture[0]->getExpertise());
        self::assertSame('Something New', $fixture[0]->getCreated_at());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new BoardCommissioners();
        $fixture->setName('My Title');
        $fixture->setRole('My Title');
        $fixture->setExpertise('My Title');
        $fixture->setCreated_at('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/board/commissioners/');
    }
}
