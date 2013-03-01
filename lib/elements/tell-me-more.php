<?php

/*
 * This file is part of the Icybee/Installer package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Icybee\Installer;

use ICanBoogie\I18n;

/**
 * Creates a link to the install documentation on icybee.org.
 */
class TellMeMore extends \Brickrouge\A
{
	public function __construct($anchor, array $attributes=array())
	{
		parent::__construct
		(
			"Tell me more…", 'http://icybee.org/' . I18n\get_language() . '/install#' . $anchor, $attributes + array
			(
				'target' => '_blank'
			)
		);
	}
}