<?php

require_once "vendor/autoload.php";

// .ini config file.
$configFileName = 'config.ini';

// .json config file.
//$configFileName = 'config.json';

try {
    $config = new \ArticleWatcher\Config\ConfigIni($configFileName);

    //$config = new \ArticleWatcher\Config\ConfigJson($configFileName);

    $articleWatcher = new \ArticleWatcher\ArticleWatcher();
    $articleWatcher->setConfig($config);

    // Get articles by provided configs.
    $articles = $articleWatcher->getArticles();

    // Print title and timestamp for each found article.
    if($articles) {
        foreach ($articles as $page) {
            echo('Title: ' . $page['title'] . "\n" . 'Timestamp: ' . $page['timestamp'] . "\n\n");
        }
    }
    else {
        echo 'No articles was found.' . "\n";
    }
}
catch (RuntimeException $exception) {
    echo $exception->getMessage() . "\n";
}