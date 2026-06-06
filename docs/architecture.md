# FILM STUDIO PROCUREMENT APPROVAL AND INVENTORY MANAGEMENT SYSTEM

# SYSTEM ARCHITECTURE DOCUMENT

## Version 1.0

---

# 1. PROJECT OVERVIEW

## Project Title

Film Studio Procurement Approval and Inventory Management System

## Project Description

The Film Studio Procurement Approval and Inventory Management System is a web-based information system developed to manage procurement activities, approval workflows, inventory control, supplier records, purchase orders, notifications, and reporting within a film production organization.

The system provides a centralized platform for managing procurement operations from request initiation to final inventory receipt. It improves transparency, accountability, operational efficiency, and decision-making through structured workflows and real-time data management.

---

# 2. SYSTEM OBJECTIVES

The objectives of the system are to:

* Automate procurement request processes.
* Improve approval workflow management.
* Maintain accurate inventory records.
* Manage suppliers and procurement partners.
* Track procurement transactions.
* Generate operational reports.
* Maintain audit trails for accountability.
* Reduce procurement delays.
* Improve stock visibility.
* Support management decision-making.

---

# 3. SYSTEM SCOPE

## Scope Statement

The system is designed to support procurement planning, approval workflows, supplier management, inventory control, purchase order processing, notifications, and reporting activities within a film production organization.

The platform provides a centralized environment where authorized users can create requests, approve transactions, manage inventory assets, monitor procurement activities, and generate reports.

---

## In-Scope Features

### User Management

The system shall:

* Register users
* Manage user accounts
* Authenticate users
* Assign roles
* Control permissions
* Manage user profiles

Supported roles include:

* Administrator
* Manager
* Procurement Officer
* Department Head
* Staff

---

### Procurement Request Management

The system shall:

* Create procurement requests
* Edit procurement requests
* Submit requests for approval
* Track request status
* View request history
* Manage procurement request items

---

### Approval Workflow Management

The system shall:

* Route requests for approval
* Record approval decisions
* Record rejection decisions
* Store comments
* Maintain approval history
* Notify stakeholders

---

### Inventory Management

The system shall:

* Register inventory items
* Categorize inventory assets
* Monitor stock levels
* Track inventory locations
* Monitor reorder levels
* Record inventory transactions
* Generate stock alerts

---

### Supplier Management

The system shall:

* Register suppliers
* Maintain supplier records
* Store contact information
* Monitor supplier ratings
* Track supplier performance

---

### Purchase Order Management

The system shall:

* Create purchase orders
* Manage purchase order items
* Track delivery status
* Record received items
* Link suppliers and procurement requests

---

### Notification Management

The system shall:

* Generate notifications
* Notify approvers
* Notify requesters
* Notify procurement officers
* Track notification status

---

### Audit and Activity Tracking

The system shall:

* Record user activities
* Record approval actions
* Record inventory changes
* Record procurement transactions
* Maintain complete audit trails

---

### Reporting

The system shall generate:

* Procurement reports
* Inventory reports
* Supplier reports
* Purchase order reports
* Approval reports
* Activity reports

---

## Out-of-Scope Features

The following features are not included in Version 1.0:

### Financial Management

* Budgeting
* Accounting
* Payroll
* Tax processing
* Financial forecasting

### Human Resource Management

* Recruitment
* Attendance
* Employee evaluation
* Salary management

### Production Scheduling

* Film shoot scheduling
* Crew allocation
* Project timeline management

### Advanced Asset Tracking

* RFID tracking
* GPS tracking
* Barcode scanning
* QR code scanning

### External Supplier Portal

Suppliers will not have direct access to the system.

---

## System Boundaries

### Internal Users

* Administrators
* Managers
* Procurement Officers
* Department Heads
* Staff

### External Entities

* Suppliers
* Inventory Assets
* Procurement Documentation

---

## Expected Benefits

The system will:

* Improve procurement efficiency
* Reduce stock shortages
* Improve approval transparency
* Improve supplier management
* Improve accountability
* Improve reporting accuracy
* Improve operational decision-making

---

# 4. ARCHITECTURAL STYLE

## Architecture Pattern

The system follows a Layered Three-Tier Architecture.

### Presentation Layer

Responsible for:

* User Interface
* Forms
* Dashboards
* Reports
* Navigation

Location:

templates/

---

### Business Logic Layer

Responsible for:

* Procurement processing
* Approval workflows
* Inventory calculations
* Validation rules
* Business operations

Location:

src/

---

### Data Layer

Responsible for:

* Database access
* Data storage
* Query execution
* Transaction management

Location:

config/db.php

database/

---

# 5. TECHNOLOGY STACK

## Frontend

* HTML5
* CSS3
* Bootstrap 5
* JavaScript

## Backend

* PHP 8+

## Database

* MySQL 8+
* MySQL Workbench

## Dependency Management

* Composer

## Development Environment

* Laragon

## Version Control

* Git
* GitHub

---

# 6. USER ROLES

## Administrator

Responsibilities:

* Manage users
* Manage permissions
* View reports
* Monitor system activity
* Manage settings

---

## Manager

Responsibilities:

