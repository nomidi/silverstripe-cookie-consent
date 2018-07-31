<?php

namespace Nomidi\CookieConsent;



use SilverStripe\Dev\BuildTask;

/**
 * Task for creating the Template Files if a newer Version of CookieConsent gets integrated
 */
class CookieConsentTask extends BuildTask
{
    protected $title = "Cookie Consent Task";
    protected $description = "Creates from the .css and .js files Silverstripe Template files";
    protected $original_folder = "/thirdparty/silverstripe-cookie-consent/build/";
    protected $destination_folder ="/templates/Includes/";
    protected $original_js_name = "silverstripe-cookie-consent.min.js";
    protected $original_css_name = "silverstripe-cookie-consent.min.css";
    protected $destination_js_name = "CookieConsent_min_js.ss";
    protected $destination_css_name = "CookieConsent_min_css.ss";

    public function run($request)
    {
        // get the JS file
        $jsfile = file_get_contents('../'.COOKIE_CONSENT_PATH.$this->original_folder.$this->original_js_name);
        if (!$jsfile) {
            echo "JS file could not be read. Please check the file structure";
        }
        // write content into template
        $jshandle = fopen('../'.COOKIE_CONSENT_PATH.$this->destination_folder.$this->destination_js_name, "w");
        // add script at beginning and end
        $jsfile = "<script>".$jsfile."</script>";
        $jsreturn = fwrite($jshandle, $jsfile);
      //  fclose($jshandle);
        // get the css file
        $cssfile = file_get_contents('../'.COOKIE_CONSENT_PATH.$this->original_folder.$this->original_css_name);
        if (!$cssfile) {
            echo "CSS file could not be read. Please check the file structure.";
        }
        // write content into template
        $csshandle = fopen('../'.COOKIE_CONSENT_PATH.$this->destination_folder.$this->destination_css_name, "w");
        // add style at the beginning and end
        $cssfile = "<style>.cc-message{padding-right:20px}".$cssfile."</style>";
        $cssreturn = fwrite($csshandle, $cssfile);
        //fclose($csshandle);
        if ($cssreturn > 0 && $jsreturn > 0 && fclose($csshandle) && fclose($jshandle)) {
            echo "Files were written sucessfully.";
        } else {
            echo "There was an issue writing the Files.";
        }
    }
}
