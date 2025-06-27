<?php

namespace App\Test\Controller;

use App\Entity\AiInitiatives;
use App\Repository\AiInitiativesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AiInitiativesControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var AiInitiativesRepository */
    private $repository;
    private $path = '/ai/initiatives/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(AiInitiatives::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('AiInitiative index');

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
            'ai_initiative[title]' => 'Testing',
            'ai_initiative[description]' => 'Testing',
            'ai_initiative[participants]' => 'Testing',
            'ai_initiative[projects]' => 'Testing',
        ]);

        self::assertResponseRedirects('/ai/initiatives/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new AiInitiatives();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setParticipants('My Title');
        $fixture->setProjects('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('AiInitiative');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new AiInitiatives();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setParticipants('My Title');
        $fixture->setProjects('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'ai_initiative[title]' => 'Something New',
            'ai_initiative[description]' => 'Something New',
            'ai_initiative[participants]' => 'Something New',
            'ai_initiative[projects]' => 'Something New',
        ]);

        self::assertResponseRedirects('/ai/initiatives/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getParticipants());
        self::assertSame('Something New', $fixture[0]->getProjects());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new AiInitiatives();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setParticipants('My Title');
        $fixture->setProjects('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/ai/initiatives/');
    }
}
