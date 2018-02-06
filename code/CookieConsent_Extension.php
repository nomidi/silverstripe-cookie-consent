<?php

class CookieConsent_Extension extends Extension
{
    public function onBeforeInit()
    {
        $siteConfig = SiteConfig::current_site_config();
        if ($siteConfig->CookieConsentIsActive) {
            if ($siteConfig->CookieConsentUseCDN) {
                // catch file from CDN
                Requirements::javascript('//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js');
                Requirements::css('//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css');
            } else {
                // Catch files from template and parse inline!
                //Requirements::insertHeadTags($siteConfig->customise(array('SiteConfig'=>$siteConfig))->renderWith('CookieConsent_min_js'));
                Requirements::insertHeadTags($siteConfig->customise(array('SiteConfig'=>$siteConfig))->renderWith('CookieConsent_min_css'));
                Requirements::javascript(COOKIE_CONSENT_PATH.'/thirdparty/cookieconsent/build/cookieconsent.min.js');
            }
            Requirements::insertHeadTags($siteConfig->customise(array('SiteConfig'=>$siteConfig))->renderWith('CookieConsent_js'));
        }
    }
}
