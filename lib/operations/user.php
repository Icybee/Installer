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

use ICanBoogie\Errors;
use ICanBoogie\HTTP\Request;
use ICanBoogie\I18n;
use ICanBoogie\I18n\FormattedString;

use Brickrouge\Element;

class UserOperation extends Operation
{
	protected function get_controls()
	{
		return array
		(
			self::CONTROL_FORM => true
		)

		+ parent::get_controls();
	}

	protected function get_form()
	{
		$form = new UserForm;

		$form->children['password'][Element::REQUIRED] = true;
		$form->children['password_confirm'][Element::REQUIRED] = true;

		return $form;
	}

	public function __invoke(Request $request)
	{
		$random_password = $request['random_password'];

		if ($random_password && !$request['password'] && !$request['password_confirm'])
		{
			$request['password'] = $random_password;
			$request['password_confirm'] = $random_password;
		}

		return parent::__invoke($request);
	}

	protected function validate(Errors $errors)
	{
		$request = $this->request;

		$password = $request['password'];
		$password_confirm = $request['password_confirm'];

		if ($password != $password_confirm)
		{
			$errors['password'] = I18n\t('panel.user.error.password_match');
			$errors['password_confirm'] = true;
		}

		return $errors;
	}

	protected function process()
	{
		global $core;

		$request = $this->request;

		$core->session->install['user'] = array
		(
			'username' => $request['username'],
			'email' => $request['email'],
			'password' => $request['password'],
			'language' => $request['language']
		);

		$this->response->message = I18n\t('panel.user.success');

		return parent::process();
	}
}