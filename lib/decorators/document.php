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
 * Decorates the component with an HTML document.
 */
class DocumentDecorator
{
	protected $component;

	public function __construct($component)
	{
		$this->component = $component;
	}

	public function render()
	{
		global $core;

		$component = (string) $this->component;

		$document = $core->document;
		$document->css->add(\Brickrouge\ASSETS . 'brickrouge.css', -100);
		$document->css->add(\Icybee\ASSETS . 'admin.css', -100);
		$document->css->add(\Icybee\ASSETS . 'admin-more.css', -100);
		$document->css->add(ASSETS . 'page.css');

		$document->js->add(\Icybee\ASSETS . 'mootools-core.js', -100);
		$document->js->add(\Icybee\ASSETS . 'mootools-more.js', -100);
		$document->js->add(\ICanBoogie\ASSETS . 'icanboogie.js', -100);
		$document->js->add(\Brickrouge\ASSETS . 'brickrouge.js', -100);
		$document->js->add(ASSETS . 'page.js');

		$title = t('document_title');

		$hl = new Element
		(
			'select', array
			(
				Element::OPTIONS => array
				(
					'en' => 'English',
					'fr' => 'Français'
				),

				'class' => 'span2',
				'value' => $core->language,
				'id' => 'hl'
			)
		);

		return <<<EOT
<!DOCTYPE html>
<html lang="{$core->language}">
<head>
<meta charset="utf-8">
<title>{$title}</title>
{$document->css}
</head>
<body id="installer">

	<div id="quick">
		<div class="pull-left">
			<div class="btn-group">Icybee</div>
		</div>
	</div>

	<div class="actionbar">
		<div class="actionbar-title">
			<h1>{$title}</h1>
		</div>

		<div class="pull-right">$hl</div>
	</div>

	<div class="container">
		{$component}
	</div>

{$document->js}
</body>
</html>
EOT;
	}

	public function __toString()
	{
		try
		{
			return (string) $this->render();
		}
		catch (\Exception $e)
		{
			return \Brickrouge\render_exception($e);
		}
	}
}