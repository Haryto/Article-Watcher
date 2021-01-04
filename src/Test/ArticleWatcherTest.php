<?php

namespace ArticleWatcher;

use ArticleWatcher\Config\ConfigStub;
use ArticleWatcher\Config\ConfigStubValues;
use PHPUnit\Framework\TestCase;

/**
 * Test class for {@link ArticleWatcher} functionality.
 */
class ArticleWatcherTest extends TestCase
{
    /**
     * Check that for default correct configs 10 latest articles are returned.
     */
    public function testSuccess()
    {
        $articleWatcher = new ArticleWatcher();

        $config = new ConfigStub(ConfigStubValues::CORRECT_CONFIG);

        $articleWatcher->setConfig($config);

        $articles = $articleWatcher->getArticles();

        $this->assertIsArray($articles);
        $this->assertNotEmpty($articles);

        // We should check only first element because we do not know exact number of articles to be found.
        $this->assertArrayHasKey('title', $articles[0]);
        $this->assertArrayHasKey('timestamp', $articles[0]);
    }

    /**
     * Check that no articles found.
     */
    public function testNoArticles()
    {
        $articleWatcher = new ArticleWatcher();

        $config = new ConfigStub(ConfigStubValues::NO_ARTICLES_CONFIG);

        $articleWatcher->setConfig($config);

        $articles = $articleWatcher->getArticles();

        $this->assertIsArray($articles);
        $this->assertEmpty($articles);
    }

    /**
     * Check that when config file is empty - default params are used and 10 latest articles are returned.
     */
    public function testEmptyConfig()
    {
        $articleWatcher = new ArticleWatcher();

        $config = new ConfigStub(ConfigStubValues::EMPTY_CONFIG);

        $articleWatcher->setConfig($config);

        $articles = $articleWatcher->getArticles();

        $this->assertIsArray($articles);
        $this->assertNotEmpty($articles);

        // We should check only first element because we do not know exact number of articles to be found.
        $this->assertArrayHasKey('title', $articles[0]);
        $this->assertArrayHasKey('timestamp', $articles[0]);
    }
}