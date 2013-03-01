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

use ICanBoogie\HTTP\Request;

use Brickrouge\Button;
use Brickrouge\Element;
use Brickrouge\Form;

/**
 * Base class for panel forms.
 */
class PanelForm extends Form
{
	public function __construct(array $attributes=array())
	{
		parent::__construct
		(
			$attributes + array
			(
				Form::ACTIONS => new Button("Continue", array('class' => 'btn btn-primary', 'type' => 'submit')),
				Form::RENDERER => 'Simple',

				'method' => Request::METHOD_PATCH,
				'class' => 'form-horizontal'
			)
		);
	}
}