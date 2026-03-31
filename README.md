🚀 Project này được xây dựng bằng Laravel Framework, áp dụng mô hình MVC (Model - View - Controller) để thực hiện các bài tập:
Quản lý sinh viên
Quản lý sản phẩm
Đăng ký môn học
(Có thể mở rộng: Order, Booking)

🛠 Công nghệ sử dụng:
Laravel Framework
PHP
MySQL
Blade Template
Bootstrap 5

📂 Cấu trúc project:
app/
 ├── Models/
 ├── Http/Controllers/
database/
 └── migrations/
resources/
 └── views/
routes/
 └── web.php
 
 ⚙️ Cài đặt và chạy project
1. Clone project
git clone <link-github>
cd project
2. Cài đặt thư viện
composer install
3. Cấu hình database

Mở file .env:

DB_DATABASE=ten_database
DB_USERNAME=root
DB_PASSWORD=
4. Chạy migration
php artisan migrate
5. Chạy server
php artisan serve

👉 Truy cập:

http://127.0.0.1:8000
