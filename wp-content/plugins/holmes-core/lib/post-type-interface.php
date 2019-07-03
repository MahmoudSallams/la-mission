<?php

namespace HolmesCore\Lib;

/**
 * interface PostTypeInterface
 * @package HolmesCore\Lib;
 */
interface PostTypeInterface {
	/**
	 * @return string
	 */
	public function getBase();
	
	/**
	 * Registers custom post type with WordPress
	 */
	public function register();
}