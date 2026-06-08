PROJECT NAME

PROJECT PURPOSE

BUSINESS DOMAIN

SYSTEM MODULES

DATABASE TABLES

USER ROLES

DIRECTORY STRUCTURE

CODING STANDARDS

NAMING CONVENTIONS

DESIGN DECISIONS

COMPLETED WORK

PENDING WORK

KNOWN RISKS

SUPERVISOR FEEDBACK

CHANGE LOG

# PROJECT_MEMORY.md

# FILM STUDIO PROCUREMENT APPROVAL AND INVENTORY MANAGEMENT SYSTEM

## MASTER PROJECT MEMORY DOCUMENT

### Version 1.0

### Single Source of Truth

---

# 1. PROJECT IDENTIFICATION

## Project Name

Film Studio Procurement Approval and Inventory Management System

## Project Type

Web-Based Information System

## Industry

Film Production and Studio Operations

## Development Status

Foundation Architecture Complete

Database Design Complete

Documentation Phase Complete

Implementation Phase Pending

---

# 2. PROJECT VISION

To build a centralized procurement approval and inventory management platform for film studios that digitizes procurement workflows, inventory control, supplier management, purchasing operations, reporting, notifications, and auditing.

The system will eliminate spreadsheet-based procurement tracking and provide a structured approval workflow with complete accountability.

---

# 3. PROJECT OBJECTIVES

The system shall:

* Manage procurement requests
* Automate approval workflows
* Manage inventory assets
* Manage suppliers
* Generate purchase orders
* Record inventory transactions
* Generate reports
* Maintain notifications
* Maintain audit logs
* Provide role-based security

---

# 4. TECHNOLOGY STACK

## Backend

PHP 8+

## Database

MySQL 8+

## Frontend

HTML5

CSS3

Bootstrap 5

JavaScript

## Database Access

PDO

Prepared Statements

## Authentication

PHP Sessions

Password Hashing

Role-Based Access Control

## Development Environment

Laragon

MySQL Workbench

Visual Studio Code

Git

GitHub

---

# 5. SYSTEM ARCHITECTURE

Architecture Style:

Layered Modular MVC-Inspired Architecture

### Layers

Presentation Layer

↓

Application Layer

↓

Business Logic Layer

↓

Data Access Layer

↓

Database Layer

---

# 6. SYSTEM USERS

## Administrator

Responsibilities

* User Management
* Activity Monitoring
* Reporting
* Configuration

---

## Manager

Responsibilities

* Approvals
* Procurement Oversight
* Reporting

---

## Procurement Officer

Responsibilities

* Inventory Management
* Supplier Management
* Purchase Orders

---

## Department Head

Responsibilities

* Request Review
* Request Approval

---

## Staff

Responsibilities

* Procurement Request Submission
* Request Tracking

---

# 7. DATABASE SUMMARY

Database Name:

film_studio_procurement

Total Tables:

12

---

## Tables

users

categories

suppliers

inventory_items

procurement_requests

procurement_request_items

approval_workflows

purchase_orders

purchase_order_items

inventory_transactions

notifications

activity_logs

---

# 8A. DATABASE TABLE DEFINITIONS
users

Purpose:
Stores system users and authentication information.

Primary Key:
id

Important Fields:

username
email
password_hash
full_name
role
department
is_active

Referenced By:

procurement_requests
approval_workflows
purchase_orders
inventory_transactions
notifications
activity_logs
categories

Purpose:
Organizes inventory items.

Primary Key:
id

Self Referencing:

parent_id → categories.id

Referenced By:

inventory_items
suppliers

Purpose:
Stores supplier records.

Primary Key:
id

Referenced By:

inventory_items
purchase_orders
inventory_items

Purpose:
Stores all inventory assets and consumables.

Primary Key:
id

Key Fields:

item_code
name
quantity_in_stock
reorder_level
reorder_quantity
location

Referenced By:

procurement_request_items
purchase_order_items
inventory_transactions
procurement_requests

Purpose:
Stores procurement requests submitted by staff.

Primary Key:
id

Key Fields:

request_number
requester_id
title
priority
status

Referenced By:

procurement_request_items
approval_workflows
purchase_orders
procurement_request_items

