# Odorik SMS Laravel Service

A simple Laravel service and facade for sending SMS via the Odorik API.

## Features

- Send SMS using Odorik API from any Laravel app
- Fetch allowed senders
- Use as a service or via a Laravel facade

## Installation

1. **Require the package via Composer**  
   (If using locally, see [Laravel docs: local packages](https://laravel.com/docs/packages#local-packages))
   ```sh
   composer require mdcznet/odorik-sms-laravel
   ```

2. **Publish the config file**
   ```sh
   php artisan vendor:publish --provider="Odorik\Sms\OdorikSmsServiceProvider"
   ```

3. **Add credentials to your `.env`**
   ```
   ODORIK_USER=your_odorik_user
   ODORIK_PASSWORD=your_odorik_password
   ODORIK_API_BASE_URL=https://www.odorik.cz/api/v1
   ```

## Usage

### Service (Dependency Injection)

```php
use Odorik\Sms\OdorikSmsService;

public function sendSms(OdorikSmsService $odorik)
{
    $response = $odorik->sendSms('00420724200800', 'Test message');
    // handle $response
}
```

### Facade

```php
use Odorik\Sms\Facades\OdorikSms;

public function sendViaFacade()
{
    $response = OdorikSms::sendSms('00420724200800', 'Test via facade!');
    // handle $response
}
```

### Fetch allowed senders

```php
$allowedSenders = OdorikSms::getAllowedSenders();
```

### Send SMS with allowed sender

#### Using the service

```php
use Odorik\Sms\OdorikSmsService;

public function sendSmsWithSender(OdorikSmsService $odorik)
{
    $allowedSenders = $odorik->getAllowedSenders();
    $sender = $allowedSenders[0]; // or any allowed sender
    $response = $odorik->sendSms('00420724200800', 'Test message', $sender);
    // handle $response
}
```

#### Using the facade

```php
use Odorik\Sms\Facades\OdorikSms;

public function sendSmsWithSenderFacade()
{
    $allowedSenders = OdorikSms::getAllowedSenders();
    $sender = $allowedSenders[0]; // or any allowed sender
    $response = OdorikSms::sendSms('00420724200800', 'Test message', $sender);
    // handle $response
}
```

## Testing

You can test the package by calling the service or facade from a controller or route.

## Documentation

- [Odorik SMS API documentation](https://www.odorik.cz/w/api:sms)

## License

MIT

---

**Author:**  
Martin Dittrich <https://MDCZ.net>