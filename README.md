# Inventory Management System (Laravel)

## Overview
The **Inventory Management System** is a web-based application built with **Laravel** to help businesses efficiently track and manage their stock. This system allows users to monitor inventory levels, manage suppliers, generate reports, and automate key inventory operations.

## Features
- **Real-time Inventory Tracking** – Keep track of stock movements and receive alerts for low stock levels.
- **Product Management** – Add, edit, and organize products and categories.
- **Multi-Warehouse Support** – Manage inventory across multiple locations.

## Tech Stack
- **Framework:** Laravel (PHP)
- **Frontend:** Blade, Bootstrap, Native CSS
- **Database:** MySQL
- **Authentication:** Ajax / Custom Auth ==> active in 2nd branch
- **Deployment:** Nginx / Apache (Cloud or On-Prem)

## Installation
1. Clone this repository:
   ```sh
   git clone -b main https://github.com/genta-bahana-nagari/sinvent24.git
   cd sinvent24
   ```
2. Install dependencies:
   ```sh
   composer install
   ```
3. Copy the `.env.example` file and set up your environment:
   ```sh
   cp .env.example .env
   ```
4. Generate the application key:
   ```sh
   php artisan key:generate
   ```
5. Configure the database in `.env` and run migrations:
   ```sh
   php artisan migrate
   ```
6. Start the application:
   ```sh
   php artisan serve
   ```

## Future Enhancements
- Advanced analytics with AI-powered insights.
- Mobile app integration.
- Multi-language support.

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contributing
Pull requests are welcome! For major changes, please open an issue first to discuss your ideas.

---
Feel free to contribute, report issues, or suggest improvements!


