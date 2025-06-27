<?php

namespace App\Test\Controller;

use App\Entity\ContactDepartments;
use App\Repository\ContactDepartmentsRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactDepartmentsControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var ContactDepartmentsRepository */
    private $repository;
    private $path = '/contact/departments/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(ContactDepartments::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ContactDepartment index');

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
            'contact_department[name]' => 'Testing',
            'contact_department[contact]' => 'Testing',
            'contact_department[phone]' => 'Testing',
            'contact_department[description]' => 'Testing',
        ]);

        self::assertResponseRedirects('/contact/departments/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new ContactDepartments();
        $fixture->setName('My Title');
        $fixture->setContact('My Title');
        $fixture->setPhone('My Title');
        $fixture->setDescription('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ContactDepartment');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new ContactDepartments();
        $fixture->setName('My Title');
        $fixture->setContact('My Title');
        $fixture->setPhone('My Title');
        $fixture->setDescription('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'contact_department[name]' => 'Something New',
            'contact_department[contact]' => 'Something New',
            'contact_department[phone]' => 'Something New',
            'contact_department[description]' => 'Something New',
        ]);

        self::assertResponseRedirects('/contact/departments/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getContact());
        self::assertSame('Something New', $fixture[0]->getPhone());
        self::assertSame('Something New', $fixture[0]->getDescription());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new ContactDepartments();
        $fixture->setName('My Title');
        $fixture->setContact('My Title');
        $fixture->setPhone('My Title');
        $fixture->setDescription('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/contact/departments/');
    }
}
