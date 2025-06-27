<?php

namespace App\Test\Controller;

use App\Entity\IksCouncilMembers;
use App\Repository\IksCouncilMembersRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IksCouncilMembersControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var IksCouncilMembersRepository */
    private $repository;
    private $path = '/iks/council/members/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(IksCouncilMembers::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('IksCouncilMember index');

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
            'iks_council_member[name]' => 'Testing',
            'iks_council_member[role]' => 'Testing',
            'iks_council_member[expertise]' => 'Testing',
            'iks_council_member[community]' => 'Testing',
        ]);

        self::assertResponseRedirects('/iks/council/members/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new IksCouncilMembers();
        $fixture->setName('My Title');
        $fixture->setRole('My Title');
        $fixture->setExpertise('My Title');
        $fixture->setCommunity('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('IksCouncilMember');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new IksCouncilMembers();
        $fixture->setName('My Title');
        $fixture->setRole('My Title');
        $fixture->setExpertise('My Title');
        $fixture->setCommunity('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'iks_council_member[name]' => 'Something New',
            'iks_council_member[role]' => 'Something New',
            'iks_council_member[expertise]' => 'Something New',
            'iks_council_member[community]' => 'Something New',
        ]);

        self::assertResponseRedirects('/iks/council/members/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getRole());
        self::assertSame('Something New', $fixture[0]->getExpertise());
        self::assertSame('Something New', $fixture[0]->getCommunity());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new IksCouncilMembers();
        $fixture->setName('My Title');
        $fixture->setRole('My Title');
        $fixture->setExpertise('My Title');
        $fixture->setCommunity('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/iks/council/members/');
    }
}
