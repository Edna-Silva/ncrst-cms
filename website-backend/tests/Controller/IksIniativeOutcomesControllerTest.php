<?php

namespace App\Test\Controller;

use App\Entity\IksIniativeOutcomes;
use App\Repository\IksIniativeOutcomesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IksIniativeOutcomesControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var IksIniativeOutcomesRepository */
    private $repository;
    private $path = '/iks/iniative/outcomes/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(IksIniativeOutcomes::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('IksIniativeOutcome index');

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
            'iks_iniative_outcome[outcome]' => 'Testing',
            'iks_iniative_outcome[iks_iniatives]' => 'Testing',
        ]);

        self::assertResponseRedirects('/iks/iniative/outcomes/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new IksIniativeOutcomes();
        $fixture->setOutcome('My Title');
        $fixture->setIks_iniatives('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('IksIniativeOutcome');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new IksIniativeOutcomes();
        $fixture->setOutcome('My Title');
        $fixture->setIks_iniatives('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'iks_iniative_outcome[outcome]' => 'Something New',
            'iks_iniative_outcome[iks_iniatives]' => 'Something New',
        ]);

        self::assertResponseRedirects('/iks/iniative/outcomes/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getOutcome());
        self::assertSame('Something New', $fixture[0]->getIks_iniatives());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new IksIniativeOutcomes();
        $fixture->setOutcome('My Title');
        $fixture->setIks_iniatives('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/iks/iniative/outcomes/');
    }
}
