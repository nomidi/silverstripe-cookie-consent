# silverstripe-cookie-consent

Silverstripe Cookie Consent is a module which enables to configure
the [cookie consent JavaScript plugin](https://cookieconsent.insites.com/) from [Insites](https://insites.com/)
simply via the Administrator Backend.

![](docs/images/cookieconsent_overview.png)

## Requirements

- Silverstripe CMS ~3.2

## Installation

```sh
composer require nomidi/silverstripe-cookie-consent
```
Alternatively simply download the zip file from github.
After installation run a run `dev/build?flush=1` on your project.

## Configuration

The Configuration is done via the `Settings` and the `Cookie Consent` tab.
Please keep in mind that if you are using the advanced options you will have to ensure that the Cookies and there functionality
act accordingly. With this module you are just setting the configuration for CookieConsent but it will not change the cookie behaviour.

### Is Active

Defines if the Module is in avtive state or notice.

### Use CDN?

If ticked the plugin will load the css/js from a CDN (cloudflare).

### Position // Layout // Settings

A demonstration on the effect of these parameters can be found on the download page at (https://cookieconsent.insites.com/download/).

### Colours

For the colours it is possible to use HEX Values with leading # or RGBA Values (like rgba(64,64,64,.8) to include some transparency).

### Compliance Type - Advanced

Please be aware that you can configure the advanced versions via the Site Configuration. But this will have no effect to your website. If you are planning to use the opt-in or opt-out version of this module you will have to ensure on your own that the website works accordingly.

## Translations

The plugin will be delivered with an english and german language file. If you create additional language files please feel free to share them with us. We will be happy to include them in the repository.

## Todo

- If CookieConsent runs locally, add the js internally - leads right now to issues with e.replace
- Add more tests
