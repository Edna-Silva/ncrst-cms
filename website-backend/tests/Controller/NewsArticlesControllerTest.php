<?php

namespace App\Test\Controller;

use App\Entity\NewsArticles;
use App\Repository\NewsArticlesRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewsArticlesControllerTest extends WebTestCase
{
    /** @var KernelBrowser */
    private $client;
    /** @var NewsArticlesRepository */
    private $repository;
    private $path = '/news/articles/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(NewsArticles::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('NewsArticle index');

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
            'news_article[title]' => 'Testing',
            'news_article[excerpt]' => 'Testing',
            'news_article[content]' => 'Testing',
            'news_article[read_time]' => 'Testing',
            'news_article[image_url]' => 'Testing',
            'news_article[featured]' => 'Testing',
            'news_article[created_at]' => 'Testing',
            'news_article[category]' => 'Testing',
        ]);

        self::assertResponseRedirects('/news/articles/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new NewsArticles();
        $fixture->setTitle('My Title');
        $fixture->setExcerpt('My Title');
        $fixture->setContent('My Title');
        $fixture->setRead_time('My Title');
        $fixture->setImage_url('My Title');
        $fixture->setFeatured('My Title');
        $fixture->setCreated_at('My Title');
        $fixture->setCategory('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('NewsArticle');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new NewsArticles();
        $fixture->setTitle('My Title');
        $fixture->setExcerpt('My Title');
        $fixture->setContent('My Title');
        $fixture->setRead_time('My Title');
        $fixture->setImage_url('My Title');
        $fixture->setFeatured('My Title');
        $fixture->setCreated_at('My Title');
        $fixture->setCategory('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'news_article[title]' => 'Something New',
            'news_article[excerpt]' => 'Something New',
            'news_article[content]' => 'Something New',
            'news_article[read_time]' => 'Something New',
            'news_article[image_url]' => 'Something New',
            'news_article[featured]' => 'Something New',
            'news_article[created_at]' => 'Something New',
            'news_article[category]' => 'Something New',
        ]);

        self::assertResponseRedirects('/news/articles/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getExcerpt());
        self::assertSame('Something New', $fixture[0]->getContent());
        self::assertSame('Something New', $fixture[0]->getRead_time());
        self::assertSame('Something New', $fixture[0]->getImage_url());
        self::assertSame('Something New', $fixture[0]->getFeatured());
        self::assertSame('Something New', $fixture[0]->getCreated_at());
        self::assertSame('Something New', $fixture[0]->getCategory());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new NewsArticles();
        $fixture->setTitle('My Title');
        $fixture->setExcerpt('My Title');
        $fixture->setContent('My Title');
        $fixture->setRead_time('My Title');
        $fixture->setImage_url('My Title');
        $fixture->setFeatured('My Title');
        $fixture->setCreated_at('My Title');
        $fixture->setCategory('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/news/articles/');
    }
}
