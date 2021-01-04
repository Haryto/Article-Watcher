<?php


namespace ArticleWatcher\Config;

use ArticleWatcher\ArticleWatcherTest;

/**
 * Stub config class which does not need any file and just returns fixed value.
 * Created for testing purposes.
 *
 * Can imitate such files depending on specified stub filename:
 * * {@link ConfigStubValues::EMPTY_CONFIG} - empty config file;
 * * {@link ConfigStubValues::CORRECT_CONFIG} - correctly filled config file, which is used to get latest 10 articles;
 * * {@link ConfigStubValues::NO_ARTICLES_CONFIG} - config file, which provides category or/and wiki without articles.
 *
 * @see ArticleWatcherTest
 */
class ConfigStub extends ConfigAbstract
{
    /**
     * @inheritDoc
     */
    protected function checkValid(string $fileName): void
    {
        return;
    }

    /**
     * @inheritDoc
     */
    public function parseConfig(): array
    {
        switch($this->fileName) {
            case ConfigStubValues::EMPTY_CONFIG:
                $configParsed = [];

                break;
            case ConfigStubValues::CORRECT_CONFIG:
                $configParsed = [
                    'wiki' => 'https://www.mediawiki.org/w/api.php',
                    'category' => 'BlueSpice'
                ];

                break;
            case ConfigStubValues::NO_ARTICLES_CONFIG:
                $configParsed = [
                    'wiki' => 'https://some_wiki.org/w/api.php',
                    'category' => 'SomeCategory'
                ];

                break;
            default:
                throw new \DomainException('Unknown stub file name.');
        }

        return $configParsed;
    }
}