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
use ICanBoogie\HTTP\Response;

class StepsController extends \ICanBoogie\Routing\Controller
{
	public function __invoke(Request $request)
	{
		return new Response
		(
			new DocumentDecorator
			(
				new PanelDecorator(new WelcomePanel) .
				new PanelDecorator(new DatabaseForm) .
				new PanelDecorator(new SiteForm) .
				new PanelDecorator(new UserForm) .
				new PanelDecorator(new InstallForm)
			)
		);
	}
}