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

/**
 * Decorates component with an install panel.
 */
class PanelDecorator
{
	const TITLE = '#panel-title';
	const DESCRIPTION = '#panel-description';

	/**
	 * Component to decorate.
	 *
	 * @var Element
	 */
	protected $component;

	public function __construct(Element $component)
	{
		$this->component = $component;
	}

	public function __toString()
	{
		try
		{
			return $this->render();
		}
		catch (\Exception $e)
		{
			return \Brickrouge\render_exception($e);
		}
	}

	public function render()
	{
		global $core;

		$panel = new Element
		(
			'div', array
			(
				'class' => 'install-panel'
			)
		);

		$component = $this->component;
		$rendered_component = (string) $component;
		$content = '';
		$name = $component['name'];
		$title = $component[self::TITLE];
		$description = $component[self::DESCRIPTION];

		if ($rendered_component)
		{
			$content = '<div class="install-panel-content">' . $rendered_component . '</div>';
		}
		else
		{
			$panel->add_class('no-content');
		}

		if ($name)
		{
			$panel['id'] = "panel-$name";
			$panel->add_class("install-panel--$name");
		}

		if (!empty($core->session->install['done'][$name]))
		{
			$panel->add_class('done');
		}

		$panel[Element::INNER_HTML] = <<<EOT
<div class="install-panel-inner">
	<h3 class="install-panel-title">$title</h3>
	<div class="install-panel-description">$description</div>
	$content
</div>
EOT;

		return (string) $panel;
	}
}