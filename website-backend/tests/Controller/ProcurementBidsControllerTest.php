<?php

namespace App\Test\Controller;

use App\Entity\ProcurementBids;
use App\Repository\ProcurementBidsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProcurementBidsControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var ProcurementBidsRepository */
    private $repository;
    private $path = '/procurement/bids/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(ProcurementBids::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ProcurementBid index');

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
            'procurement_bid[title]' => 'Testing',
            'procurement_bid[category]' => 'Testing',
            'procurement_bid[reference]' => 'Testing',
            'procurement_bid[description]' => 'Testing',
            'procurement_bid[value]' => 'Testing',
            'procurement_bid[closing_date]' => 'Testing',
            'procurement_bid[publish_date]' => 'Testing',
            'procurement_bid[status]' => 'Testing',
            'procurement_bid[is_awarded]' => 'Testing',
            'procurement_bid[vendor]' => 'Testing',
            'procurement_bid[awarded_value]' => 'Testing',
            'procurement_bid[awarded_date]' => 'Testing',
            'procurement_bid[contract_period]' => 'Testing',
            'procurement_bid[created_at]' => 'Testing',
        ]);

        self::assertResponseRedirects('/procurement/bids/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new ProcurementBids();
        $fixture->setTitle('My Title');
        $fixture->setCategory('My Title');
        $fixture->setReference('My Title');
        $fixture->setDescription('My Title');
        $fixture->setValue('My Title');
        $fixture->setClosing_date('My Title');
        $fixture->setPublish_date('My Title');
        $fixture->setStatus('My Title');
        $fixture->setIs_awarded('My Title');
        $fixture->setVendor('My Title');
        $fixture->setAwarded_value('My Title');
        $fixture->setAwarded_date('My Title');
        $fixture->setContract_period('My Title');
        $fixture->setCreated_at('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ProcurementBid');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new ProcurementBids();
        $fixture->setTitle('My Title');
        $fixture->setCategory('My Title');
        $fixture->setReference('My Title');
        $fixture->setDescription('My Title');
        $fixture->setValue('My Title');
        $fixture->setClosing_date('My Title');
        $fixture->setPublish_date('My Title');
        $fixture->setStatus('My Title');
        $fixture->setIs_awarded('My Title');
        $fixture->setVendor('My Title');
        $fixture->setAwarded_value('My Title');
        $fixture->setAwarded_date('My Title');
        $fixture->setContract_period('My Title');
        $fixture->setCreated_at('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'procurement_bid[title]' => 'Something New',
            'procurement_bid[category]' => 'Something New',
            'procurement_bid[reference]' => 'Something New',
            'procurement_bid[description]' => 'Something New',
            'procurement_bid[value]' => 'Something New',
            'procurement_bid[closing_date]' => 'Something New',
            'procurement_bid[publish_date]' => 'Something New',
            'procurement_bid[status]' => 'Something New',
            'procurement_bid[is_awarded]' => 'Something New',
            'procurement_bid[vendor]' => 'Something New',
            'procurement_bid[awarded_value]' => 'Something New',
            'procurement_bid[awarded_date]' => 'Something New',
            'procurement_bid[contract_period]' => 'Something New',
            'procurement_bid[created_at]' => 'Something New',
        ]);

        self::assertResponseRedirects('/procurement/bids/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getCategory());
        self::assertSame('Something New', $fixture[0]->getReference());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getValue());
        self::assertSame('Something New', $fixture[0]->getClosing_date());
        self::assertSame('Something New', $fixture[0]->getPublish_date());
        self::assertSame('Something New', $fixture[0]->getStatus());
        self::assertSame('Something New', $fixture[0]->getIs_awarded());
        self::assertSame('Something New', $fixture[0]->getVendor());
        self::assertSame('Something New', $fixture[0]->getAwarded_value());
        self::assertSame('Something New', $fixture[0]->getAwarded_date());
        self::assertSame('Something New', $fixture[0]->getContract_period());
        self::assertSame('Something New', $fixture[0]->getCreated_at());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new ProcurementBids();
        $fixture->setTitle('My Title');
        $fixture->setCategory('My Title');
        $fixture->setReference('My Title');
        $fixture->setDescription('My Title');
        $fixture->setValue('My Title');
        $fixture->setClosing_date('My Title');
        $fixture->setPublish_date('My Title');
        $fixture->setStatus('My Title');
        $fixture->setIs_awarded('My Title');
        $fixture->setVendor('My Title');
        $fixture->setAwarded_value('My Title');
        $fixture->setAwarded_date('My Title');
        $fixture->setContract_period('My Title');
        $fixture->setCreated_at('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/procurement/bids/');
    }
}
