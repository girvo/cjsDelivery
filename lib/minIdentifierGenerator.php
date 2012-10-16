<?php
/**
 * @author Matthew Caruana Galizia <m@m.cg>
 * @copyright Copyright (c) 2012, Matthew Caruana Galizia
 * @package cjsDelivery
 */

namespace cjsDelivery;

require_once __DIR__.'/identifierGenerator.php';

class minIdentifierGenerator implements identifierGenerator {
	private $minified = array();
	private $minifyposition = 65, $minifyiteration = 0;


	/**
	 * Get a minified version of a top level identifier
	 *
	 * @see identifierGenerator::generateFlattenedIdentifier
	 */
	public function generateFlattenedIdentifier($toplevelidentifier) {
		if (isset($this->minified[$toplevelidentifier])) {
			return $this->minified[$toplevelidentifier];
		}

		$char = chr($this->minifyposition);
		$mini = $char;
		for ($i = 0; $i < $this->minifyiteration; $i++) {
			$mini .= $char;
		}

		$this->minified[$toplevelidentifier] = $mini;

		if ($this->minifyposition === 90) {
			$this->minifyposition = 97;
		} else if ($this->minifyposition === 122) {
			$this->minifyposition = 65;
			$this->minifyiteration++;
		} else {
			$this->minifyposition++;
		}

		return $mini;
	}
}