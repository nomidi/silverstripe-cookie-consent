# silverstripe-cookie-consent

Silverstripe Cookie Consent is a module which enables to configure
the [cookie consent JavaScript plugin](https://cookieconsent.insites.com/) from [Insites](https://insites.com/)
simply via the Administrator Backend.

The Configuration is done via the `Settings`and the `Cookie Consent` tab.



## Updating Cookie Consent Locally

This part is just interesting if you want to use the Inline version of Cookie Consent.
It is possible to update the Cookie Consent plugin which does the JavaScript work in the background.
As long as the API of this does not change this should have no disadvantages. If the API
changes it might be necessary to also update the PHP code.
In order for this module to pick up the updated and minified .js and .css file simply run the Task
`Cookie Consent Task` under `dev/tasks` once. It will read the .js and .css files and create new Silverstripe Template files from this.
