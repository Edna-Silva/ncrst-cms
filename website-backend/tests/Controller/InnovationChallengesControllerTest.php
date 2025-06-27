<?php

namespace App\Test\Controller;

use App\Entity\InnovationChallenges;
use App\Repository\InnovationChallengesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InnovationChallengesControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var InnovationChallengesRepository */
    private $repository;
    private $path = '/innovation/challenges/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(InnovationChallenges::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('InnovationChallenge index');

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
            'innovation_challenge[name]' => 'Testing',
            'innovation_challenge[description]' => 'Testing',
            'innovation_challenge[duration]' => 'Testing',
            'innovation_challenge[participants]' => 'Testing',
            'innovation_challenge[status]' => 'Testing',
            'innovation_challenge[deadline]' => 'Testing',
            'innovation_challenge[created_at]' => 'Testing',
        ]);

        self::assertResponseRedirects('/innovation/challenges/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new InnovationChallenges();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setDuration('My Title');
        $fixture->setParticipants('My Title');
        $fixture->setStatus('My Title');
        $fixture->setDeadline('My Title');
        $fixture->setCreated_at('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('InnovationChallenge');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new InnovationChallenges();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setDuration('My Title');
        $fixture->setParticipants('My Title');
        $fixture->setStatus('My Title');
        $fixture->setDeadline('My Title');
        $fixture->setCreated_at('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'innovation_challenge[name]' => 'Something New',
            'innovation_challenge[description]' => 'Something New',
            'innovation_challenge[duration]' => 'Something New',
            'innovation_challenge[participants]' => 'Something New',
            'innovation_challenge[status]' => 'Something New',
            'innovation_challenge[deadline]' => 'Something New',
            'innovation_challenge[created_at]' => 'Something New',
        ]);

        self::assertResponseRedirects('/innovation/challenges/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getDuration());
        self::assertSame('Something New', $fixture[0]->getParticipants());
        self::assertSame('Something New', $fixture[0]->getStatus());
        self::assertSame('Something New', $fixture[0]->getDeadline());
        self::assertSame('Something New', $fixture[0]->getCreated_at());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new InnovationChallenges();
        $fixture->setName('My Title');
        $fixture->setDescription('My Title');
        $fixture->setDuration('My Title');
        $fixture->setParticipants('My Title');
        $fixture->setStatus('My Title');
        $fixture->setDeadline('My Title');
        $fixture->setCreated_at('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/innovation/challenges/');
    }
}
