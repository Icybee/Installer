# Installer

This is the installer for the CMS [Icybee](http://icybee.org). It provides a nice interface to
checks the requirements for the CMS, setup the database, admin account and website, and create
the "core" config, which is required to run Icybee.

The interface is currently available in English and French. The language can be changed on the fly
at any step of the install process.





## Requirements

The package requires PHP 5.3 or later.  
An installation similar to [Icybee/Starter](https://github.com/Icybee/Starter/) must be deployed,
this includes the installation of Icybee.





## Installation

The recommended way to install this package is through [composer](http://getcomposer.org/).
Create a `composer.json` file and run `php composer.phar install` command to install it:

```json
{
    "minimum-stability": "dev",
    "require": {
		"icybee/installer": "*"
    }
}
```





### Cloning the repository

The package is [available on GitHub](https://github.com/Icybee/Installer), its repository can be
cloned with the following command line:

	$ git clone git://github.com/Icybee/Installer.git





## Documentation

You can generate the documentation for the package and its dependencies with the `make doc`
command. The documentation is generated in the `docs` directory. [ApiGen](http://apigen.org/) is
required. You can later clean the directory with the `make clean` command.





## License

Icybee/Installer is licensed under the New BSD License - See the LICENSE file for details.