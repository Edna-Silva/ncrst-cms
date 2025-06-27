<?php

namespace App\Test\Controller;

use App\Entity\InnovationChallengeCategories;
use App\Repository\InnovationChallengeCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InnovationChallengeCategoriesControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var InnovationChallengeCategoriesRepository */
    private $repository;
    private $path = '/innovation/challenge/categories/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(InnovationChallengeCategories::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('InnovationChallengeCategory index');

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
            'innovation_challenge_category[category]' => 'Testing',
            'innovation_challenge_category[innovation_challenge]' => 'Testing',
        ]);

        self::assertResponseRedirects('/innovation/challenge/categories/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new InnovationChallengeCategories();
        $fixture->setCategory('My Title');
        $fixture->setInnovation_challenge('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('InnovationChallengeCategory');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new InnovationChallengeCategories();
        $fixture->setCategory('My Title');
        $fixture->setInnovation_challenge('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'innovation_challenge_category[category]' => 'Something New',
            'innovation_challenge_category[innovation_challenge]' => 'Something New',
        ]);

        self::assertResponseRedirects('/innovation/challenge/categories/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getCategory());
        self::assertSame('Something New', $fixture[0]->getInnovation_challenge());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new InnovationChallengeCategories();
        $fixture->setCategory('My Title');
        $fixture->setInnovation_challenge('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/innovation/challenge/categories/');
    }
}
