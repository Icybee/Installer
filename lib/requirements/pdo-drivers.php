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

/**
 * Requirements for the PDO drivers.
 */
class PDODriversRequirement extends Requirement
{
	public function __construct()
	{
		$this->title = t('requirement.pdo_drivers.title');
		$this->description = t('requirement.pdo_drivers.description', array('action' => new TellMeMore('database'),));
	}

	public function __invoke(Errors $errors)
	{
		$drivers = \PDO::getAvailableDrivers();
		$drivers = array_combine($drivers, $drivers);

		if (empty($drivers['mysql']))
		{
			$errors['pdo_drivers'] = t('requirement.pdo_drivers.error.missing', array('name' => 'MySQL'));
		}

		if (empty($drivers['sqlite']))
		{
			$errors['pdo_drivers'] = t('requirement.pdo_drivers.error.missing', array('name' => 'SQLite'));
		}
	}
}