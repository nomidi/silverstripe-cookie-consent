<?php

namespace Nomidi\CookieConsent;

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataExtension;


class CookieConsentSettings extends DataExtension
{
    private static $db = array(
        'CookiePosition' => "Enum('bannerbottom, bannertop, bannertoppushdown, floatingleft,floatingright', 'bannerbottom')",
        'CookieLayout' => "Enum('block, classic, edgeless, wire', 'block')",
        'CookieBannerColour' => "Varchar(25)",
        'CookieBannerTextColour' => "Varchar(25)",
        'CookieBannerButtonColour' => "Varchar(25)",
        'CookieBannerButtonTextColour' => "Varchar(25)",
        'CookieLearnMoreText' => 'Varchar(50)',
        'CookieConsentIsActive' => 'Boolean',
        'CookiesAndYouIsActive'=> 'Boolean',
        'CookieComplianceType'  =>  "Enum('tell, optout, optin', 'tell')",
        'CookieMessage'  =>  'HTMLText',
        'CookieDismissButtonText'=>'Varchar(80)',
        'CookieAcceptButtonText'=>'Varchar(80)',
        'CookieDeclineButtonText'=>'Varchar(80)',
        'CookieConsentUseCDN' => 'Boolean',
        'CookieExpirationDate' => "Varchar(25)",
    );

    private static $has_one = array(
      'LinkToPrivacy' => 'SiteTree'
    );

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab("Root", new Tab('CookieConsent'));
        $fields->addFieldToTab('Root.CookieConsent', new LiteralField('CookieConsentLiteral', '<p><strong>'._t('CookieConsent.COOKIECONSENTLITERAL', "Find ore information about cookie consent on <a href='https://cookieconsent.insites.com' target='_blank' rel='noopener'>cookieconsent.insites.com</a>").'</strong></p>'));
        $fields->addFieldToTab('Root.CookieConsent', CheckboxField::create("CookieConsentIsActive")->setTitle(_t('CookieConsent.ISACTIVE', "Is Active")));
        $fields->addFieldToTab('Root.CookieConsent', CheckboxField::create('CookieConsentUseCDN', _t('CookieConsent.COOKIECONSENTUSECDN', "Use CDN?")));
        $CookiePositionValues = array(
          'bannerbottom' => _t('CookieConsent.COOKIEPOSITIONBANNERBOTTOM', "Banner bottom"),
          'bannertop'=> _t('CookieConsent.COOKIEPOSITIONBANNERTOP', "Banner top"),
          'bannertoppushdown'=>_t('CookieConsent.COOKIEPOSITIONBANNERTOPPUSHDOWN', "Banner top (pushdown)"),
          'floatingleft'=> _t('CookieConsent.COOKIEPOSITIONFLOATINGLEFT', "Floating left"),
          'floatingright'=> _t('CookieConsent.COOKIEPOSITIONFLOATINGRIGHT', "Floating right")
        );
        $fields->addFieldToTab('Root.CookieConsent', DropdownField::create("CookiePosition")->setSource($CookiePositionValues)->setTitle(_t('CookieConsent.POSITION', "Position")));
        $CookieLayoutValues = array(
          'block' => _t('CookieConsent.COOKIELAYOUTBLOCK', "Block"),
          'classic' => _t('CookieConsent.COOKIELAYOUTCLASSIC', "Classic"),
          'edgeless' => _t('CookieConsent.COOKIELAYOUTEDGELESS', "Edgless"),
          'wire'  =>  _t('CookieConsent.COOKIELAYOUTWIRE', "Wire")
        );
        $fields->addFieldToTab('Root.CookieConsent', DropdownField::create("CookieLayout")->setSource($CookieLayoutValues)->setTitle(_t('CookieConsent.COOKIELAYOUT', "Layout")));

        $fields->addFieldToTab('Root.CookieConsent', $CookieBannerColourField = new TextField('CookieBannerColour', _t('CookieConsent.COOKIEBANNERCOLOUR', "Banner colour HEX/RGB/RGBA")));
        $CookieBannerColourField
          ->setAttribute('placeholder', _t('CookieConsent.COOKIEBANNERCOLOURVALUE', "e.g. #efefef/rgb(239,239,239)/rgba(239,239,239,.8)"))
          ->setMaxLength(25);
        $fields->addFieldToTab('Root.CookieConsent', $CookieBannerTextColourField = new TextField('CookieBannerTextColour', _t('CookieConsent.COOKIEBANNERTEXTCOLOUR', "Banner text colour HEX/RGB/RGBA")));
        $CookieBannerTextColourField
          ->setAttribute('placeholder', _t('CookieConsent.COOKIEBANNERTEXTCOLOURVALUE', "e.g. #404040/rgb(64,64,64)/rgba(64,64,64,.8)"))
          ->setMaxLength(25);
        $fields->addFieldToTab('Root.CookieConsent', $CookieBannerButtonColourField = new TextField('CookieBannerButtonColour', _t('CookieConsent.COOKIEBANNERBUTTONCOLOUR', "Button colour HEX/RGB/RGBA")));
        $CookieBannerButtonColourField
          ->setAttribute('placeholder', _t('CookieConsent.COOKIEBANNERBUTTONCOLOURVALUE', "e.g. #8ec760/rgb(142,199,96)/rgba(142,199,96,.8)"))
          ->setMaxLength(25);
        $fields->addFieldToTab('Root.CookieConsent', $CookieBannerButtonTextColourField = new TextField('CookieBannerButtonTextColour', _t('CookieConsent.COOKIEBANNERBUTTONTEXTCOLOUR', "Button text colour HEX/RGB/RGBA")));
        $CookieBannerButtonTextColourField
          ->setAttribute('placeholder', _t('CookieConsent.COOKIEBANNERBUTTONTEXTCOLOURVALUE', "e.g. #ffffff/rgb(255,255,255)/rgba(255,255,255,.8)"))
          ->setMaxLength(25);

