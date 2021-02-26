


  {{-- This integration uses the PayPal JavaScript SDK to integrate
     the Smart Payment Buttons into your site without any server code. --}}
  <script
    src="https://www.paypal.com/sdk/js?client-id=AayatnoqUrndM4mmBd8KUSbKiolDZWfshkWG0oivCvFHBe_o59qyZ-WhJKWuezVKBm7qZ9Lt44XlNpBP"> // Required. Replace SB_CLIENT_ID with your sandbox client ID.
  </script>


  <div id="paypal-button-container"></div>

{{ $grandTotal }}
  {{ $factureId }}
<script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '{{ number_format($grandTotal,2) }}'
           }
        }]
      });
    },
    onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
          //console.warn(details);
          if(details.status=="COMPLETED"){
            top.location.href="{{ route('paiement-completed',['factureId'=>$factureId]) }}";
          }
        // This function shows a transaction success message to your buyer.
        //alert('Transaction completed by ' + details.payer.name.given_name);
      });
    }
  }).render('#paypal-button-container');
</script>
