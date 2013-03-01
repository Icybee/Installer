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
 * Requirements for the "repository" directory.
 */
class RepositoryRequirement extends Requirement
{
	public function __construct()
	{
		$this->title = t('requirement.repository.title');
		$this->description = t('requirement.repository.description', array(':action' => new TellMeMore('repository')));
	}

	public function __invoke(Errors $errors)
	{
		$repository = \ICanBoogie\REPOSITORY;
		$repository_relative = \ICanBoogie\strip_root($repository);

		if (file_exists($repository))
		{
			if (!is_writable($repository))
			{
				$errors['repository'] = t('requirement.repository.error.not_writable', array('dir' => $repository_relative));
			}
		}
		else
		{
			$errors['repository'] = t('requirement.repository.error.missing', array('dir' => $repository_relative));
		}
	}
}