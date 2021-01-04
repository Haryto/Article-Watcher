<?php


namespace ArticleWatcher\Config;

/**
 * Class for .json config files.
 */
class ConfigJson extends ConfigAbstract
{
    /**
     * @inheritDoc
     */
    public function parseConfig(): array
    {
        $configContent = [];

        $configContentRaw = file_get_contents($this->fileName);

        if($configContentRaw) {
            $configContent = json_decode($configContentRaw, true);

            if(!$configContent)
                throw new \RuntimeException(sprintf('Invalid JSON format in "%s"', $this->fileName));
        }

        return $configContent;
    }
}