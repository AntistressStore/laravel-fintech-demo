Демонстрация стиля и структуры работы 

## Файловая структура 

```
/laravel-senior-demo
├── app/
│   ├── Contracts/
│   │   └── PaymentServiceInterface.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── SubscriptionController.php
│   │   ├── Resources/
│   │   │   └── SubscriptionResource.php
│   │   └── ...
│   ├── Jobs/
│   │   └── ProcessPaymentJob.php
│   ├── Models/
│   │   ├── Currency.php
│   │   ├── SettlementAccount.php
│   │   ├── SettlementJournal.php
│   │   ├── SettlementTransaction.php
│   │   └── Subscription.php
│   ├── Observers/
│   │   └── SubscriptionObserver.php
│   ├── Providers/
│   │   ├── AppServiceProvider.php 
│   │   └── PaymentServiceProvider.php
│   └── Services/
│       ├── FintechLedgerService.php
│       └── StripePaymentService.php
├── app/Console/Commands/
│   └── SubscriptionRenewalCheck.php
├── database/
│   ├── migrations/ 
│   ├── seeders/
│   │   ├── DatabaseSeeder.php 
│   │   └── CurrencySeeder.php
│   └── ...
├── resources/js/
│   ├── components/
│   │   └── SubscriptionStatus.vue
│   └── stores/
│       └── subscription.js
└── routes/
    └── api.php
```


