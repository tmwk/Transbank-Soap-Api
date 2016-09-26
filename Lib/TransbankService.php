<?php

namespace Tmwk\TransbankBundle\Lib;

use Tmwk\TransbankBundle\Lib\Log\LoggerInterface;

/**
 * Class TransbankService
 * @package Tmwk\TransbankBundle\Lib
 */
abstract class TransbankService
{
	/**
	 * @param LoggerInterface|null $logger
	 */
	public function debug(LoggerInterface $logger = null)
	{
		$this->service->setLogger($logger);
	}
}