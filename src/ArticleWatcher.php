<?php

namespace ArticleWatcher;

use ArticleWatcher\Config\ConfigAbstract;

/**
 * Class for getting articles of specified category from specified wiki.
 */
class ArticleWatcher
{
    /**
     * Configs provider.
     *
     * @var ConfigAbstract
     */
    private $config;

    /**
     * Wiki API endpoint.
     * Set by default and is replaced by value from configs (if provided).
     *
     * @var string
     */
    private $endPoint = 'https://www.mediawiki.org/w/api.php';

    /**
     * Params used to get necessary articles from specified wiki.
     * Param <var>cmtitle</var> may be replaced by value from configs (if provided).
     *
     * @var array
     */
    private $params = [
        'action' => 'query',
        'list' => 'categorymembers',
        'cmtitle' => 'Category:BlueSpice',
        'cmlimit' => '10',
        'cmsort' => 'timestamp',
        'cmdir' => 'desc',
        'cmprop' => 'title|timestamp',
        'format' => 'json'
    ];

    /**
     * Updates params if they are provided from configs.
     */
    private function updateParams(): void
    {
        $params = $this->config->parseConfig();

        if(!empty($params['category']))
            $this->params['cmtitle'] = 'Category:' . $params['category'];

        if(!empty($params['wiki']))
            $this->endPoint = $params['wiki'];
    }

    /**
     * Config provider setter.
     *
     * @param ConfigAbstract $config
     */
    public function setConfig(ConfigAbstract $config): void
    {
        $this->config = $config;
    }

    /**
     * Builds and sends query to API of specified wiki.
     * Gets articles depended on {@link ArticleWatcher::$params}.
     *
     * @return array List of articles, which were found.
     *  Contains necessary properties described in {@link ArticleWatcher::$params} in <var>cmprop</var> key.
     *  Empty array if no articles was found.
     */
    public function getArticles(): array
    {
        $this->updateParams();

        $url = $this->endPoint . '?' . http_build_query($this->params);

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($curl);
        curl_close($curl);

        if($output) {
            $result = json_decode($output, true);
            return $result['query']['categorymembers'];
        }
        else {
            return [];
        }
    }
}