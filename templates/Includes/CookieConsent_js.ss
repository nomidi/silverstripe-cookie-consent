<% with SiteConfig %>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#$CookieBannerColour",
      "text": "#$CookieBannerTextColour"
    },
    "button": {
      <% if $CookieLayout == 'classic' %>
      "background": "wire",
      "border": "#$CookieBannerButtonColour",
      <% else %>
      "background": "#$CookieBannerButtonColour",
      <% end_if %>
      "text": "#$CookieBannerButtonTextColour"
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
  <% if $LinkToPrivacy %>
  ,"content": {
    "href": "$LinkToPrivacy.AbsoluteLink"
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
