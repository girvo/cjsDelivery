<?php
/**
 * @author Matthew Caruana Galizia <m@m.cg>
 * @copyright Copyright (c) 2012, Matthew Caruana Galizia
 * @package cjsDelivery
 */

namespace cjsDelivery;

require_once 'IdentifierGenerator.php';

class FlatIdentifierGenerator implements IdentifierGenerator {
	private $modules = array();
	private $counts = array();


	/**
	 * @see IdentifierGenerator::generateFlattenedIdentifier
	 */
	public function generateFlattenedIdentifier($toplevelidentifier)  {
		if (!isset($this->modules[$toplevelidentifier])) {
			$basename = basename($toplevelidentifier, '.' . pathinfo($toplevelidentifier, PATHINFO_EXTENSION));
	 		$this->modules[$toplevelidentifier] = $basename;

	 		if (!isset($this->counts[$basename])) {
		 		$count = 0;
		 		$this->counts[$basename] = array($toplevelidentifier => $count);
		 	} else {
			 	$count = count($this->counts[$basename]);
			 	$this->counts[$basename][$toplevelidentifier] = $count;
	 		}
		} else {
			$basename = $this->modules[$toplevelidentifier];
			$count = $this->counts[$basename][$toplevelidentifier];
		}

		if ($count > 0) {
			return $basename . $count;
		}

		return $basename;
	}
}