        $fields->addFieldToTab('Root.CookieConsent', new LiteralField('LinkToPrivacyLiteral', '<p><strong>'._t('CookieConsent.LINKTOPRIVACYLITERAL', "Learn more link").'</strong></p>'));
        $fields->addFieldToTab('Root.CookieConsent', new TreeDropdownField("LinkToPrivacyID", _t('CookieConsent.LINKTOPRIVACY', "Link to your own policy"), SiteTree::class));
        $fields->addFieldToTab('Root.CookieConsent', new LiteralField('LinkToPrivacyLiteralOr', _t('CookieConsent.LINKTOPRIVACYLITERALOR', "Or")));
        $fields->addFieldToTab('Root.CookieConsent', new CheckboxField("CookiesAndYouIsActive", _t('CookieConsent.COOKIESANDYOUISACTIVE', "Link to cookiesandyou.com")));
        $fields->addFieldToTab('Root.CookieConsent', $CookiesLearnMoreField = new TextField('CookieLearnMoreText', _t('CookieConsent.COOKIESLEARNMORETEXT', "Learn More")));

        $CookiesLearnMoreField->setAttribute('placeholder', _t('CookieConsent.COOKIESLEARNMORETEXT', "Learn More"));
        $fields->addFieldToTab('Root.CookieConsent', new LiteralField('CookieComplianceTypeLiteral', '<p><strong>'._t('CookieConsent.COOKIECOMPLIANCETYPELITERAL', "Compliance type - You must modify your site for advanced options to work!").'</strong></p>'));

        $CookieComplianceTypeValues = array(
          'tell' => _t('CookieConsent.COOKIECOMPLIANCETYPETELL', "Just tell users that we use cookies"),
          'optout' => _t('CookieConsent.COOKIECOMPLIANCETYPEOPTOUT', "Let users opt out of cookies (Advanced)"),
          'optin' => _t('CookieConsent.COOKIECOMPLIANCETYPEOPTIN', "Ask users to opt into cookies (Advanced)")
        );
        $fields->addFieldToTab('Root.CookieConsent', DropdownField::create("CookieComplianceType")->setSource($CookieComplianceTypeValues)->setTitle(_t('CookieConsent.COOKIECOMPLIANCETYPE', "Compliance type")));

        $fields->addFieldToTab('Root.CookieConsent', new LiteralField('CookieMessageLITERAL', '<p><strong>'._t('CookieConsent.COOKIEMESSAGELITERAL', "Custom text").'</strong></p>'));
        $fields->addFieldToTab('Root.CookieConsent', $CookieMessageField = new TextareaField('CookieMessage', _t('CookieConsent.COOKIEMESSAGE', "Message")));
        $CookieMessageField->setAttribute('placeholder', _t('CookieConsent.COOKIEMESSAGEVALUE', "This website uses cookies to ensure you get the best experience on our website."));

        $fields->addFieldToTab('Root.CookieConsent', $CookieDismissButtonTextField = new TextField('CookieDismissButtonText', _t('CookieConsent.COOKIEDISMISSBUTTONTEXT', "Dismiss button text")));
        $CookieDismissButtonTextField->setAttribute('placeholder', _t('CookieConsent.COOKIEDISMISSBUTTONTEXTVALUE', "Got it!"));

        $fields->addFieldToTab('Root.CookieConsent', $CookieAcceptButtonTextField = new TextField('CookieAcceptButtonText', _t('CookieConsent.COOKIEACCEPTBUTTONTEXT', "Accept button text")));
        $CookieAcceptButtonTextField->setAttribute('placeholder', _t('CookieConsent.COOKIEACCEPTBUTTONTEXTVALUE', "Allow cookies"));

        $fields->addFieldToTab('Root.CookieConsent', $CookieDeclineButtonTextField = new TextField('CookieDeclineButtonText', _t('CookieConsent.COOKIEDECLINEBUTTONTEXT', "Decline button text")));
        $CookieDeclineButtonTextField->setAttribute('placeholder', _t('CookieConsent.COOKIEDECLINEBUTTONTEXTVALUE', "Decline"));

        $fields->addFieldToTab('Root.CookieConsent', $CookieExpirationDateField = new TextField('CookieExpirationDate', _t('CookieConsent.COOKIEEXPIRATIONDATETEXT', 'Expiration Date of Cookie')));
        $CookieExpirationDateField->setAttribute('placeholder', _t('CookieConsent.COOKIEEXPIRATIONDATEVALUE', "365"));
    }
}
