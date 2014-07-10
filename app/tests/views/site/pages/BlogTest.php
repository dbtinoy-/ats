<?php

class JobTest extends BaseControllerTestCase {

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testIndexResponse()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertTrue($this->client->getResponse()->isOk());
    }


    public function testJobPostTitle()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertCount(1, $crawler->filter('h4:contains("In Iisque Similique Reprimique Eum")'));
    }

    public function testFirstArticleLink()
    {
        $crawler = $this->client->request('GET', '/');

        $link = $crawler->selectLink('In Iisque Similique Reprimique Eum')->link();

        $url = $link->getUri();

        $this->assertEqualsUrlPath($url, 'in-iisque-similique-reprimique-eum');
    }

    public function testJobPostTitle2()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertCount(1, $crawler->filter('h4:contains("Vivendo Suscipiantur Vim Te Vix")'));
    }

    public function testArticleLink2()
    {
        $crawler = $this->client->request('GET', '/');

        $link = $crawler->selectLink('Vivendo Suscipiantur Vim Te Vix')->link();

        $url = $link->getUri();

        $this->assertEqualsUrlPath($url, 'vivendo-suscipiantur-vim-te-vix');
    }

    public function testJobPostTitle3()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertCount(1, $crawler->filter('h4:contains("Lorem Ipsum Dolor Sit Amet")'));
    }

    public function testArticleLink3()
    {
        $crawler = $this->client->request('GET', '/');

        $link = $crawler->selectLink('Lorem Ipsum Dolor Sit Amet')->link();

        $url = $link->getUri();

        $this->assertEqualsUrlPath($url, 'lorem-ipsum-dolor-sit-amet');
    }

    public function testArticleComment()
    {
        $crawler = $this->client->request('GET', '/');

        $crawler->selectLink('1 Comment')->link();
    }

    public function testArticleComment2()
    {
        $crawler = $this->client->request('GET', '/');

        $crawler->selectLink('2 Comments')->link();
    }

    public function testArticleComment3()
    {
        $crawler = $this->client->request('GET', '/');

        $crawler->selectLink('3 Comments')->link();
    }

}