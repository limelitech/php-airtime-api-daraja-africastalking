# 💸 Airtime API with M-Pesa Daraja & Africa's Talking — PHP

This project is a secure and scalable PHP application that integrates:

- ✅ [Safaricom M-Pesa Daraja API](https://developer.safaricom.co.ke/) – for STK Push mobile payments
- ✅ [Africa's Talking Airtime API](https://developers.africastalking.com/docs/airtime/overview) – to send airtime
- ✅ ✅ MySQL database – for logging transactions

Built for Kenyan fintech use cases and mobile-based top-up services.

---

## 📂 Project Structure

```
php-airtime-api/
├── api/                 # Backend scripts (M-Pesa & Airtime)
│   ├── stk_initiate.php
│   ├── callback_url.php
│   ├── airtime.php
│   └── query.php
├── config/              # Environment & database config
│   └── config.php
├── logs/                # Logs for callback data
├── vendor/              # Africa's Talking SDK + dotenv
├── images/              # Airtime logos
├── index.php            # Frontend UI (Bootstrap)
├── .env.example         # Sample environment file
├── README.md
```

---

## 🔧 Setup Instructions

### 1. Clone the Repo

```bash
git clone https://github.com/yourusername/php-airtime-api.git
cd php-airtime-api
```

### 2. Install Dependencies

This project uses [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv) for environment variables.

```bash
composer require vlucas/phpdotenv
```

Also include Africa's Talking SDK under `vendor/`.

### 3. Create `.env` File

Duplicate the `.env.example` file and update your credentials:

```bash
cp .env.example .env
```

### 4. MySQL Setup

Create a MySQL database and run the following table schema:

```sql
-- Table to log Airtime requests
CREATE TABLE airtime (
    id INT AUTO_INCREMENT PRIMARY KEY,
    amount VARCHAR(20),
    currency VARCHAR(10),
    phone VARCHAR(20),
    payersID VARCHAR(20),
    status VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table to log M-Pesa STK push confirmations
CREATE TABLE mpesa_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_id VARCHAR(50),
    phone VARCHAR(20),
    amount DECIMAL(10,2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## 🚀 Features

- 🔐 Secure STK Push initiation via M-Pesa
- 📲 Automatic airtime dispatch via Africa’s Talking
- 🧾 Logs all transactions in MySQL
- 📤 Callback endpoint for M-Pesa confirmation
- ✅ Easy to deploy on CPanel, Apache, or Nginx

---

## 📸 UI Preview

![](images/safaricom.png)

Frontend built with Bootstrap, featuring:
- Tabs for Safaricom, Airtel, Telkom
- Amount + phone input form
- Simple submit action

---

## 🙋‍♂️ Author

**Kelvin Kathei Mutunga**  
📧 kelvinkatheim@gmail.com  
📞 +254 704 815 319  
🔗 [LinkedIn](https://linkedin.com/in/kelvin-kathei-mutunga-a74b552bb)

---

## 📄 License

MIT – free for personal or commercial use.
