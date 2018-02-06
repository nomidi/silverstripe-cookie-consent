<?php
class CookieConsentTest extends FunctionalTest
{
    protected static $fixture_file = array(
    'CookieConsentTest.yml'
  );

    public static $use_draft_site = true;
    
    private $js_string = 'cookieconsent.min.js';
    private $cdn_css_string = 'cookieconsent.min.css';
    private $cc_call = 'window.cookieconsent.initialise({';


    /*
      Function to test the active state of the plugin. Can not check if the message
      is shown as this test does not support Javascript
     */
    public function testActiveStateAndCDN()
    {
        // First Test for check for CDN JS file, CDN CSS file and cookieconsent js content.
        $site = SiteConfig::current_site_config();
        $site->setField('CookieConsentIsActive', 1);
        $site->setField('CookieConsentUseCDN', 1);
        $site->write();

        $response = $this->get($this->objFromFixture('Page', 'home')->Link());
        $body = $response->getBody();

        // check for min.js
        $check = strpos($body, $this->js_string);
        $this->assertTrue(is_numeric($check), "Could not find the cookieconsent.min.js wihtin the response.");

        // check for min.css
        $check = strpos($body, $this->cdn_css_string);
        $this->assertTrue(is_numeric($check), "Could not find the cookieconsent.min.css within the response.");

        $check = strpos($body, $this->cc_call);
        $this->assertTrue(is_numeric($check), "Could not find the JavaScript call for cookieconsent within the response.");


        // Check for js file css and cookieconsent js content.
        $site->setField('CookieConsentUseCDN', 0);
        $site->write();
        $response = $this->get($this->objFromFixture('Page', 'home')->Link());
        $body = $response->getBody();

        // check for min.js
        $check = strpos($body, $this->js_string);
        $this->assertTrue(is_numeric($check), "Could not find the cookieconsent.min.js wihtin the response.");

        $check = strpos($body, $this->cc_call);
        $this->assertTrue(is_numeric($check), "Could not find the JavaScript call for cookieconsent within the response.");

        // Check that nothing is in the response if moudle is not active!
        $site->setField('CookieConsentIsActive', 0);
        $site->write();

        $response = $this->get($this->objFromFixture('Page', 'home')->Link());
        $body = $response->getBody();

        $check = strpos($body, $this->js_string);
        $this->assertFalse(is_numeric($check), "Could find cookieconsent.min.js but module is not active!");

        // check for min.css
        $check = strpos($body, $this->cdn_css_string);
        $this->assertFalse(is_numeric($check), "Could find cookieconsent.min.css but module is not active!");

        $check = strpos($body, $this->cc_call);
        $this->assertFalse(is_numeric($check), "Could find the JavaScript call for cookieconsent but module is not active.");
    }
}
