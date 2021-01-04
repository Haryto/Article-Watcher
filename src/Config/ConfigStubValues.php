<?php


namespace ArticleWatcher\Config;

/**
 * Contains all possible values for {@link ConfigStub} configs.
 */
class ConfigStubValues
{
    /**
     * Correctly filled config file, which is used to get latest 10 articles.
     */
    public const CORRECT_CONFIG = 'correct_config';

    /**
     * Empty config file.
     */
    public const EMPTY_CONFIG = 'empty_config';

    /**
     * Config file, which provides category or/and wiki without articles.
     */
    public const NO_ARTICLES_CONFIG = 'no_articles_config';
}