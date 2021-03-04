<?php

namespace Incapption\BunnyPurge;

use Exception;

class BunnyException extends Exception
{
	/**
	 * @var int
	 */
	private $statusCode;

    public function __construct(string $message, int $statusCode, Exception $previous = null)
    {
    	parent::__construct($message, $statusCode, $previous);
    	$this->statusCode = $statusCode;
    }

    /**
	 * @return int
	 */
	public function getStatusCode(): int
	{
		return $this->statusCode;
	}
}