Purpose:
Stores individual items requested.

Primary Key:
id

Foreign Keys:

request_id
inventory_item_id
approval_workflows

Purpose:
Stores approval history and decisions.

Primary Key:
id

Foreign Keys:

request_id
approver_id
purchase_orders

Purpose:
Stores supplier purchase orders.

Primary Key:
id

Foreign Keys:

request_id
supplier_id
created_by

Referenced By:

purchase_order_items
purchase_order_items

Purpose:
Stores purchase order line items.

Primary Key:
id

Foreign Keys:

po_id
request_item_id
inventory_item_id
inventory_transactions

Purpose:
Stores stock movement history.

Primary Key:
id

Foreign Keys:

inventory_item_id
performed_by

Transaction Types:

receipt
issue
adjustment
return
transfer
notifications

Purpose:
Stores system notifications.

Primary Key:
id

Foreign Key:

user_id
activity_logs

Purpose:
Stores audit trail records.

Primary Key:
id

Foreign Key:

user_id

Stores:

action
entity_type
entity_id
details
ip_address

# 8B. DATABASE DESIGN PRINCIPLES
Every business transaction must be traceable.
Inventory quantity changes must be recorded in inventory_transactions.
Procurement requests must never directly modify inventory.
Inventory updates occur only after approved purchasing or stock transactions.
Purchase orders are generated only from approved procurement requests.
Activity logs must capture major system actions.
Notifications are generated for workflow events.
Soft business history must be preserved whenever possible.
All tables use InnoDB and foreign key enforcement.
All business entities use surrogate integer primary keys.

# 8C. DESIGN DECISIONS
Decision 1

Use a dedicated procurement workflow.

Reason:

Procurement approval is the primary business process.

Decision 2

Separate procurement requests from purchase orders.

Reason:

A request is an internal approval document.

A purchase order is an external supplier document.

Decision 3

Use inventory_transactions table.

Reason:

Inventory history must be auditable.

Stock quantities alone are insufficient.

Decision 4

Use approval_workflows table.

Reason:

Approval history must be preserved.

Future multi-level approvals become possible.

Decision 5

Use request items and PO items as separate tables.

Reason:

One request may generate multiple purchasing actions.

Decision 6

Use notifications table.

Reason:

Approval workflow requires user communication.

Decision 7

Use activity_logs table.

Reason:

System must support auditing and accountability.

Decision 8

Use category hierarchy.

Reason:

Film studios have large inventories with multiple equipment classes.

Decision 9

Use role-based access control.

Roles:

admin
manager
procurement_officer
department_head
staff
Decision 10

Use modular architecture.

Reason:

Modules can be developed independently and expanded later.

# 8D. CORE RELATIONSHIPS

users
→ procurement_requests

users
→ approval_workflows

users
→ purchase_orders

users
→ notifications

users
→ activity_logs

categories
→ inventory_items

suppliers
→ inventory_items

suppliers
→ purchase_orders

procurement_requests
→ procurement_request_items

procurement_requests
→ approval_workflows

procurement_requests
→ purchase_orders

purchase_orders
→ purchase_order_items

inventory_items
→ procurement_request_items

inventory_items
→ purchase_order_items

inventory_items
→ inventory_transactions

---

# 9. SYSTEM MODULES

## Authentication Module

Purpose:

User login and access control.

Tables:

users

---

## Dashboard Module

Purpose:

Operational overview and KPIs.

Tables:

procurement_requests

inventory_items

purchase_orders

approval_workflows

notifications

activity_logs

---

## User Management Module

Purpose:

Manage system users.

Tables:

users

---

## Procurement Request Module

Purpose:

Create and manage procurement requests.

Tables:

procurement_requests

procurement_request_items

---

## Approval Workflow Module

Purpose:

Approve or reject requests.

Tables:

approval_workflows

---

## Inventory Management Module

Purpose:

Manage inventory items and stock.

Tables:

inventory_items

inventory_transactions

categories

suppliers

---

## Supplier Management Module

Purpose:

Manage vendors and suppliers.

Tables:

suppliers

---

## Purchase Order Module

Purpose:

Manage procurement purchases.

Tables:

purchase_orders

purchase_order_items

---

## Reporting Module

