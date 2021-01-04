<?php

namespace ArticleWatcher\Config\Test;

use ArticleWatcher\Config\ConfigJson;
use PHPUnit\Framework\TestCase;

/**
 * Test class for {@link ConfigJson} functionality.
 */
class ConfigJsonTest extends TestCase
{
    /**
     * Check that existing file is parsed correctly.
     */
    public function testSuccess(): void
    {
        $data = json_encode([
            'wiki' => 'https://some_test_wiki.com/w/api.php',
            'category' => 'TestCategory'
        ]);

        file_put_contents('config_test.json', $data);

        $config = new ConfigJson('config_test.json');

        $configParsed = $config->parseConfig();
        $this->assertIsArray($configParsed);

        $this->assertEquals([
            'wiki' => 'https://some_test_wiki.com/w/api.php',
            'category' => 'TestCategory'
        ], $configParsed);
    }

    /**
     * Check that invalid format of file generates exception.
     */
    public function testInvalidFormat(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Invalid JSON format');

        $data = json_encode([
            'wiki' => 'https://some_test_wiki.com/w/api.php',
            'category' => 'TestCategory'
        ]);

        // Break JSON format to cause exception.
        $data .= '---///';

        file_put_contents('config_test_invalid.json', $data);

        $config = new ConfigJson('config_test_invalid.json');

        $config->parseConfig();
    }

    /**
     * Check that non-existing file generates exception.
     */
    public function testFileNotExist(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('does not exist');

        $config = new ConfigJson('non_existing_file.json');
    }

    /**
     * @inheritDoc
     */
    public function tearDown(): void
    {
        if(file_exists('config_test.json'))
            unlink('config_test.json');

        if(file_exists('config_test_invalid.json'))
            unlink('config_test_invalid.json');
    }
}
