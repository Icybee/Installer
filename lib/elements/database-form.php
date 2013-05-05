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
use Brickrouge\Form;
use Brickrouge\Group;
use Brickrouge\Text;

class DatabaseForm extends PanelForm
{
	public function __construct()
	{
		global $core;

		$values = array();

		if (isset($core->session->install['database']))
		{
			$values = $core->session->install['database'];
		}

		parent::__construct
		(
			array
			(
				PanelDecorator::TITLE => t('panel.database.title'),
				PanelDecorator::DESCRIPTION => t('panel.database.description'),

				Form::VALUES => $values,

				Element::CHILDREN => array
				(
					'username' => new Text
					(
						array
						(
							Group::LABEL => "User name",
							Element::REQUIRED => true,
							Element::DESCRIPTION => t('panel.database.username')
						)
					),

					'password' => new Text
					(
						array
						(
							Group::LABEL => "Password",

							'type' => 'password'
						)
					),

					'name' => new Text
					(
						array
						(
							Group::LABEL => "Database name",
							Element::REQUIRED => true,
							Element::DESCRIPTION => t('panel.database.name'),
							Element::DEFAULT_VALUE => "icybee"
						)
					),

					'host' => new Text
					(
						array
						(
							Group::LABEL => "Database host",

							'placeholder' => "localhost"
						)
					),

					'prefix' => new Text
					(
						array
						(
							Group::LABEL => "Table prefix",
							Element::DESCRIPTION => t('panel.database.prefix')
						)
					)
				),

				'action' => '/api/install/database',
				'autocomplete' => 'off',
				'name' => 'database'
			)
		);
	}
}
