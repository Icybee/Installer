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

use ICanBoogie\ActiveRecord\Connection;
use ICanBoogie\ActiveRecord\ConnectionNotEstablished;
use ICanBoogie\I18n;

class DatabaseOperation extends Operation
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
		return new DatabaseForm;
	}

	protected function validate(\ICanBoogie\Errors $errors)
	{
		$request = $this->request;

		$name = $request['name'];
		$username = $request['username'];
		$password = $request['password'];
		$host = $request['host'];
		$prefix = $request['prefix'];

		try
		{
			$connection = new Connection
			(
				"mysql:dbname=$name;host=$host", $username, $password, array
				(
					Connection::TABLE_NAME_PREFIX => $prefix
				)
			);
		}
		catch (\PDOException $e)
		{
			$code = $e->getCode();

			if ($code == 1049)
			{
				$errors['name'] = I18n\t('panel.database.error.name');
			}
			else if ($code == 1045)
			{
				$errors['username'] = I18n\t('panel.database.error.username_password');
				$errors['password'] = true;
			}
			else if ($code == 2005)
			{
				$errors['host'] = I18n\t('panel.database.error.host');
			}
			else
			{
				throw $e;
			}
		}

		return $errors;
	}

	protected function process()
	{
		global $core;

		$request = $this->request;

		$core->session->install['database'] = array
		(
			'name' => $request['name'],
			'username' => $request['username'],
			'password' => $request['password'],
			'host' => $request['host'],
			'prefix' => $request['prefix']
		);

		$this->response->message = I18n\t('panel.database.success');

		return parent::process();
	}
}