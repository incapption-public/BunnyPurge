<?php

namespace Incapption\BunnyPurge;

use GuzzleHttp\Client;
use InvalidArgumentException;
use GuzzleHttp\Exception\BadResponseException;

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

	public function __construct(string $apiKey)
	{
		if(empty($apiKey))
		{
			throw new InvalidArgumentException('Api Key is required');
		}
		else
		{
			$this->apiKey = $apiKey;
		}

		$this->client = new Client([
			'allow_redirects' => false,
			'base_uri' => self::BUNNY_API_URL,
			'headers' => [
				'AccessKey' => $this->apiKey,
				'Accept' => 'application/json',
				'Content-Type' => 'application/json'
			],
			'http_errors' => false,
			'timeout'  => 5.0
		]);
	}

	public function purge(string $url) : void
	{
		$response = $this->client->request('POST', 'purge', [
			'query' => [
				'url' => urlencode($url)
			]
		]);

		if($response->getStatusCode() !== 200)
		{
			throw new BunnyException(
				$response->getBody()->getContents(),
				$response->getStatusCode());
		}
	}
}