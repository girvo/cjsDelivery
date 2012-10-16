<?php
/**
 * @author Matthew Caruana Galizia <m@m.cg>
 * @copyright Copyright (c) 2012, Matthew Caruana Galizia
 * @package cjsDelivery
 */

namespace cjsDelivery;

require_once __DIR__.'/identifierManager.php';

class fileIdentifierManager implements identifierManager {
	private $identifiergenerator;

	private $modules = array();

	public function __construct(identifierGenerator $identifiergenerator) {
		$this->setIdentifierGenerator($identifiergenerator);
	}

	public function setIdentifierGenerator(identifierGenerator $identifiergenerator) {
		$this->identifiergenerator = $identifiergenerator;
	}

	public function getIdentifierGenerator() {
		return $this->identifiergenerator;
	}


	/**
	 * @see identifierManager::getFlattenedIdentifier()
	 * @param string $realpath The canonicalized absolute pathname of the module
	 */
	public function getFlattenedIdentifier($realpath) {
		if (!in_array($realpath, $this->modules[])) {
			throw new cjsDeliveryException("Unknown module '$realpath'", cjsDeliveryException::UNKNOWN_MODULE);
		}

		return $this->identifiergenerator->generateFlattenedIdentifier($realpath);
	}


	/**
	 * @see identifierManager::getTopLevelIdentifier()
	 * @param string $filepath Path to the module file
	 * @return string The canonicalized absolute pathname of the module
	 */
	public function getTopLevelIdentifier($filepath) {
		$realpath = realpath($filepath);

		// Check if the path was resolved
		if ($realpath === false) {
			throw new cjsDeliveryException("Module not found at '$filepath'", cjsDeliveryException::MODULE_NOT_FOUND);
		}

		return $realpath;
	}


	/**
	 * @see identifierManager::addIdentifier()
	 * @param string $filepath Path to the module file
	 * @return string The canonicalized absolute pathname of the module
	 */
	public function addIdentifier($filepath) {
		$realpath = $this->getTopLevelIdentifier($filepath);
		if (!in_array($realpath, $this->modules)) {
			$this->modules[] = $realpath;
	 	}

		return $realpath;
	}
}