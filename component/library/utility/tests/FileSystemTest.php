<?php
/**
 * WellCart Utility Library
 *
 * @copyright    Copyright (c) 2017 WellCart Dev Team (http://wellcart.org)
 * @license      http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */

namespace WellCart\Utility;

use WellCart\Test\TestCase;

/**
 * File system test.
 *
 */
class FileSystemTest extends TestCase
{

    /**
     * @var FileSystem
     */
    protected $fs;

    protected $dir;

    public function setUp()
    {
        $this->dir = __DIR__ . '/Resources/';
        $this->fs = new FileSystem();
    }

    public function testHelpers()
    {
        $file = $this->dir . 'FileTest.txt';

        $this->assertTrue($this->fs->exists($file));
        $this->assertTrue($this->fs->isFile($file));
        $this->assertFalse($this->fs->isDirectory($file));
        $this->assertTrue($this->fs->isReadable($file));
        $this->assertTrue($this->fs->isWritable($file));
        $this->assertNotNull($this->fs->lastModified($file));
        $this->assertEquals(2, $this->fs->size($file));
        $this->assertEquals('txt', $this->fs->extension($file));
        $this->assertEquals('text/plain', $this->fs->mime($file));
        $this->assertEquals('42', $this->fs->getContents($file));
        $this->assertInstanceOf('SplFileObject', $this->fs->file($file));
    }

    public function testIsDirectoryEmpty()
    {
        $this->assertFalse($this->fs->isDirectoryEmpty($this->dir));
        $this->fs->createDirectory($this->dir . 'empty');
        $this->assertTrue($this->fs->isDirectoryEmpty($this->dir . 'empty'));
        $this->assertTrue($this->fs->deleteDirectory($this->dir . 'empty'));
    }

    public function testDeleteFile()
    {
        touch($this->dir . 'FileForDeleting.txt');
        chmod($this->dir . 'FileForDeleting.txt', 0777);
        $this->assertTrue(
            $this->fs->delete($this->dir . 'FileForDeleting.txt')
        );
    }

    public function deleteDirectory()
    {
        $this->dir = __DIR__ . '/Resources/DirectoryForDeleting/';
        $this->fs->createDirectory($this->dir);
        $this->assertTrue($this->fs->deleteDirectory($this->dir));

        $this->fs->createDirectory($this->dir . 'Demo');
        $this->assertTrue($this->fs->deleteDirectory($this->dir . 'Demo'));
    }

    public function testGlob()
    {
        $this->dir = __DIR__;
        $files = $this->fs->glob($this->dir . '/*.php');
        $this->assertTrue(is_array($files));
        $this->assertTrue(count($files) > 0);
    }

    public function testPutContents()
    {
        $file = $this->dir . __FUNCTION__ . '.txt';
        $this->fs->putContents($file, 'data');
        $this->assertEquals('data', file_get_contents($file));
        unlink($file);
    }

    public function testAppendContents()
    {
        $file = $this->dir . __FUNCTION__ . '.txt';
        $this->fs->putContents($file, 'one-');
        $this->fs->appendContents($file, 'two');
        $this->assertEquals('one-two', file_get_contents($file));
        unlink($file);
    }

    public function testPrependContents()
    {
        $file = $this->dir . __FUNCTION__ . '.txt';
        $this->fs->putContents($file, 'two');
        $this->fs->prependContents($file, 'one-');
        $this->assertEquals('one-two', file_get_contents($file));
        unlink($file);
    }

    public function testTruncate()
    {
        $file = $this->dir . __FUNCTION__ . '.txt';
        $this->fs->putContents($file, 'text');
        $this->fs->truncateContents($file);
        $this->assertEquals('', file_get_contents($file));
        unlink($file);
    }
}