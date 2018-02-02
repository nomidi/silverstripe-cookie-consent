<?php

class CookieConsent_Extension extends Extension
{
    public function onBeforeInit()
    {
        $siteConfig = SiteConfig::current_site_config();
        if ($siteConfig->CookieConsentIsActive) {
            debug::show('ist aktiv');
            Requirements::javascript('//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js');
            debug::show(COOKIE_CONSENT_PATH);
            Requirements::css('//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css');
        } else {
            debug::show('ist nicht aktiv');
        }
    }
}
