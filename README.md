## Welcome to kelompok_semester_1 branch

## Overview
This **branch** is included with Ajax-authentication. You can combine the features.

## Features
- **Real-time Inventory Tracking** – Keep track of stock movements and receive alerts for low stock levels.
- **Role-Based Access Control (RBAC)** – Secure authentication for different user roles (Admin, Manager, Staff).
- **Product & Supplier Management** – Add, edit, and organize products, categories, and supplier details.
- **Dynamic Reporting & Analytics** – Generate insightful reports on stock levels, sales trends, and purchase history.
- **Barcode & QR Code Integration** – Scan and update stock using barcode/QR scanning technology.
- **Multi-Warehouse Support** – Manage inventory across multiple locations.
- **RESTful API Support** – Easily integrate with third-party applications.

## Tech Stack
- **Framework:** Laravel (PHP)
- **Frontend:** Blade, Bootstrap, Native CSS
- **Database:** MySQL
- **Authentication:** Ajax / Custom Auth ==> active in 2nd branch
- **Deployment:** Nginx / Apache (Cloud or On-Prem)

## Installation
1. Clone this repository:
   ```sh
   git clone -b kelompok_semester_1 https://github.com/genta-bahana-nagari/sinvent24.git
   cd inventory-system
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
