<?php
/**
 * @author Matthew Caruana Galizia <m@m.cg>
 * @copyright Copyright (c) 2012, Matthew Caruana Galizia
 * @package cjsDelivery
 */

class cjsDeliveryException extends Exception {
	const MODULE_NOT_FOUND = 1;
	const UNKNOWN_MODULE   = 2;
	const UNABLE_TO_READ   = 3;
	const NO_MAIN          = 4;

	public function __construct($message, $code, Exception $previous = null) {
		parent::__construct($message, $code, $previous);
	}
}