# FILM STUDIO PROCUREMENT APPROVAL AND INVENTORY MANAGEMENT SYSTEM

# ENTITY RELATIONSHIP DESIGN (ERD)

## Version 1.0

---

# 1. PURPOSE

This document describes the database structure of the Film Studio Procurement Approval and Inventory Management System.

The ERD defines:

* Entities
* Attributes
* Primary Keys
* Foreign Keys
* Relationships
* Business Rules

---

# 2. DATABASE OVERVIEW

The system database contains twelve core entities:

1. users
2. categories
3. suppliers
4. inventory_items
5. procurement_requests
6. procurement_request_items
7. approval_workflows
8. purchase_orders
9. purchase_order_items
10. inventory_transactions
11. notifications
12. activity_logs

---

# 3. ENTITY DEFINITIONS

---

## 3.1 USERS

### Description

Stores system users and authentication information.

### Primary Key

id

### Attributes

| Field         | Type         |
| ------------- | ------------ |
| id            | INT          |
| username      | VARCHAR(50)  |
| email         | VARCHAR(100) |
| password_hash | VARCHAR(255) |
| full_name     | VARCHAR(100) |
| role          | ENUM         |
| department    | VARCHAR(50)  |
| phone         | VARCHAR(20)  |
| avatar        | VARCHAR(255) |
| is_active     | BOOLEAN      |
| created_at    | TIMESTAMP    |
| updated_at    | TIMESTAMP    |
| last_login    | TIMESTAMP    |

---

## 3.2 CATEGORIES

### Description

Stores inventory categories.

### Primary Key

id

### Foreign Key

parent_id → categories.id

### Attributes

| Field       | Type         |
| ----------- | ------------ |
| id          | INT          |
| name        | VARCHAR(100) |
| description | TEXT         |
| parent_id   | INT          |
| created_at  | TIMESTAMP    |

---

## 3.3 SUPPLIERS

### Description

Stores supplier information.

### Primary Key

id

### Attributes

| Field          | Type         |
| -------------- | ------------ |
| id             | INT          |
| company_name   | VARCHAR(150) |
| contact_person | VARCHAR(100) |
| email          | VARCHAR(100) |
| phone          | VARCHAR(20)  |
| address        | TEXT         |
| website        | VARCHAR(100) |
| tax_id         | VARCHAR(50)  |
| payment_terms  | VARCHAR(100) |
| rating         | DECIMAL(3,1) |
| is_active      | BOOLEAN      |
| created_at     | TIMESTAMP    |
| updated_at     | TIMESTAMP    |

---

## 3.4 INVENTORY_ITEMS

### Description

Stores inventory assets and stock information.

### Primary Key

id

### Foreign Keys

category_id → categories.id

supplier_id → suppliers.id

### Attributes

| Field             | Type          |
| ----------------- | ------------- |
| id                | INT           |
| item_code         | VARCHAR(50)   |
| name              | VARCHAR(200)  |
| description       | TEXT          |
| category_id       | INT           |
| supplier_id       | INT           |
| unit_of_measure   | VARCHAR(20)   |
| unit_price        | DECIMAL(12,2) |
| quantity_in_stock | INT           |
| reorder_level     | INT           |
| reorder_quantity  | INT           |
| location          | VARCHAR(100)  |
| status            | ENUM          |
| created_at        | TIMESTAMP     |
| updated_at        | TIMESTAMP     |

---

## 3.5 PROCUREMENT_REQUESTS

### Description

Stores procurement requests.

### Primary Key

id

### Foreign Key

requester_id → users.id

### Attributes

| Field                 | Type          |
| --------------------- | ------------- |
| id                    | INT           |
| request_number        | VARCHAR(20)   |
| requester_id          | INT           |
| historical_department | VARCHAR(50)   |
| title                 | VARCHAR(200)  |
| description           | TEXT          |
| justification         | TEXT          |
| estimated_total       | DECIMAL(12,2) |
| priority              | ENUM          |
| status                | ENUM          |
| required_date         | DATE          |
| created_at            | TIMESTAMP     |
| updated_at            | TIMESTAMP     |
| submitted_at          | TIMESTAMP     |

---

## 3.6 PROCUREMENT_REQUEST_ITEMS

### Description

Stores procurement request line items.

### Primary Key

id

### Foreign Keys

request_id → procurement_requests.id

inventory_item_id → inventory_items.id

### Attributes

