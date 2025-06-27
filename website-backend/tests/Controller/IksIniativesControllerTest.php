<?php

namespace App\Test\Controller;

use App\Entity\IksIniatives;
use App\Repository\IksIniativesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IksIniativesControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var IksIniativesRepository */
    private $repository;
    private $path = '/iks/iniatives/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(IksIniatives::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('IksIniative index');

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
            'iks_iniative[title]' => 'Testing',
            'iks_iniative[description]' => 'Testing',
            'iks_iniative[status]' => 'Testing',
            'iks_iniative[timeline]' => 'Testing',
            'iks_iniative[communities]' => 'Testing',
        ]);

        self::assertResponseRedirects('/iks/iniatives/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new IksIniatives();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setStatus('My Title');
        $fixture->setTimeline('My Title');
        $fixture->setCommunities('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('IksIniative');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new IksIniatives();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setStatus('My Title');
        $fixture->setTimeline('My Title');
        $fixture->setCommunities('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'iks_iniative[title]' => 'Something New',
            'iks_iniative[description]' => 'Something New',
            'iks_iniative[status]' => 'Something New',
            'iks_iniative[timeline]' => 'Something New',
            'iks_iniative[communities]' => 'Something New',
        ]);

        self::assertResponseRedirects('/iks/iniatives/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getStatus());
        self::assertSame('Something New', $fixture[0]->getTimeline());
        self::assertSame('Something New', $fixture[0]->getCommunities());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new IksIniatives();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setStatus('My Title');
        $fixture->setTimeline('My Title');
        $fixture->setCommunities('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/iks/iniatives/');
    }
}
