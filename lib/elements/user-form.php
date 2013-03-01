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

class UserForm extends PanelForm
{
	public function __construct()
	{
		global $core;

		$values = array();

		if (isset($core->session->install['user']))
		{
			$values = $core->session->install['user'];

			if (isset($values['password']))
			{
				$values['password'];
				$values['password_confirm'] = $values['password'];
			}
		}

		$random_password = \ICanBoogie\generate_token(8, \ICanBoogie\TOKEN_MEDIUM);

		parent::__construct
		(
			array
			(
				PanelDecorator::TITLE => t('panel.user.title'),
				PanelDecorator::DESCRIPTION => t('panel.user.description'),

				Form::VALUES => $values,
				Form::HIDDENS => array
				(
					'random_password' => $random_password
				),

				Element::CHILDREN => array
				(
					'username' => new Text
					(
						array
						(
							Group::LABEL => 'Username',
							Element::DESCRIPTION => t('panel.user.username'),
							Element::DEFAULT_VALUE => 'admin'
						)
					),

					'email' => new Text
					(
						array
						(
							Group::LABEL => 'Your E-mail',
							Element::REQUIRED => true,
							Element::DESCRIPTION => t('panel.user.email')
						)
					),

					'password' => new Text
					(
						array
						(
							Group::LABEL => 'Password',
							Element::DESCRIPTION => t('panel.user.password'),

							'type' => 'password',
							'placeholder' => $random_password
						)
					),

					'password_confirm' => new Text
					(
						array
						(
							Element::DESCRIPTION => t('panel.user.password_confirm'),
							Element::LABEL_MISSING => "Password confirm",

							'type' => 'password',
							'placeholder' => empty($values['password']) ? $random_password : null
						)
					),

					'language' => new LanguageElement
					(
						array
						(
							Group::LABEL => 'Language',
							Element::DESCRIPTION => t('panel.user.language')
						)
					)
				),

				'action' => '/api/install/user',
				'autocomplete' => 'off',
				'name' => 'user'
			)
		);
	}
}