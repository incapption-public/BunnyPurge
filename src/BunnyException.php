<?php

namespace Incapption\BunnyPurge;

use Exception;

class BunnyException extends Exception
{
	/**
	 * @var int
	 */
	private $statusCode;

    // Die Exception neu definieren, damit die Mitteilung nicht optional ist
    public function __construct(string $message, int $statusCode, int $code = 0, Exception $previous = null)
    {
    	parent::__construct($message, $code, $previous);
    	$this->setStatusCode($statusCode);
    }

    /**
	 * @return int
	 */
	public function getStatusCode(): int
	{
		return $this->statusCode;
	}

	/**
	 * @param int $statusCode
	 */
	private function setStatusCode(int $statusCode): void
	{
		$this->statusCode = $statusCode;
	}
}