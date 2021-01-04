<?php


namespace ArticleWatcher\Config;


/**
 * Abstract class for all config classes.
 */
abstract class ConfigAbstract
{
    protected $fileName;

    /**
     * Does some checks to verify that specified file name is valid.
     *
     * @param string $fileName File name to check.
     *
     */
    protected function checkValid(string $fileName): void
    {
        if(!file_exists($fileName))
            throw new \RuntimeException(sprintf('File "%s" does not exist', $fileName));
    }

    /**
     * Constructor.
     *
     * @param string $fileName File name.
     */
    public function __construct(string $fileName)
    {
        $this->checkValid($fileName);

        $this->fileName = $fileName;
    }

    /**
     * Parses config file, specified in {@link ConfigAbstract::$fileName}.
     *
     * @return mixed Parsed configs as associated array.
     */
    abstract public function parseConfig(): array;
}