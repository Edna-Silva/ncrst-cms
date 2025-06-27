<?php

namespace App\Test\Controller;

use App\Entity\EcosystemPartnerExamples;
use App\Repository\EcosystemPartnerExamplesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EcosystemPartnerExamplesControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var EcosystemPartnerExamplesRepository */
    private $repository;
    private $path = '/ecosystem/partner/examples/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(EcosystemPartnerExamples::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('EcosystemPartnerExample index');

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
            'ecosystem_partner_example[example]' => 'Testing',
            'ecosystem_partner_example[ecosystem_partner]' => 'Testing',
        ]);

        self::assertResponseRedirects('/ecosystem/partner/examples/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new EcosystemPartnerExamples();
        $fixture->setExample('My Title');
        $fixture->setEcosystem_partner('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('EcosystemPartnerExample');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new EcosystemPartnerExamples();
        $fixture->setExample('My Title');
        $fixture->setEcosystem_partner('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'ecosystem_partner_example[example]' => 'Something New',
            'ecosystem_partner_example[ecosystem_partner]' => 'Something New',
        ]);

        self::assertResponseRedirects('/ecosystem/partner/examples/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getExample());
        self::assertSame('Something New', $fixture[0]->getEcosystem_partner());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new EcosystemPartnerExamples();
        $fixture->setExample('My Title');
        $fixture->setEcosystem_partner('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/ecosystem/partner/examples/');
    }
}
