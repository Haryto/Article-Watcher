# Article Watcher
__Gets latest 10 articles of specified category from specified wiki__

## Install
To install project, use
````
git clone https://github.com/Haryto/Article-Watcher.git
````
then use in the same folder
````
composer update
````

## Run
To retrieve latest 10 articles of specified category from specified wiki, run in root folder
````
php index.php
````

## Tests
To run tests, use in root folder
````
vendor/bin/phpunit
````

## Configs
Currently only such parameters can be changed:
* wiki, from which articles are retrieved
* category title, from which articles are retrieved in specified wiki

Therefore, in case of .ini format config file should look like that:
````
wiki="https://www.mediawiki.org/w/api.php"
category="BlueSpice"
````

To add new config format (like .ini or .json which are already provided),
create child class which will extend
````
\ArticleWatcher\Config\ConfigAbstract
````
and define method
````
\ArticleWatcher\Config\ConfigAbstract::parseConfig()
````
for necessary config format.
And then inject necessary config object to article watcher like that:
````
$configFileName = 'config.json';

$config = new \ArticleWatcher\Config\ConfigJson($configFileName);

$articleWatcher = new \ArticleWatcher\ArticleWatcher();
$articleWatcher->setConfig($config);
````

## License

[MIT License](https://opensource.org/licenses/MIT)