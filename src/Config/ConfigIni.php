<?php


namespace ArticleWatcher\Config;

/**
 * Class for .ini config files.
 */
class ConfigIni extends ConfigAbstract
{
    /**
     * @inheritDoc
     */
    public function parseConfig(): array
    {
        return parse_ini_file($this->fileName);
    }
}