# 📝 MiniBlog

MiniBlog is a simple blog system developed with PHP and MySQL.  
It includes an admin panel for managing posts, categories, and comments.  
Visitors can read blog posts and submit comments.

---

## 🚀 Features

- Admin login and secure panel  
- Create, update, and delete posts  
- Image upload support  
- Dynamic category management  
- Comment system (with approval)  
- View counter for posts  
- Responsive design (Bootstrap 5)  
- Separate admin and visitor interfaces

---

## ⚙️ Installation

### 1. Clone the Project

```bash
git clone https://github.com/eraykarakasli/miniblog.git


## 2. Set Up the Database

1. Start XAMPP or WAMP and open phpMyAdmin.  
2. Create a new database named: `miniblog`  
3. Import the `database.sql` file from this repository via the **Import** tab.  


### 3. Database Connection Configuration

Open the file `admin/includes/config.php` and make sure the following settings are correct:

```php
$baglanti = new mysqli("localhost", "root", "", "miniblog");


## 4. Admin Login

Username: `admin`  
Password: `123456` (or your own password – see: `admin/admin_ekle.php`)

To access the admin panel, visit:  
http://localhost/miniblog/admin/login.php


## 📁 Project Structure

miniblog/
│
├── admin/
│   ├── dashboard.php
│   ├── new_post.php
│   ├── edit_post.php
│   ├── kategoriler.php
│   ├── delete_post.php
│   ├── admin_ekle.php
│   ├── login.php
│   ├── logout.php
│   ├── yorumlar.php
│   │
│   └── includes/
│       ├── config.php
│       ├── header.php
│       ├── footer.php
│       └── admin_kontrol.php
│
├── includes/
│       ├── visitor_footer.php
│       └── visitor_header.php
│
├── uploads/           → Folder for uploaded images  
├── index.php          → Public homepage  
├── post.php           → Blog post detail page  
├── README.md          → This documentation file  
└── database.sql       → Database backup file  


![Admin Dashboard](https://github.com/eraykarakasli/miniblog/blob/main/screenshots/image1.png?raw=true)
![Category Management](https://github.com/eraykarakasli/miniblog/blob/main/screenshots/image2.png?raw=true)
![Add New Post](https://github.com/eraykarakasli/miniblog/blob/main/screenshots/image3.png?raw=true)
![Comment Approval](https://github.com/eraykarakasli/miniblog/blob/main/screenshots/image4.png?raw=true)
![Homepage](https://github.com/eraykarakasli/miniblog/blob/main/screenshots/image5.png?raw=true)
![Post Detail](https://github.com/eraykarakasli/miniblog/blob/main/screenshots/image6.png?raw=true)
![Add Comment](https://github.com/eraykarakasli/miniblog/blob/main/screenshots/image7.png?raw=true)
