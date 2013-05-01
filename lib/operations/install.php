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
use ICanBoogie\ActiveRecord\RecordNotFound;
use ICanBoogie\Errors;

use Icybee\Modules\Pages\Page;
use Icybee\Modules\Sites\Site;
use Icybee\Modules\Users\User;

class InstallOperation extends \ICanBoogie\Operation
{
	protected function validate(\ICanBoogie\Errors $errors)
	{
		return true;
	}

	protected function process()
	{
		$this->process_database();
		$errors = $this->process_modules();

		if ($errors->count())
		{
			$this->response->errors = $errors;

			return;
		}

		try
		{
			$this->process_site();
		}
		catch (\Exception $e)
		{
			throw new \Exception("Unable to create site record: " . $e->getMessage());
		}

		try
		{
			$this->process_user();
		}
		catch (\Exception $e)
		{
			throw new \Exception("Unable to create user record: " . $e->getMessage());
		}

		if (!$this->process_config())
		{
			return;
		}

		return;
	}

	/**
	 * Defines the `primary` connection.
	 */
	protected function process_database()
	{
		global $core;

		$options = $core->session->install['database'];

		$core->connections['primary'] = array
		(
			'dsn' => "mysql:dbname=" . $options['name'] . ";host=" . ($options['host'] ?: 'localhost'),
			'username' => $options['username'],
			'password' => $options['password'],

			Connection::TABLE_NAME_PREFIX => $options['prefix'],
			Connection::TIMEZONE => '+00:00'
		);

		$core->connections['primary'];
		$core->connections['local'];
	}

	/**
	 * Installs modules.
	 *
	 * @return \ICanBoogie\Errors
	 */
	protected function process_modules()
	{
		global $core;

		$modules = $core->modules;
		$modules->index;

		$ids = array();
		$errors = new Errors();
		$is_installed_errors = new Errors();

		foreach ($modules->descriptors as $id => $descriptor)
		{
			$ids[] = $id;
			$modules->enable($id);
		}

		foreach ($modules->descriptors as $id => $descriptor)
		{
			$module = $modules[$id];

			$is_installed_errors->clear();

			if (!$module->is_installed($is_installed_errors))
			{
				$module->install($errors);
			}
		}

		$core->vars['enabled_modules'] = $ids;

		\Icybee\Modules\Nodes\Module::create_default_routes();

		return $errors;
	}

	/**
	 * Creates site record.
	 */
	protected function process_site()
	{
		global $core;

		$site = $core->models['sites']->one;

		if (!$site)
		{
			$site = new Site;
		}

		$options = $core->session->install['site'];

		$site->title = $options['title'];
		$site->language = $options['language'];
		$site->timezone = $options['timezone'];
		$site->email = $core->session->install['user']['email'];
		$site->status = Site::STATUS_OK;

		$site->save();

		if (!$core->models['pages']->one)
		{
			$page = new Page();
			$page->title = "Home";
			$page->is_online = true;
			$page->uid = 1;
			$page->siteid = $site->siteid;
			$page->save();
		}
	}

	/**
	 * Creates user record.
	 */
	protected function process_user()
	{
		global $core;

		try
		{
			$user = $core->models['users'][1];
		}
		catch (RecordNotFound $e)
		{
			$user = new User;
		}

		$options = $core->session->install['user'];

		$user->username = $options['username'];
		$user->email = $options['email'];
		$user->password = $options['password'];
		$user->language = $options['language'];

		$user->save();
		$user->login();
	}

	protected function process_config()
	{
		$errors = new Errors;
		$requirements = InstallRequirements::get();

		if ($requirements($errors))
		{
			return;
		}

		$this->response['content'] = $requirements->render();
	}
}