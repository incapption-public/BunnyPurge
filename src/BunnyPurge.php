<?php

namespace Incapption\BunnyPurge;

use GuzzleHttp\Client;
use InvalidArgumentException;

/**
 * Bunny CDN class for purging files
 *
 * @version  1.0
 * @author incapption
 */
class BunnyPurge
{
	const BUNNY_API_URL = 'https://bunnycdn.com/api/';

	/**
	 * @var string
	 */
	private $apiKey;

	/**
	 * @var Client
	 */
	private $client;

	/**
	 * @var bool
	 */
	private $throwHttpExceptions;

	public function __construct(string $apiKey, bool $throwHttpExceptions = true)
	{
		if(empty($apiKey))
		{
			throw new InvalidArgumentException('Api Key is required');
		}
		else
		{
			$this->apiKey = $apiKey;
		}

		$this->throwHttpExceptions = (bool)$throwHttpExceptions;

		$this->client = new Client([
			'base_uri' => self::BUNNY_API_URL,
			'timeout'  => 5.0
		]);
	}

	public function purge(string $url) : string
	{
		$response = $this->client->request('POST', 'purge', [
			'http_errors' => $this->throwHttpExceptions,
			'query' => ['url' => urlencode($url)]
		]);

		return $response->getBody()->getContents();
	}
}