Purpose:

Generate management reports.

Tables:

All tables

---

## Audit & Notification Module

Purpose:

Track activities and notify users.

Tables:

activity_logs

notifications

---

# 10. PROCUREMENT WORKFLOW

Staff Creates Request

↓

Request Saved

↓

Request Submitted

↓

Department Head Reviews

↓

Manager Reviews

↓

Approved

↓

Procurement Officer Creates Purchase Order

↓

Supplier Delivers Goods

↓

Goods Received

↓

Inventory Updated

↓

Transaction Logged

↓

Reports Generated

---

# 11. INVENTORY WORKFLOW

Inventory Item Created

↓

Stock Available

↓

Stock Issued

↓

Stock Returned

↓

Stock Adjusted

↓

Inventory Transaction Recorded

↓

Audit Log Recorded

---

# 12. PURCHASE ORDER WORKFLOW

Approved Request

↓

Create Purchase Order

↓

Select Supplier

↓

Generate PO

↓

Send to Supplier

↓

Receive Delivery

↓

Update Inventory

↓

Close Purchase Order

---

# 13. ROLE ACCESS MATRIX

| Module          | Admin | Manager | Procurement Officer | Department Head | Staff |
| --------------- | ----- | ------- | ------------------- | --------------- | ----- |
| Dashboard       | Yes   | Yes     | Yes                 | Yes             | Yes   |
| Users           | Yes   | No      | No                  | No              | No    |
| Requests        | Yes   | Yes     | Yes                 | Yes             | Yes   |
| Approvals       | Yes   | Yes     | No                  | Yes             | No    |
| Inventory       | Yes   | Yes     | Yes                 | No              | No    |
| Suppliers       | Yes   | No      | Yes                 | No              | No    |
| Purchase Orders | Yes   | Yes     | Yes                 | No              | No    |
| Reports         | Yes   | Yes     | Yes                 | No              | No    |
| Notifications   | Yes   | Yes     | Yes                 | Yes             | Yes   |
| Activity Logs   | Yes   | No      | No                  | No              | No    |

---

# 14. DIRECTORY STRUCTURE

FILM_STUDIO_PROCUREMENT/

database/

schema.sql

seed.sql

docs/

architecture.md

erd.md

modules.md

project_scope.md

use_cases.md

public/

assets/

css/

js/

images/

uploads/

src/

Controllers/

Models/

Services/

Repositories/

Core/

Middleware/

Helpers/

templates/

auth/

dashboard/

users/

requests/

approvals/

inventory/

suppliers/

purchase_orders/

reports/

notifications/

layouts/

components/

config/

db.php

routes.php

.env

.env.example

README.md

PROJECT_MEMORY.md

---

# 15. NAMING CONVENTIONS

## Database

snake_case

Examples

inventory_items

purchase_order_items

approval_workflows

---

## PHP Files

PascalCase

Examples

InventoryController.php

PurchaseOrderService.php

ApprovalWorkflowRepository.php

---

## Methods

camelCase

Examples

createRequest()

approveRequest()

recordInventoryTransaction()

---

## Variables

camelCase

Examples

$userId

$requestNumber

$totalAmount

---

# 16. CODING STANDARDS

## Security

Use PDO prepared statements.

Never concatenate SQL.

Validate all user input.

Escape all output.

Hash passwords.

Use CSRF protection.

Implement role-based authorization.

---

## Database

Use foreign keys.

Use transactions for critical operations.

Normalize tables.

Maintain audit trails.

---

## Documentation

Document all modules.

Document all database changes.

Document workflow changes.

Keep PROJECT_MEMORY.md updated.

---

# 17. DEVELOPMENT ROADMAP

## Phase 1

Foundation

* Database
* Authentication
* User Management

Status:

Completed Design

---

## Phase 2

Procurement Requests

* Request Creation
* Request Submission
* Request Tracking

Status:

Pending Development

---

## Phase 3

Approval Workflow

* Approval Chain
* Approval History

Status:

Pending Development

---

## Phase 4

Inventory Management

* Inventory Items
* Stock Control
* Transactions

Status:

Pending Development

---

## Phase 5

Supplier Management

* Supplier CRUD
* Supplier Tracking

