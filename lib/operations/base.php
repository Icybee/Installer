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

abstract class Operation extends \ICanBoogie\Operation
{
	protected function get_installer_operation_id()
	{
		return strtolower(substr(basename(strtr(get_class($this), '\\', '/')), 0, -9));
	}

	public function __invoke(Request $request)
	{
		global $core;

		$core->session->install['done'][$this->installer_operation_id] = false;

		return parent::__invoke($request);
	}

	protected function process()
	{
		global $core;

		$core->session->install['done'][$this->installer_operation_id] = true;

		return true;
	}
}
