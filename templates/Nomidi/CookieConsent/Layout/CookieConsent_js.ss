<% with SiteConfig %>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "cookie": {
    "expiryDays": <% if $CookieExpirationDate %>$CookieExpirationDate<% else %>365<% end_if %>
  },
  "palette": {
    "popup": {
      "background": "<% if $CookieBannerColour %>$CookieBannerColour<% else %>#efefef<% end_if %>",
      "text": "<% if $CookieBannerTextColour %>$CookieBannerTextColour<% else %>#404040<% end_if %>"
    },
    "button": {
      <% if $CookieLayout == 'classic' %>
      "background": "wire",
      "border": "<% if $CookieBannerButtonColour %>$CookieBannerButtonColour<% else %>#ffffff<% end_if %>",
      "text": "<% if $CookieBannerButtonTextColour %>$CookieBannerButtonTextColour<% else %>#8ec760<% end_if %>"
      <% else_if $CookieLayout == 'wire' %>
        "background": "transparent",
        "text": "<% if $CookieBannerButtonColour %>$CookieBannerButtonColour<% else %>#ffffff<% end_if %>",
        "border": "<% if $CookieBannerButtonColour %>#$CookieBannerButtonColour<% else %>#ffffff<% end_if %>"
      <% else %>
      "background": "<% if $CookieBannerButtonColour %>$CookieBannerButtonColour<% else %>#ffffff<% end_if %>",
      "text": "<% if $CookieBannerButtonTextColour %>$CookieBannerButtonTextColour<% else %>#8ec760<% end_if %>"
      <% end_if %>
    }
  }
  <% if $CookieLayout == 'classic' %>
  ,"theme": "classic"
  <% else_if $CookieLayout == 'edgeless' %>
  ,"theme": "edgeless"
  <% end_if %>
  <% if $CookiePosition == 'bannertop' %>
  ,"position": "top"
  <% else_if $CookiePosition == 'bannertoppushdown' %>
  ,"position": "top"
  ,"static": true
  <% else_if $CookiePosition == 'floatingleft' %>
  ,"position": "bottom-left"
  <% else_if $CookiePosition == 'floatingright' %>
  ,"position": "bottom-right"
  <% end_if %>
  ,"content": {
    "message": "<% if $CookieMessage %>$CookieMessage<% else %><%t CookieConsent.COOKIEMESSAGEVALUE 'This website uses cookies to ensure you get the best experience on our website.'%><% end_if %>"
    <% if $LinkToPrivacy %>,"href": "$LinkToPrivacy.AbsoluteLink" <% end_if %>
    ,"link": "<% if $CookieLearnMoreText%>$CookieLearnMoreText<% else %><%t CookieConsent.COOKIESLEARNMORETEXT 'Learn more' %><% end_if %>"
    ,"dismiss": "<% if $CookieDismissButtonText %>$CookieDismissButtonText<% else %><%t CookieConsent.COOKIEDISMISSBUTTONTEXTVALUE 'Got it!' %><% end_if %>"
    <% if $CookieComplianceType == 'optin' %>,"allow":"<% if $CookieAcceptButtonText %>$CookieAcceptButtonText<% else %><%t CookieConsent.COOKIEACCEPTBUTTONTEXTVALUE 'Allow cookies' %><% end_if %>"
    <% else_if $CookieComplianceType == 'optout' %>,"deny":"<% if $CookieDeclineButtonText %>$CookieDeclineButtonText<% else %><%t CookieConsent.COOKIEDECLINEBUTTONTEXTVALUE 'Decline' %><% end_if %>"
    <% end_if %>
  }
  <% if CookiesAndYouIsActive == 0 && $LinkToPrivacyID  == 0 %>
  ,"showLink": false
  <% end_if %>
  <% if $CookieComplianceType == 'optout' %>
  ,"type": "opt-out"
  <% else_if $CookieComplianceType == 'optin' %>
  ,"type": "opt-in"
  <% end_if %>
})});
</script>
<% end_with %>
