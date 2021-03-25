# paygenius-php
PayGenius PHP integration library

Create a PayGenius client:

$client = new Client("merchant_token", "merchant_secret", "https://developer.paygenius.co.za/pg/api");

### NB: API Version is now excluded from the endpoint.

Notes: Added CreateForexPaymentRequest for non-ZAR payments.
