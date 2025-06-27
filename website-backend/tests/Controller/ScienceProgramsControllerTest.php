<?php

namespace App\Test\Controller;

use App\Entity\SciencePrograms;
use App\Repository\ScienceProgramsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ScienceProgramsControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var ScienceProgramsRepository */
    private $repository;
    private $path = '/science/programs/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(SciencePrograms::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ScienceProgram index');

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
            'science_program[title]' => 'Testing',
            'science_program[description]' => 'Testing',
            'science_program[icon]' => 'Testing',
            'science_program[color]' => 'Testing',
            'science_program[link]' => 'Testing',
        ]);

        self::assertResponseRedirects('/science/programs/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new SciencePrograms();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setIcon('My Title');
        $fixture->setColor('My Title');
        $fixture->setLink('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ScienceProgram');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new SciencePrograms();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setIcon('My Title');
        $fixture->setColor('My Title');
        $fixture->setLink('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'science_program[title]' => 'Something New',
            'science_program[description]' => 'Something New',
            'science_program[icon]' => 'Something New',
            'science_program[color]' => 'Something New',
            'science_program[link]' => 'Something New',
        ]);

        self::assertResponseRedirects('/science/programs/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getIcon());
        self::assertSame('Something New', $fixture[0]->getColor());
        self::assertSame('Something New', $fixture[0]->getLink());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new SciencePrograms();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setIcon('My Title');
        $fixture->setColor('My Title');
        $fixture->setLink('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/science/programs/');
    }
}
