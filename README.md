# GeStock - Inventory Management System

GeStock is a modern inventory management system built with Vue.js frontend and Laravel backend. The application helps businesses manage their inventory, suppliers, customers, and sales efficiently.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Frontend Architecture](#frontend-architecture)
- [Backend Architecture](#backend-architecture)
- [API Documentation](#api-documentation)
- [Contributing](#contributing)
- [License](#license)

## Features

- User authentication and authorization
- Dashboard with real-time analytics
- Inventory management
- Supplier management
- Customer management
- Invoice generation
- Sales tracking
- User management
- Responsive design
- Real-time statistics and charts

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/GeStock.git
```

2. Frontend setup:
```bash
cd GeStock/vue-project
npm install
```

3. Backend setup:
```bash
cd ../backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

4. Start development servers:

Frontend:
```bash
npm run dev
```

Backend:
```bash
php artisan serve
```

## Usage

1. Access the application at `http://localhost:5173`
2. Login with your credentials
3. Navigate through the dashboard to manage inventory, customers, suppliers, and invoices

## Frontend Architecture

### Technologies Used
- Vue.js 3
- Vuex for state management
- Vue Router for navigation
- Tailwind CSS for styling
- Chart.js for analytics
- Axios for API communication

### Project Structure
```
src/
├── assets/
├── components/
│   ├── Dashboard/
│   ├── Form/
│   ├── Login/
│   ├── SignU/
│   └── utils/
├── router/
├── store/
├── views/
└── App.vue
```

## Backend Architecture

### Technologies Used
- Laravel
- MySQL
- JWT Authentication
- RESTful API

### Project Structure
```
app/
├── Http/
│   ├── Controllers/
│   └── Middleware/
├── Models/
├── Services/
└── Providers/
```

## API Documentation

### Authentication Endpoints

```
POST /api/register
- Register a new user
- Body: { name, email, password, password_confirmation }

POST /api/login
- Login user
- Body: { email, password }

POST /api/logout
- Logout user
- Headers: Authorization Bearer Token
```

### User Management Endpoints

```
GET /api/users
- Get all users
- Headers: Authorization Bearer Token

POST /api/user
- Create new user
- Headers: Authorization Bearer Token
- Body: { name, email, role, password }

PUT /api/user/{id}
- Update user
- Headers: Authorization Bearer Token
- Body: { name, email, role }

DELETE /api/user/{id}
- Delete user
- Headers: Authorization Bearer Token
```

### Customer Endpoints

```
GET /api/clients
- Get all clients
- Headers: Authorization Bearer Token

POST /api/client
- Create new client
- Headers: Authorization Bearer Token
- Body: { firstName, lastName, email, phone, address }

PUT /api/client/update/{id}
- Update client
- Headers: Authorization Bearer Token
- Body: { firstName, lastName, email, phone, address }

DELETE /api/client/{id}
- Delete client
- Headers: Authorization Bearer Token
```

### Supplier Endpoints

```
GET /api/fournissurs
- Get all suppliers
- Headers: Authorization Bearer Token

POST /api/fournissur
- Create new supplier
- Headers: Authorization Bearer Token
- Body: { name, email, phone, address }

PUT /api/fournissur/update/{id}
- Update supplier
- Headers: Authorization Bearer Token
- Body: { name, email, phone, address }

DELETE /api/fournissur/{id}
- Delete supplier
- Headers: Authorization Bearer Token
```

### Invoice Endpoints

```
GET /api/factures
- Get all invoices
- Headers: Authorization Bearer Token

POST /api/facture
- Create new invoice
- Headers: Authorization Bearer Token
- Body: { client_id, products, total_amount }

PUT /api/facture/update/{id}
- Update invoice
- Headers: Authorization Bearer Token
- Body: { client_id, products, total_amount }

DELETE /api/facture/{id}
- Delete invoice
- Headers: Authorization Bearer Token
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Requestt