* Review requests
* Approve procurement activities
* Monitor reports

---

## Procurement Officer

Responsibilities:

* Manage procurement requests
* Create purchase orders
* Manage suppliers
* Update inventory records

---

## Department Head

Responsibilities:

* Review departmental requests
* Approve procurement requests

---

## Staff

Responsibilities:

* Submit procurement requests
* Monitor request status

---

# 7. CORE MODULES

## Authentication Module

Functions:

* Login
* Logout
* Session management
* Password management

---

## User Management Module

Functions:

* User registration
* User administration
* Role assignment

---

## Procurement Request Module

Functions:

* Request creation
* Request tracking
* Request management

---

## Approval Workflow Module

Functions:

* Approval routing
* Approval decisions
* Approval tracking

---

## Inventory Management Module

Functions:

* Inventory registration
* Stock monitoring
* Inventory transactions

---

## Supplier Management Module

Functions:

* Supplier registration
* Supplier maintenance
* Supplier evaluation

---

## Purchase Order Module

Functions:

* Purchase order creation
* Order tracking
* Delivery management

---

## Notification Module

Functions:

* Alert generation
* Status notifications
* Workflow reminders

---

## Reporting Module

Functions:

* Operational reporting
* Procurement analytics
* Inventory analytics

---

## Audit Module

Functions:

* Activity tracking
* Change logging
* Audit trails

---

# 8. DATABASE ARCHITECTURE

## Main Tables

### users

Stores system users.

### categories

Stores inventory categories.

### suppliers

Stores supplier information.

### inventory_items

Stores inventory assets and stock records.

### procurement_requests

Stores procurement requests.

### procurement_request_items

Stores request line items.

### approval_workflows

Stores approval records.

### purchase_orders

Stores purchase order records.

### purchase_order_items

Stores purchase order line items.

### inventory_transactions

Stores stock movement records.

### notifications

Stores system notifications.

### activity_logs

Stores audit information.

---

# 9. PROCUREMENT WORKFLOW

## Step 1

Staff creates procurement request.

↓

## Step 2

Request submitted.

↓

## Step 3

Department Head reviews request.

↓

## Step 4

Manager approves request.

↓

## Step 5

Procurement Officer creates purchase order.

↓

## Step 6

Supplier fulfills order.

↓

## Step 7

Inventory receives items.

↓

## Step 8

Inventory records updated.

↓

## Step 9

Activity logged.

---

# 10. SECURITY ARCHITECTURE

## Authentication

* Username login
* Password verification
* Session management

## Authorization

Role-based access control.

## Database Security

* Prepared statements
* Foreign key constraints
* Transaction support

## Audit Security

* Activity tracking
* Change logging
* User accountability

---

# 11. REPORTING FEATURES

The system shall generate:

## Procurement Reports

* Request statistics
* Approval statistics

## Inventory Reports

* Stock levels
* Low-stock alerts

## Supplier Reports

* Supplier performance
* Supplier activity

## Purchase Order Reports

* Order summaries
* Delivery status

## Audit Reports

* User activity
* System events

---

# 12. PHYSICAL ARCHITECTURE

## Client Layer

Web Browser

↓

## Web Server Layer

Apache / Laragon

↓

## Application Layer

PHP Application

↓

## Database Layer

MySQL Database

---

# 13. PROJECT DIRECTORY STRUCTURE

```text
FILM_STUDIO_PROCUREMENT/

├── config/
│   └── db.php
│
├── database/
│   ├── schema.sql
│   └── seed.sql
│
├── docs/
│   ├── architecture.md
│   ├── erd.md
│   └── use_cases.md
│
├── public/
│   ├── assets/
│   │   ├── css/
│   │   ├── js/
│   │   └── images/
│   │
│   └── index.php
│
├── src/
│   ├── Controllers/
│   ├── Models/
│   ├── Services/
│   ├── Repositories/
│   └── Core/
│
├── templates/
│   ├── auth/
│   ├── dashboard/
│   ├── procurement_requests/
│   ├── approvals/
│   ├── inventory/
│   ├── suppliers/
│   ├── purchase_orders/
│   ├── reports/
│   ├── notifications/
│   ├── settings/
│   └── includes/
│
├── vendor/
│
├── .env
├── composer.json
├── README.md
└── PROJECT_MEMORY.md
```

---

# 14. DEPLOYMENT TARGET

## Development

* Windows 10/11
* Laragon
* PHP 8+
* MySQL 8+

## Production

* Linux Server
* Apache/Nginx
* PHP 8+
* MySQL 8+

---

# 15. FUTURE ENHANCEMENTS

Planned future improvements include:

* Barcode integration
* QR code integration
* RFID inventory tracking
* Mobile application support
* Supplier portal
* Email notifications
* SMS notifications
* Budget management
* Analytics dashboard
* Business intelligence reporting

---

# 16. CONCLUSION

The Film Studio Procurement Approval and Inventory Management System provides a centralized platform for managing procurement workflows, approvals, supplier relationships, inventory assets, purchase orders, notifications, and reporting activities.

The architecture is designed using a layered three-tier structure that promotes scalability, maintainability, security, and future expansion while supporting the operational requirements of a modern film production organization.
