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

use Brickrouge\Button;
use Brickrouge\Element;

class InstallForm extends Element
{
	public function __construct()
	{
		$action = new Button("Install", array('class' => 'btn btn-primary', 'type' => 'submit'));

		parent::__construct
		(
			'div', array
			(
				PanelDecorator::TITLE => t('panel.install.title'),

				Element::CHILDREN => array
				(
					t('panel.install.content', array('action' => $action))
				),

				'name' => 'install'
			)
		);
	}
}