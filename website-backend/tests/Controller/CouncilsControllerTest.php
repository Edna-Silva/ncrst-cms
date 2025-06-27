<?php

namespace App\Test\Controller;

use App\Entity\Councils;
use App\Repository\CouncilsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CouncilsControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var CouncilsRepository */
    private $repository;
    private $path = '/councils/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Councils::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Council index');

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
            'council[name]' => 'Testing',
            'council[description]' => 'Testing',
            'council[members_count]' => 'Testing',
            'council[link]' => 'Testing',
        ]);

        self::assertResponseRedirects('/councils/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Councils();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setMembers_count('My Title');
        $fixture->setLink('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Council');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Councils();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setMembers_count('My Title');
        $fixture->setLink('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'council[name]' => 'Something New',
            'council[description]' => 'Something New',
            'council[members_count]' => 'Something New',
            'council[link]' => 'Something New',
        ]);

        self::assertResponseRedirects('/councils/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getMembers_count());
        self::assertSame('Something New', $fixture[0]->getLink());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Councils();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setMembers_count('My Title');
        $fixture->setLink('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/councils/');
    }
}
