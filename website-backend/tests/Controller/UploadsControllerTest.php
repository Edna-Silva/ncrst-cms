<?php

namespace App\Test\Controller;

use App\Entity\Uploads;
use App\Repository\UploadsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UploadsControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var UploadsRepository */
    private $repository;
    private $path = '/uploads/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Uploads::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Upload index');

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
            'upload[file_name]' => 'Testing',
            'upload[file_path]' => 'Testing',
            'upload[file_type]' => 'Testing',
            'upload[file_size]' => 'Testing',
            'upload[uploaded_at]' => 'Testing',
            'upload[user]' => 'Testing',
        ]);

        self::assertResponseRedirects('/uploads/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Uploads();
        $fixture->setFile_name('My Title');
        $fixture->setFile_path('My Title');
        $fixture->setFile_type('My Title');
        $fixture->setFile_size('My Title');
        $fixture->setUploaded_at('My Title');
        $fixture->setUser('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Upload');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Uploads();
        $fixture->setFile_name('My Title');
        $fixture->setFile_path('My Title');
        $fixture->setFile_type('My Title');
        $fixture->setFile_size('My Title');
        $fixture->setUploaded_at('My Title');
        $fixture->setUser('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'upload[file_name]' => 'Something New',
            'upload[file_path]' => 'Something New',
            'upload[file_type]' => 'Something New',
            'upload[file_size]' => 'Something New',
            'upload[uploaded_at]' => 'Something New',
            'upload[user]' => 'Something New',
        ]);

        self::assertResponseRedirects('/uploads/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getFile_name());
        self::assertSame('Something New', $fixture[0]->getFile_path());
        self::assertSame('Something New', $fixture[0]->getFile_type());
        self::assertSame('Something New', $fixture[0]->getFile_size());
        self::assertSame('Something New', $fixture[0]->getUploaded_at());
        self::assertSame('Something New', $fixture[0]->getUser());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Uploads();
        $fixture->setFile_name('My Title');
        $fixture->setFile_path('My Title');
        $fixture->setFile_type('My Title');
        $fixture->setFile_size('My Title');
        $fixture->setUploaded_at('My Title');
        $fixture->setUser('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/uploads/');
    }
}
