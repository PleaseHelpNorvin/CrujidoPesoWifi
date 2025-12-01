2️⃣ What can go into logs
a) User events

Coin inserted

type = COIN

message = "User inserted 5 pesos, added 25 minutes"

Voucher redeemed

type = VOUCHER

message = "Voucher ABC123 redeemed by MAC AA:BB:CC:DD:EE:FF"

User expired/disconnected

type = EXPIRE

message = "User AA:BB:CC expired, blocked by iptables"

b) Admin events

Rate changed

type = ADMIN

message = "Rate_per_peso changed to 6 for device 1"

SSID/password changed

type = ADMIN

message = "SSID changed to PisoWiFiPro"

System reboot triggered

type = SYSTEM

message = "Hardware rebooted by admin"

c) System / Error events

Coin reader failure

type = ERROR

message = "Coin reader GPIO read failed"

Expire checker failed

type = ERROR

message = "expire_checker.php cron failed"

IP/MAC blocking/unblocking errors

type = ERROR

message = "Failed to remove iptables rule for MAC AA:BB:CC"

CrujidoPesoWifi/
│
├── public/
│   ├── index.php
│   └── assets/
│       ├── css/
│       │    └── style.css
│       ├── js/
│       │    └── main.js
│       └── images/
│
├── app/
│   ├── controllers/
│   │    ├── PortalController.php
│   │    ├── AdminController.php
│   │    ├── RatesController.php
│   │    ├── UserController.php
│   │    ├── VoucherController.php
│   │    └── ApiController.php
│   │
│   ├── models/
│   │    ├── User.php
│   │    ├── Rate.php
│   │    ├── Voucher.php
│   │    ├── Device.php
│   │    ├── DeviceSetting.php
│   │    └── Log.php
│   │
│   ├── views/
│   │    ├── portal/
│   │    │     ├── index.php
│   │    │     ├── buy.php
│   │    │     └── remaining.php
│   │    ├── admin/
│   │    │     ├── login.php
│   │    │     ├── dashboard.php
│   │    │     ├── logs.php
│   │    │     ├── settings.php
│   │    │     └── rates.php
│   │    ├── layouts/
│   │    │     ├── header.php
│   │    │     └── footer.php
│   │    └── components/
│   │          └── alert.php
│   │
│   ├── helpers/
│   │    └── functions.php
│   │
│   └── bootstrap.php
│
├── core/
│   ├── Router.php
│   ├── Controller.php
│   ├── Model.php
│   └── Response.php
│
├── routes/
│   ├── web.php
│   └── api.php
│
├── scripts/
│   ├── coin_reader.py
│   ├── expire_checker.php
│   ├── wifi_reset.sh
│   └── monitor.sh
│
├── database/
│   ├── wifi.db
│   └── migrate.php
│
├── config/
│   ├── config.php
│   └── database.php
│
└── README.md
