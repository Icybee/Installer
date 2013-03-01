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

use Brickrouge\Element;

class LanguageElement extends Element
{
	public function __construct(array $attributes=array())
	{
		parent::__construct
		(
			'select', $attributes + array
			(
				Element::OPTIONS => array
				(
					null => '',
					'en' => 'English',
					'fr' => 'French'
				),

				Element::INLINE_HELP => t('language.description')
			)
		);
	}
}