<?php

namespace App\Test\Controller;

use App\Entity\InternshipBenefits;
use App\Repository\InternshipBenefitsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InternshipBenefitsControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var InternshipBenefitsRepository */
    private $repository;
    private $path = '/internship/benefits/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(InternshipBenefits::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('InternshipBenefit index');

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
            'internship_benefit[benefit]' => 'Testing',
            'internship_benefit[internship_programs]' => 'Testing',
        ]);

        self::assertResponseRedirects('/internship/benefits/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new InternshipBenefits();
        $fixture->setBenefit('My Title');
        $fixture->setInternship_programs('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('InternshipBenefit');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new InternshipBenefits();
        $fixture->setBenefit('My Title');
        $fixture->setInternship_programs('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'internship_benefit[benefit]' => 'Something New',
            'internship_benefit[internship_programs]' => 'Something New',
        ]);

        self::assertResponseRedirects('/internship/benefits/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getBenefit());
        self::assertSame('Something New', $fixture[0]->getInternship_programs());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new InternshipBenefits();
        $fixture->setBenefit('My Title');
        $fixture->setInternship_programs('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/internship/benefits/');
    }
}
