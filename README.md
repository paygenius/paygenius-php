# paygenius-php
PayGenius PHP integration library

Create a PayGenius client:

For development environment:
$client = new Client("merchant__dev_token", "merchant__dev_secret", "https://developer.paygenius.co.za/pg/api");

For production environment:
$client = new Client("merchant__live_token", "merchant__live_secredt", "https://www.paygenius.co.za/pg/api");


### NB: API Version is now excluded from the endpoint.

Release Notes - 2021-03-25: 
1. Added CreateForexPaymentRequest for non-ZAR payments.
2. Added ConsumerAddress to Consumer object. This is used when doing CreateForexPaymentRequest.
3. Removed API version from Client endpoint constructer parameter. Previously, this parameter was declared 'https://developer.paygenius.co.za/pg/api/v2'. New way -> 'https://developer.paygenius.co.za/pg/api' / 'https://www.paygenius.co.za/pg/api'
