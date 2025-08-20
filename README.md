# Employee Management API

A RESTful API built with **Laravel 12** for managing employees, departments, addresses, and contacts.

---

## ✅ Features

- CRUD for **Departments**
- CRUD for **Employees**
- CRUD for **Addresses**
- CRUD for **Contacts**
- Search employees by:
  - Name, Email, Department, Contact Number
- Validation & Exception Handling
- Nested creation: Add **addresses & contacts** while creating an employee
- Postman Collection available for testing

---

## 💻 Setup Instructions

1. **Clone the repository**

    ```bash
    git clone https://github.com/UjjwalLaravel/employee-management.git
    cd employee-management
    ```

2. **Install dependencies**

    ```bash
    composer install
    ```

3. **Copy `.env` file**

    ```bash
    cp .env.example .env
    ```

4. **Configure database** in `.env`

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=employee-management
    DB_USERNAME=root
    DB_PASSWORD=secret
    ```
5. **Create a new database** ```employee-management```
5. **Run migrations**

    ```bash
    php artisan migrate
    ```

6. **Serve the application**

    ```bash
    php artisan serve
    ```

Base URL: `http://127.0.0.1:8000/api`

---

## 📦 API Endpoints

### Departments

| Method | Endpoint               | Description                  |
|--------|------------------------|------------------------------|
| GET    | `/departments`         | List all departments         |
| POST   | `/departments`         | Create a new department      |
| GET    | `/departments/{id}`    | Get a single department      |
| PUT    | `/departments/{id}`    | Update a department          |
| DELETE | `/departments/{id}`    | Delete a department          |

---

### Employees

| Method | Endpoint               | Description                                  |
|--------|------------------------|----------------------------------------------|
| GET    | `/employees`           | List all employees                            |
| POST   | `/employees`           | Create an employee with addresses & contacts |
| GET    | `/employees/{id}`      | Get a single employee                         |
| PUT    | `/employees/{id}`      | Update an employee                            |
| DELETE | `/employees/{id}`      | Delete an employee                            |
| GET    | `/employees/search`    | Search employees by name, email, department, or contact |

**Example Search Query:**

GET /api/employees/search?name=John&department=HR&phone=9876543210


---

### Addresses

Addresses are always tied to a specific employee.

| Method | Endpoint                                         | Description                        |
|--------|-------------------------------------------------|------------------------------------|
| GET    | `/employees/{employee_id}/addresses`           | List all addresses of an employee  |
| POST   | `/employees/{employee_id}/addresses`           | Add a new address for the employee |
| GET    | `/employees/{employee_id}/addresses/{id}`      | Get a single address of an employee|
| PUT    | `/employees/{employee_id}/addresses/{id}`      | Update an employee's address       |
| DELETE | `/employees/{employee_id}/addresses/{id}`      | Delete an employee's address       |

---

### Contacts

Contacts are always tied to a specific employee.

| Method | Endpoint                                         | Description                        |
|--------|-------------------------------------------------|------------------------------------|
| GET    | `/employees/{employee_id}/contacts`            | List all contacts of an employee   |
| POST   | `/employees/{employee_id}/contacts`            | Add a new contact for the employee |
| GET    | `/employees/{employee_id}/contacts/{id}`       | Get a single contact of an employee|
| PUT    | `/employees/{employee_id}/contacts/{id}`       | Update an employee's contact       |
| DELETE | `/employees/{employee_id}/contacts/{id}`       | Delete an employee's contact       |

---

## 📂 Postman Collection

Import the `Company Employee Management.postman_collection.json` to test all endpoints quickly.

---

## 🧪 Testing

Run unit tests:

```bash
php artisan test
