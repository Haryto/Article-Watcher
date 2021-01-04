<?php

namespace ArticleWatcher\Config\Test;

use ArticleWatcher\Config\ConfigIni;
use PHPUnit\Framework\TestCase;

/**
 * Test class for {@link ConfigIni} functionality.
 */
class ConfigIniTest extends TestCase
{
    /**
     * Check that existing file is parsed correctly.
     */
    public function testSuccess(): void
    {
        $data =
            'wiki="https://some_test_wiki.com/w/api.php"' . "\n" .
            'category="TestCategory"';

        file_put_contents('config_test.ini', $data);

        $config = new ConfigIni('config_test.ini');

        $configParsed = $config->parseConfig();
        $this->assertIsArray($configParsed);

        $this->assertEquals([
            'wiki' => 'https://some_test_wiki.com/w/api.php',
            'category' => 'TestCategory'
        ], $configParsed);
    }

    /**
     * Check that non-existing file generates exception.
     */
    public function testFileNotExist(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('does not exist');

        $config = new ConfigIni('non_existing_file.ini');
    }

    /**
     * @inheritDoc
     */
    public function tearDown(): void
    {
        if(file_exists('config_test.ini'))
            unlink('config_test.ini');
    }
}