Status:

Pending Development

---

## Phase 6

Purchase Orders

* PO Creation
* Goods Receipt

Status:

Pending Development

---

## Phase 7

Notifications

* Alerts
* Status Updates

Status:

Pending Development

---

## Phase 8

Reporting

* Procurement Reports
* Inventory Reports
* Supplier Reports

Status:

Pending Development

---

## Phase 9

Audit Logging

* User Activity Tracking
* Compliance Logging

Status:

Pending Development

---

# 18. FUTURE EXPANSION PLAN

Version 2.0

* Email Notifications
* PDF Purchase Orders
* Dashboard Analytics
* Excel Export
* Approval Escalation

Version 3.0

* Mobile Application
* Supplier Portal
* API Integration
* Advanced Reporting

Version 4.0

* AI Procurement Forecasting
* Procurement Recommendations
* Inventory Demand Prediction

---

# 19. PROJECT STATUS

Architecture Design:
Completed

Database Design:
Completed

ERD:
Completed

Use Cases:
Completed

Module Documentation:
Completed

Project Scope:
Completed

Project Memory:
Completed

Implementation:
Not Started

Testing:
Not Started

Deployment:
Not Started

---

# 20. MASTER RULE

Whenever future development begins:

1. PROJECT_MEMORY.md is the authoritative reference.

2. Database changes must remain consistent with schema.sql.

3. New modules must align with architecture.md.

4. New features must respect project_scope.md.

5. All future chats should begin by loading PROJECT_MEMORY.md before implementation work starts.

# 21. KNOWN FUTURE FEATURES

These features are intentionally excluded from Version 1.0 but are planned for future releases.

## Version 2.0

### Procurement Enhancements

* Multi-stage approval chains
* Approval delegation
* Approval escalation
* Approval reminders

### Purchase Order Enhancements

* PDF Purchase Order Generation
* Purchase Order Printing
* Supplier Email Dispatch
* Delivery Tracking

### Reporting Enhancements

* Export to Excel
* Export to PDF
* Scheduled Reports
* Interactive Dashboards

### Notification Enhancements

* Email Notifications
* SMS Notifications
* In-System Alerts

---

## Version 3.0

### Mobile Support

* Android Application
* Responsive Mobile Dashboard
* Mobile Approval Workflow

### Supplier Portal

* Supplier Self-Service Portal
* Quotation Submission
* Supplier Performance Tracking

### API Layer

* REST API
* Third-Party Integrations
* External Reporting Access

---

## Version 4.0

### Artificial Intelligence

* Demand Forecasting
* Procurement Recommendations
* Supplier Risk Analysis
* Inventory Consumption Prediction

### Business Intelligence

* Predictive Analytics
* Cost Optimization Reports
* Procurement Trend Analysis

---

# 22. KNOWN RISKS

## Technical Risks

### Database Growth

Risk:

Inventory transactions and activity logs may become very large.

Mitigation:

* Archive old records
* Add indexing
* Optimize reporting queries

---

### Poor Data Quality

Risk:

Users may enter inconsistent data.

Mitigation:

* Validation rules
* Required fields
* Standardized dropdown values

---

### Unauthorized Access

Risk:

Improper permissions may expose sensitive information.

Mitigation:

* Role-Based Access Control
* Session Validation
* Access Middleware

---

### Data Loss

Risk:

Database corruption or accidental deletion.

Mitigation:

* Automated Backups
* Transaction Management
* Recovery Procedures

---

# 23. DEVELOPMENT RULES

These rules are mandatory for all future development.

## Rule 1

Never bypass foreign key constraints.

---

## Rule 2

Never delete production data directly without backups.

---

## Rule 3

All database changes must be documented.

---

## Rule 4

All business actions must be logged when appropriate.

Examples:

* Request Approval
* Request Rejection
* Purchase Order Creation
* Inventory Adjustment

---

## Rule 5

All SQL queries must use prepared statements.

---

## Rule 6

User permissions must always be verified before processing actions.

---

## Rule 7

Business logic must not be placed directly inside templates.

Business logic belongs in:

* Services
* Controllers
* Domain Logic

---

## Rule 8

Database table names must remain snake_case.

Examples:

inventory_items

purchase_order_items

