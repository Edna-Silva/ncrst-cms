<?php

namespace App\Test\Controller;

use App\Entity\CouncilMembers;
use App\Repository\CouncilMembersRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CouncilMembersControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var CouncilMembersRepository */
    private $repository;
    private $path = '/council/members/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(CouncilMembers::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('CouncilMember index');

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
            'council_member[name]' => 'Testing',
            'council_member[role]' => 'Testing',
            'council_member[expertise]' => 'Testing',
            'council_member[institution]' => 'Testing',
            'council_member[community]' => 'Testing',
            'council_member[council]' => 'Testing',
        ]);

        self::assertResponseRedirects('/council/members/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new CouncilMembers();
        $fixture->setName('My Title');
        $fixture->setRole('My Title');
        $fixture->setExpertise('My Title');
        $fixture->setInstitution('My Title');
        $fixture->setCommunity('My Title');
        $fixture->setCouncil('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('CouncilMember');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new CouncilMembers();
        $fixture->setName('My Title');
        $fixture->setRole('My Title');
        $fixture->setExpertise('My Title');
        $fixture->setInstitution('My Title');
        $fixture->setCommunity('My Title');
        $fixture->setCouncil('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'council_member[name]' => 'Something New',
            'council_member[role]' => 'Something New',
            'council_member[expertise]' => 'Something New',
            'council_member[institution]' => 'Something New',
            'council_member[community]' => 'Something New',
            'council_member[council]' => 'Something New',
        ]);

        self::assertResponseRedirects('/council/members/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getRole());
        self::assertSame('Something New', $fixture[0]->getExpertise());
        self::assertSame('Something New', $fixture[0]->getInstitution());
        self::assertSame('Something New', $fixture[0]->getCommunity());
        self::assertSame('Something New', $fixture[0]->getCouncil());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new CouncilMembers();
        $fixture->setName('My Title');
        $fixture->setRole('My Title');
        $fixture->setExpertise('My Title');
        $fixture->setInstitution('My Title');
        $fixture->setCommunity('My Title');
        $fixture->setCouncil('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/council/members/');
    }
}
