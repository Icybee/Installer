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
use ICanBoogie\I18n;
use ICanBoogie\I18n\FormattedString;

use Brickrouge\Alert;
use Brickrouge\Button;

class Requirements implements \IteratorAggregate
{
	static public function get()
	{
		return new static;
	}

	protected $title;
	protected $requirements;

	public function __construct($title, array $requirements)
	{
		$this->title = $title;
		$this->requirements = $requirements;
	}

	public function __invoke(Errors $errors)
	{
		foreach ($this->requirements as $requirement)
		{
			$requirement($errors);
		}

		return !$errors->count();
	}

	public function getIterator()
	{
		return new \ArrayIterator($this->requirements);
	}

	public function render()
	{
		$html = '';
		$errors = new Errors();

		foreach ($this->requirements as $id => $requirement)
		{
			$errors->clear();
			$requirement($errors);

			if (!$errors->count())
			{
				continue;
			}

			$html .= $requirement->render($errors);
		}

		if (!$html)
		{
			return;
		}

		$action = new Button("Check again", array('class' => 'btn-primary'));

		return <<<EOT
<div class="requirements">
	<h2>{$this->title}</h2>
	$html
	<p>{$action}</p>
</div>
EOT;
	}
}

class WelcomeRequirements extends Requirements
{
	public function __construct()
	{
		parent::__construct
		(
			I18n\t("Before we can continue, you need to check the following things:"), array
			(
				'repository' => new RepositoryRequirement,
				'pdo_drivers' => new PDODriversRequirement
			)
		);
	}
}

class InstallRequirements extends Requirements
{
	static public function get()
	{
		return new static
		(
			I18n\t("Before we can continue, you need to check the following things:"), array
			(
				'core_config' => new CoreConfigRequirement
			)
		);
	}
}

/**
 * Representation of a requirement.
 */
abstract class Requirement
{
	public $title;
	public $description;

	abstract public function __invoke(Errors $errors);

	/**
	 * Renders the requirement along with the specified errors.
	 *
	 * @param Errors $errors
	 *
	 * @return string
	 */
	public function render(Errors $errors)
	{
		$alert = new Alert($errors, array(Alert::UNDISSMISABLE => true));

		return <<<EOT
<div class="requirement">
	<h3 class="requirement-title">{$this->title}</h3>
	<div class="requirement-description">{$this->description}</div>
	{$alert}
</div>
EOT;
	}
}