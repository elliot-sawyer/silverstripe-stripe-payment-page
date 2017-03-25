<form action="$Link('charge')" method="post">
  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="$PublishableKey"
            data-description="Access for a year"
<%--
            <% if $AcceptBitcoin %>
            data-bitcoin="true"
            data-label="Pay with Card or Bitcoin"
            <% end_if %>
--%>
            data-amount="5000"
            data-locale="auto"></script>
</form>