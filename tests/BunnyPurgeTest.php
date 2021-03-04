<?php

use Incapption\BunnyPurge\BunnyPurge;
use PHPUnit\Framework\TestCase;
use Incapption\BunnyPurge\BunnyException;

class BunnyPurgeTest extends TestCase
{
	protected function setUp() : void
    {
        if(!isset($GLOBALS['TEST_URL']))
        	throw new InvalidArgumentException("Please define the TEST_URL variable in phpunit.xml");

        if(!isset($GLOBALS['API_KEY']))
        	throw new InvalidArgumentException("Please define the API_KEY variable in phpunit.xml");
    }

	public function testConstructorThrowsExceptionEmptyApiKey()
    {
        $this->expectException(InvalidArgumentException::class);

        new BunnyPurge('');
    }

    public function testPurgeThrowsExceptionInvalidApiKey()
    {
        $this->expectException(BunnyException::class);

        $client = new BunnyPurge('TEST');
	    $client->purge($GLOBALS['TEST_URL']);
    }

    public function testValidRequest()
    {
        $client = new BunnyPurge($GLOBALS['API_KEY']);
	    $client->purge($GLOBALS['TEST_URL']);
	    $this->assertTrue(TRUE);
    }
}
