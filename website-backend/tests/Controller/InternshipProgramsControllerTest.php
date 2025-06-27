<?php

namespace App\Test\Controller;

use App\Entity\InternshipPrograms;
use App\Repository\InternshipProgramsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InternshipProgramsControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var InternshipProgramsRepository */
    private $repository;
    private $path = '/internship/programs/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(InternshipPrograms::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('InternshipProgram index');

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
            'internship_program[title]' => 'Testing',
            'internship_program[duration]' => 'Testing',
            'internship_program[intake]' => 'Testing',
            'internship_program[eligibility]' => 'Testing',
            'internship_program[stipend]' => 'Testing',
            'internship_program[created_at]' => 'Testing',
        ]);

        self::assertResponseRedirects('/internship/programs/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new InternshipPrograms();
        $fixture->setTitle('My Title');
        $fixture->setDuration('My Title');
        $fixture->setIntake('My Title');
        $fixture->setEligibility('My Title');
        $fixture->setStipend('My Title');
        $fixture->setCreated_at('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('InternshipProgram');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new InternshipPrograms();
        $fixture->setTitle('My Title');
        $fixture->setDuration('My Title');
        $fixture->setIntake('My Title');
        $fixture->setEligibility('My Title');
        $fixture->setStipend('My Title');
        $fixture->setCreated_at('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'internship_program[title]' => 'Something New',
            'internship_program[duration]' => 'Something New',
            'internship_program[intake]' => 'Something New',
            'internship_program[eligibility]' => 'Something New',
            'internship_program[stipend]' => 'Something New',
            'internship_program[created_at]' => 'Something New',
        ]);

        self::assertResponseRedirects('/internship/programs/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getDuration());
        self::assertSame('Something New', $fixture[0]->getIntake());
        self::assertSame('Something New', $fixture[0]->getEligibility());
        self::assertSame('Something New', $fixture[0]->getStipend());
        self::assertSame('Something New', $fixture[0]->getCreated_at());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new InternshipPrograms();
        $fixture->setTitle('My Title');
        $fixture->setDuration('My Title');
        $fixture->setIntake('My Title');
        $fixture->setEligibility('My Title');
        $fixture->setStipend('My Title');
        $fixture->setCreated_at('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/internship/programs/');
    }
}
