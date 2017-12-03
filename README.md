# ConfigBox is manager of configurations for your eco system of applications   

ConfigBox is intended to be a standalone application used to create/update and provide secure access 
to configuration data.
Many applications use config files. Having to redeploy your application just for the change 
of a parameter is not ideal. Moreover, the operation requires a developer who has access to the code and 
can rebuild and deploy the application.
ConfigBox allows administrators to create/edit/delete configurations and provide a secure API end point 
for the others application of your system to read their configuration parameters.
This application has been built with Slim Framework, doctrine and uses Twig for the rendering.
It also uses the Monolog logger.

## Install the Application

Create the Database:
Run this command from the directory in which you have checkout the application.

    php vendor/doctrine/orm/bin/doctrine.php orm:schema-tool:create

Configure the webserver:

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writeable.

To run the application in development, you can also run this command. 

	php composer.phar install

Run this command to run the test suite

	php composer.phar test

That's it! Now you can create configs.
