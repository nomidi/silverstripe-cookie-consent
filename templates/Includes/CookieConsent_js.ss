<% with SiteConfig %>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "<% if $CookieBannerColour %>$CookieBannerColour<% else %>#efefef<% end_if %>",
      "text": "<% if $CookieBannerTextColour %>$CookieBannerTextColour<% else %>#404040<% end_if %>"
    },
    "button": {
      <% if $CookieLayout == 'classic' %>
      "background": "wire",
      "border": "<% if $CookieBannerButtonColour %>$CookieBannerButtonColour<% else %>#ffffff<% end_if %>",
      <% else %>
      "background": "<% if $CookieBannerButtonColour %>$CookieBannerButtonColour<% else %>#ffffff<% end_if %>",
      <% end_if %>
      "text": "<% if $CookieBannerButtonTextColour %>$CookieBannerButtonTextColour<% else %>#8ec760<% end_if %>"
    }
  }
  <% if $CookieLayout == 'classic' %>
  ,"theme": "classic"
  <% else_if $CookieLayout == 'edgeless' %>
  ,"theme": "edgeless"
  <% end_if %>
  <% if $CookiePosition == 'top' %>
  ,"position": "top"
  <% else_if $CookiePosition == 'bannertoppushdown' %>
  ,"position": "top"
  ,"static": true
  <% else_if $CookiePosition == 'floatingleft' %>
  ,"position": "bottom-left"
  <% else_if $CookiePosition == 'floatingright' %>
  ,"position": "bottom-right"
  <% end_if %>
  <% if $LinkToPrivacy || $CookieMessage || $CookieDismissButtonText %>
  ,"content": {
    <% if $CookieMessage %>"message": "$CookieMessage" <% end_if %>
    <% if $LinkToPrivacy %><% if $CookieMessage %>, <% end_if %>"href": "$LinkToPrivacy.AbsoluteLink" <% end_if %>
    <% if $CookieDismissButtonText %><% if $CookieMessage || $LinkToPrivacy %>, <% end_if %>"dismiss": "$CookieDismissButtonText" <% end_if %>
    <% if $CookieAcceptButtonText %><% if $CookieMessage || $LinkToPrivacy || $CookieDismissButtonText %>, <% end_if %>"link": "$CookieAcceptButtonText" <% end_if %>
  }
  <% else_if $CookiesAndYouIsActive == 0%>
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