| Field                 | Type          |
| --------------------- | ------------- |
| id                    | INT           |
| request_id            | INT           |
| item_name             | VARCHAR(200)  |
| description           | TEXT          |
| quantity              | INT           |
| unit_of_measure       | VARCHAR(20)   |
| estimated_unit_price  | DECIMAL(12,2) |
| estimated_total_price | DECIMAL(12,2) |
| inventory_item_id     | INT           |

---

## 3.7 APPROVAL_WORKFLOWS

### Description

Stores approval actions.

### Primary Key

id

### Foreign Keys

request_id → procurement_requests.id

approver_id → users.id

### Attributes

| Field          | Type      |
| -------------- | --------- |
| id             | INT       |
| request_id     | INT       |
| approver_id    | INT       |
| approval_level | INT       |
| status         | ENUM      |
| comments       | TEXT      |
| decided_at     | TIMESTAMP |
| created_at     | TIMESTAMP |

---

## 3.8 PURCHASE_ORDERS

### Description

Stores purchase orders.

### Primary Key

id

### Foreign Keys

request_id → procurement_requests.id

supplier_id → suppliers.id

created_by → users.id

### Attributes

| Field                  | Type          |
| ---------------------- | ------------- |
| id                     | INT           |
| po_number              | VARCHAR(20)   |
| request_id             | INT           |
| supplier_id            | INT           |
| created_by             | INT           |
| order_date             | DATE          |
| expected_delivery_date | DATE          |
| actual_delivery_date   | DATE          |
| subtotal               | DECIMAL(12,2) |
| tax_amount             | DECIMAL(12,2) |
| total_amount           | DECIMAL(12,2) |
| status                 | ENUM          |
| notes                  | TEXT          |
| created_at             | TIMESTAMP     |
| updated_at             | TIMESTAMP     |

---

## 3.9 PURCHASE_ORDER_ITEMS

### Description

Stores purchase order line items.

### Primary Key

id

### Foreign Keys

po_id → purchase_orders.id

request_item_id → procurement_request_items.id

inventory_item_id → inventory_items.id

---

## 3.10 INVENTORY_TRANSACTIONS

### Description

Stores stock movement history.

### Primary Key

id

### Foreign Keys

inventory_item_id → inventory_items.id

performed_by → users.id

---

## 3.11 NOTIFICATIONS

### Description

Stores user notifications.

### Primary Key

id

### Foreign Key

user_id → users.id

---

## 3.12 ACTIVITY_LOGS

### Description

Stores audit trail records.

### Primary Key

id

### Foreign Key

user_id → users.id

---

# 4. RELATIONSHIPS

## Users Relationships

users (1) ---- (M) procurement_requests

users (1) ---- (M) approval_workflows

users (1) ---- (M) purchase_orders

users (1) ---- (M) inventory_transactions

users (1) ---- (M) notifications

users (1) ---- (M) activity_logs

---

## Category Relationships

categories (1) ---- (M) inventory_items

categories (1) ---- (M) categories

---

## Supplier Relationships

suppliers (1) ---- (M) inventory_items

suppliers (1) ---- (M) purchase_orders

---

## Procurement Relationships

procurement_requests (1) ---- (M) procurement_request_items

procurement_requests (1) ---- (M) approval_workflows

procurement_requests (1) ---- (M) purchase_orders

---

## Purchase Order Relationships

purchase_orders (1) ---- (M) purchase_order_items

---

## Inventory Relationships

inventory_items (1) ---- (M) procurement_request_items

inventory_items (1) ---- (M) purchase_order_items

inventory_items (1) ---- (M) inventory_transactions

---

# 5. BUSINESS RULES

1. Every procurement request must belong to one requester.

2. A procurement request can contain multiple request items.

3. A procurement request can have multiple approval records.

4. A purchase order must belong to one supplier.

5. A purchase order may originate from a procurement request.

6. Inventory transactions must always reference an inventory item.

7. Notifications must belong to one user.

8. Activity logs should track all major system actions.

9. Inventory items may belong to categories.

10. Inventory items may have preferred suppliers.

---

# 6. ERD SUMMARY

Total Tables: 12

Total Core Relationships: 18+

Architecture Style: Relational Database Design

Database Engine: MySQL 8+

Normalization Level: Third Normal Form (3NF)

Primary Objective:

Provide a scalable database structure for procurement approval workflows, supplier management, inventory control, purchase order processing, auditing, and reporting within a film production organization.