approval_workflows

---

## Rule 9

Primary keys remain integer AUTO_INCREMENT.

---

## Rule 10

PROJECT_MEMORY.md must be updated whenever architecture changes.

---

# 24. DATABASE MIGRATION RULES

## Purpose

Prevent schema drift during development.

---

## Rule 1

schema.sql is the master database definition.

Any database modification must first be reflected in schema.sql.

---

## Rule 2

No table may be created directly in MySQL without updating schema.sql.

---

## Rule 3

New columns require documentation updates.

Affected documents:

* schema.sql
* architecture.md
* modules.md
* PROJECT_MEMORY.md

---

## Rule 4

All foreign key relationships must be documented.

---

## Rule 5

Database backups are required before major schema changes.

Backup Naming Format:

backup_YYYY_MM_DD.sql

Example:

backup_2026_06_07.sql

---

## Rule 6

Deprecated tables must not be dropped immediately.

Process:

1. Mark deprecated.
2. Migrate data.
3. Verify migration.
4. Remove in next release.

---

# 25. IMPLEMENTATION PRIORITIES

Priority 1

* Authentication
* User Management
* Dashboard

Priority 2

* Procurement Requests
* Approval Workflow

Priority 3

* Inventory Management

Priority 4

* Supplier Management

Priority 5

* Purchase Orders

Priority 6

* Notifications

Priority 7

* Reporting

Priority 8

* Analytics

---

# 26. LESSONS LEARNED

During project planning, the following decisions were made:

### Lesson 1

Procurement and Inventory are separate business domains.

Inventory alone is not the primary objective.

---

### Lesson 2

Approval Workflow is a core system component.

The system is not simply an inventory application.

---

### Lesson 3

Purchase Orders must originate from approved requests.

---

### Lesson 4

Auditability is essential.

All critical actions must be traceable.

---

### Lesson 5

A clean architecture is preferable to retrofitting a legacy design.

The project was intentionally redesigned around procurement-first principles.

---

# 27. MASTER PROJECT STATUS

Documentation Status

✓ Architecture Complete

✓ Scope Complete

✓ Use Cases Complete

✓ Modules Complete

✓ Database Schema Complete

✓ Seed Data Complete

✓ Project Memory Complete

Development Status

□ Not Started

Testing Status

□ Not Started

Deployment Status

□ Not Started

Current Phase

Foundation Complete

Next Phase

Authentication Module Development

# 28. CURRENT PROJECT STATUS

### Completed Modules

#### Foundation

* Project structure established
* Front controller architecture
* PDO database connection
* Autoloader implementation
* Session management

#### Authentication

* Login
* Logout
* Password verification
* Session protection
* Dashboard access control

#### User Management

* User listing
* Create user
* Edit user
* Activate user
* Deactivate user
* Duplicate username validation
* Duplicate email validation
* Password validation
* Admin-only access
* Self-deactivation protection

#### Suppliers Module

* Database schema verified
* Supplier model implemented
* Supplier controller implemented
* Supplier route implemented
* Supplier module successfully loads

### Current Stable Recovery Point

Authentication Module: COMPLETE

User Management Module: COMPLETE

Suppliers Module: FOUNDATION COMPLETE

### Next Module Work

Suppliers Module:

* Supplier listing
* Create supplier
* Edit supplier
* Activate/deactivate supplier
* Testing

After Suppliers:

1. Inventory
2. Purchase Requests
3. Approvals
4. Purchase Orders
5. Goods Receiving
6. Reports
7. Notifications
8. Analytics

---

# 28. NEXT STEPS
Next Session Starting Point
Suppliers Module
Phase 1:
- Display suppliers from database
- Create supplier
- Edit supplier
- Activate/deactivate supplier
- Testing

## Suppliers Module

### Completed Features

* Supplier listing
* Create supplier
* Edit supplier
* Activate supplier
* Deactivate supplier
* Company duplicate validation
* Email validation
* Rating validation
* Database integration testing

### Supplier Table

Fields:

* id
* company_name
* contact_person
* email
* phone
* address
* website
* tax_id
* payment_terms
* rating
* is_active
* created_at
* updated_at

### Testing Status

All supplier module tests passed successfully.

###