<?php
class CookieConsent_Settings extends DataExtension
{
    private static $db = array(
        'CookiePosition' => "Enum('bannerbottom, bannertop, bannertoppushdown, floatingleft,floatingright', 'bannerbottom')",
        'CookieLayout' => "Enum('block, classic, edgeless, wire', 'block')",
        'CookieBannerColour' => "Varchar(6)",
        'CookieBannerTextColour' => "Varchar(6)",
        'CookieBannerButtonColour' => "Varchar(6)",
        'CookieBannerButtonTextColour' => "Varchar(6)",
        'CookieConsentIsActive' => 'Boolean',
        'CookiesAndYouIsActive'=> 'Boolean',
        'CookieComplianceType'  =>  "Enum('tell, optout, optin', 'tell')",
        'CookieMessage'  =>  'HTMLText',
        'CookieDismissButtonText'=>'Varchar(80)',
        'CookieAcceptButtonText'=>'Varchar(80)'
    );

    private static $has_one = array(
      'LinkToPrivacy' => 'SiteTree'
    );

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab("Root", new Tab('CookieConsent'));
        $fields->addFieldToTab('Root.CookieConsent', CheckboxField::create("CookieConsentIsActive")->setTitle(_t('CookieConsent.ISACTIVE', "Is Active")));
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

        $fields->addFieldToTab('Root.CookieConsent', $CookieBannerColourField = new TextField('CookieBannerColour', _t('CookieConsent.COOKIEBANNERCOLOUR', "HEX Banner colour")));
        $CookieBannerColourField
          ->setAttribute('placeholder', 'e.g. #efefef')
          ->setMaxLength(6);
        $fields->addFieldToTab('Root.CookieConsent', $CookieBannerTextColourField = new TextField('CookieBannerTextColour', _t('CookieConsent.COOKIEBANNERTEXTCOLOUR', "HEX Banner text colour")));
        $CookieBannerTextColourField
          ->setAttribute('placeholder', 'e.g. #404040')
          ->setMaxLength(6);
        $fields->addFieldToTab('Root.CookieConsent', $CookieBannerButtonColourField = new TextField('CookieBannerButtonColour', _t('CookieConsent.COOKIEBANNERBUTTONCOLOUR', "HEX Button colour")));
        $CookieBannerButtonColourField
          ->setAttribute('placeholder', 'e.g. #8ec760')
          ->setMaxLength(6);
        $fields->addFieldToTab('Root.CookieConsent', $CookieBannerButtonTextColourField = new TextField('CookieBannerButtonTextColour', _t('CookieConsent.COOKIEBANNERBUTTONTEXTCOLOUR', "HEX Button text colour")));
        $CookieBannerButtonTextColourField
          ->setAttribute('placeholder', 'e.g. #ffffff')
          ->setMaxLength(6);

        $fields->addFieldToTab('Root.CookieConsent', new LiteralField('LinkToPrivacyLiteral', '<p><strong>'._t('CookieConsent.LINKTOPRIVACYLITERAL', "Learn more link").'</strong></p>'));
        $fields->addFieldToTab('Root.CookieConsent', new TreeDropdownField("LinkToPrivacyID", _t('CookieConsent.LINKTOPRIVACY', "Link to your own policy"), "SiteTree"));
        $fields->addFieldToTab('Root.CookieConsent', new LiteralField('LinkToPrivacyLiteralOr', _t('CookieConsent.LINKTOPRIVACYLITERALOR', "Or")));
        $fields->addFieldToTab('Root.CookieConsent', new CheckboxField("CookiesAndYouIsActive", _t('CookieConsent.COOKIESANDYOUISACTIVE', "Link to cookiesandyou.com")));

        $fields->addFieldToTab('Root.CookieConsent', new LiteralField('CookieComplianceTypeLiteral', '<p><strong>'._t('CookieConsent.COOKIECOMPLIANCETYPELITERAL', "Compliance type - You must modify your site for advanced options to work!").'</strong></p>'));

        $CookieComplianceTypeValues = array(
          'tell' => _t('CookieConsent.COOKIECOMPLIANCETYPETELL', "Just tell users that we use cookies"),
          'optout' => _t('CookieConsent.COOKIECOMPLIANCETYPEOPTOUT', "Let users opt out of cookies (Advanced)"),
          'optin' => _t('CookieConsent.COOKIELAYOUTEDGELESS', "Ask users to opt into cookies (Advanced)")
        );
        $fields->addFieldToTab('Root.CookieConsent', DropdownField::create("CookieComplianceType")->setSource($CookieComplianceTypeValues)->setTitle(_t('CookieConsent.COOKIECOMPLIANCETYPE', "Compliance type")));

        $fields->addFieldToTab('Root.CookieConsent', new LiteralField('CookieMessageLITERAL', '<p><strong>'._t('CookieConsent.COOKIEMESSAGELITERAL', "Custom text").'</strong></p>'));
        $fields->addFieldToTab('Root.CookieConsent', $CookieMessageField = new TextareaField('CookieMessage', _t('CookieConsent.COOKIEMESSAGE', "Message")));
        $CookieMessageField->setAttribute('placeholder', _t('CookieConsent.COOKIEMESSAGEVALUE', "This website uses cookies to ensure you get the best experience on our website."));

        $fields->addFieldToTab('Root.CookieConsent', $CookieDismissButtonTextField = new TextareaField('CookieDismissButtonText', _t('CookieConsent.COOKIEDISMISSBUTTONTEXT', "Dismiss button text")));
        $CookieDismissButtonTextField->setAttribute('placeholder', _t('CookieConsent.COOKIEDISMISSBUTTONTEXTVALUE', "Got it!"));

        $fields->addFieldToTab('Root.CookieConsent', $CookieAcceptButtonTextField = new TextareaField('CookieAcceptButtonText', _t('CookieConsent.COOKIEACCEPTBUTTONTEXT', "Accept button text")));
        $CookieAcceptButtonTextField->setAttribute('placeholder', _t('CookieConsent.COOKIEACCEPTBUTTONTEXTVALUE', "Allow cookies"));
    }
}
