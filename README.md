# 🏨 Hotel Booking System - PHP Native & MySQL

A complete hotel booking system built using **PHP (Native)** and **MySQL**, with both frontend for users and backend for administrators.  
The system supports room listings, bookings, and PayPal integration for payments.

---

## 🚀 Features

- User authentication (login/register)
- Admin dashboard with full CRUD
- Manage hotels and rooms
- Make room bookings
- Payment integration via PayPal (Sandbox)
- Session handling and data validation
- Responsive frontend pages

---

## 📁 Project Structure

hotel-booking/
│
├── index.php # Homepage (lists hotels or rooms)
├── room-single.php # Room detail page
├── bookingRoom.php # Booking form handler
│
├── admin/ # Admin Panel
│ ├── login.php
│ ├── dashboard.php
│ ├── hotels/ # Manage hotels
│ ├── rooms/ # Manage rooms
│ ├── bookings/ # Manage bookings
│ └── includes/ # Shared admin files (header, auth check, etc.)
│
├── assets/ # CSS, JS, images
│
└── database/
└── config.php # DB connection

## 🧰 Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache recommended)
- Composer (optional if using libraries)

---

## 🛠️ Installation

1. Clone or download the project to your web server directory (e.g., `htdocs` if using XAMPP).
2. Create a new MySQL database (e.g., `hotel_booking`).
3. Import the SQL file located in `/database/hotel_booking.sql` into your database.
4. Update the DB credentials in `database/config.php`.
5. Open your browser and visit:  
   `http://localhost/hotel-booking/`

---

## 💳 PayPal Integration

- Payments are integrated using **PayPal Sandbox**.
- You need a **PayPal Developer Account** to create test business & buyer accounts.
- Insert your **Client ID** in the payment section (e.g., `pay.php` or wherever implemented).

> Note: This is a simplified implementation. For production, always ensure secure handling of payment responses.

---



## 📌 Admin Modules

- **Hotels**: Create, edit, delete hotel entries.
- **Rooms**: Assign rooms to hotels, update availability & prices.
- **Bookings**: View user bookings and statuses.
- **Authentication**: Secure login for admins.



## 📬 Contact

For suggestions, issues, or contributions:  
📧 mohamedabodo2002815@gmail.com

---

## 📝 License

This project is for educational/demo purposes. Feel free to use and modify it as needed.
