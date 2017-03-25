This is a Stripe payment page

<% if $StripeAPIKey %>
<form action="$Link('accept')" method="POST">
  <script
    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="pk_test_$StripeAPIKey"
    data-amount="999"
    data-name="Stripe.com"
    data-description="Widget"
    data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
    data-locale="auto"
    <% if $AcceptBitcoin %>
    data-bitcoin="true"
    data-label="Pay with Card or Bitcoin"
    <% else %>
    data-label="Pay with Card"
    <% end_if %>
    data-zip-code="true">
  </script>
</form>
<% end_if %>