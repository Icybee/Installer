<?php

return array
(
	# bootstrap.php

	'document_title' => "Installing Icybee",

	'panel' => array
	(
		# lib/elements/welcome-form.php

		'welcome' => array
		(
			'success' => "Requirements met",
			'title' => "Welcome",
			'description' => <<<EOT
<h1>Welcome to Icybee</h1>

<p>Before we get started, we need to gather some information in order to install the software and
setup the website and the admin account. In a few minutes you'll be logged to Icybee and ready
to build your website.</p>

:action
EOT
		),

		'database' => array
		(
			'success' => "Database settings saved",
			'error' => array
			(
				'name' => "This database does not exist or is not reachable.",
				'username_password' => "Unknown username/password combination.",
				'host' => "This database host does not exists."
			),

			'title' => "Database",
			'username' => "The user name used to connect to the database.",
			'name' => "The name of the database you want your data to be saved in.",
			'prefix' => "A prefix for the database tables. Useful to run multiple Icybee using the same database.",
			'description' => <<<EOT
This is the information required to establish a connection to the database. Contact your host
if are unsure about these parameters.
EOT
		),

		'site' => array
		(
			'success' => "Website settings saved",
			'title' => "Website",
			'description' => <<<EOT
This is the basic information required to create your website. You'll be able to modify these
settings later as well as provide others, such as its location, its status, the Google Analytics
tag and more. You'll also be able to create and manage other websites, in other languages for
instance.
EOT
		),

		'user' => array
		(
			'success' => "Account information saved",
			'error' => array
			(
				'password_match' => "Passwords don't match."
			),

			'title' => "Admin account",
			'description' => <<<EOT
This is the basic information required to create your admin account. You'll be able to modify these
settings later as well as provide others, such as your first name, last name, nickname, how your
name should be displayed, your language, timezone and more.
EOT
			,
			'username' => "You can login with either your username or your e-mail.",
			'email' => "Make sure to enter a valid e-mail address, it will be your only hope if you ever loose your password.",
			'password' => "The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! \" ? $ % ^ & ).",
			'password_confirm' => "Please confirm your password.",
			'language' => "With Icybee you don't need to speak Japanese to administer a website in Japanese. You can choose a different language from the website for the admin interface."
		),

		'install' => array
		(
			'title' => "Installation",
			'content' => <<<EOT
<h2>Ready to install</h2>

<p>Everything is ready to install Icybee.</p>

<p>:action</p>
EOT
		)
	),

	'requirement' => array
	(
		# lib/requirements/core-config.php

		'core_config' => array
		(
			'error' => array
			(
				'not_writable' => "Unable to write the <q>core</q> configuration: <code>!pathname</code>"
			),

			'title' => "The <q>core</q> configuration",
			'description' => <<<EOT
The <q>core</q> configuration file contains the parameters required to connect to the
database (among other things). The following lines have been created according to the prarameters
you supplied. Please copy them to the configuration file. :action

:data
EOT
		),

		# lib/requirements/pdo-drivers.php

		'pdo_drivers' => array
		(
			'error' => array
			(
				'missing' => "The %name driver is missing for PDO."
			),

			'title' => "PDO drivers",
			'description' => <<<EOT
Icybee uses two databases: one for your data, and another for some of its temporary or cached data.
The database where your data is stored uses the MySQL driver, while the other uses the SQLite
driver. Unless the configuration is modified, these drivers are required. :action
EOT
		),

		# lib/requirements/repository.php

		'repository' => array
		(
			'error' => array
			(
				'not_writable' => "The directory is not writable: <code>:dir</code>",
				'missing' => "The directory is missing: <code>:dir</code>"
			),

			'title' => "The <q>repository</q> directory",
			'description' => <<<EOT
The <q>repository</q> directory is used to store the files managed by Icybee, the thumbnails created
for your images, some caches and some parameters. In order for PHP to be able to modify the content
of the directory, its owner should be <code>www-data</code> and its permission should be set to
<code>755</code>. :action
EOT
		),

		# lib/requirements/user-config.php

		'user_config' => array
		(
			'error' => array
			(
				'create' => "The user configuration file is missing and could not be created: <code>:path</code>"
			),

			'title' => "The <code>user</code> configuration",
			'description' => <<<EOT
The <code>user</code> configuration contains parameters required to provide security
regarding password management. The following lines have been created just for you.
Please copy them to the configuration file. :action

<textarea class="span8" readonly="readonly">!data</textarea>
EOT
		)
	),

	'language.description' => "Additional languages can be used with language packs."
);