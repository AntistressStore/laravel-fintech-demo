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
## 🔍 **Общая архитектура: Clean Architecture / Domain-Driven Design (в упрощённой форме)**

Проект явно следует принципам **SOLID**, **инверсии зависимостей** и **модульности**. А именно:

- **Разделение ответственности**: интерфейсы, реализации, события, очереди — всё строго по слоям.
- **Инверсия зависимостей через контракты** → `PaymentServiceInterface.php`
- **Централизованная бизнес-логика** → `Services/`, а не в контроллерах
- **Работа с деньгами через двойную запись** → `Settlement*` модели → продумано и безопасно


