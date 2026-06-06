# FILM STUDIO PROCUREMENT APPROVAL AND INVENTORY MANAGEMENT SYSTEM

# USE CASE DOCUMENT

## Version 1.0

---

# 1. INTRODUCTION

## Purpose

This document describes the functional interactions between users and the Film Studio Procurement Approval and Inventory Management System.

The use cases define:

* System actors
* User responsibilities
* System functionality
* User interactions
* Business workflows

---

# 2. SYSTEM ACTORS

## Administrator

Responsible for:

* User management
* System monitoring
* Activity auditing
* Configuration management
* Reporting

---

## Manager

Responsible for:

* Reviewing requests
* Approving requests
* Monitoring procurement activities
* Viewing reports

---

## Procurement Officer

Responsible for:

* Managing procurement requests
* Managing suppliers
* Creating purchase orders
* Updating inventory

---

## Department Head

Responsible for:

* Reviewing departmental requests
* Approving or rejecting requests

---

## Staff

Responsible for:

* Creating procurement requests
* Tracking request status

---

# 3. USE CASE DIAGRAM OVERVIEW

Actors interact with:

* Authentication Module
* Procurement Request Module
* Approval Workflow Module
* Inventory Module
* Supplier Module
* Purchase Order Module
* Notification Module
* Reporting Module
* Audit Module

---

# 4. AUTHENTICATION USE CASES

## UC-001 Login

### Actor

All Users

### Description

Allows a registered user to access the system.

### Preconditions

* User account exists
* Account is active

### Main Flow

1. User enters username/email.
2. User enters password.
3. System validates credentials.
4. System creates session.
5. Dashboard is displayed.

### Postconditions

User is authenticated.

---

## UC-002 Logout

### Actor

All Users

### Main Flow

1. User selects logout.
2. Session is destroyed.
3. Login page is displayed.

### Postconditions

User session ends.

---

# 5. PROCUREMENT REQUEST USE CASES

## UC-003 Create Procurement Request

### Actor

Staff

### Description

Allows a staff member to request procurement items.

### Main Flow

1. User opens request form.
2. User enters request details.
3. User adds request items.
4. User submits request.
5. System stores request.
6. Status becomes Draft.

### Postconditions

Request is created.

---

## UC-004 Submit Procurement Request

### Actor

Staff

### Main Flow

1. User opens draft request.
2. User selects Submit.
3. System validates request.
4. System changes status to Pending.
5. Notification is sent.

### Postconditions

Request enters approval workflow.

---

## UC-005 View Request Status

### Actor

Staff

### Main Flow

1. User opens Requests.
2. System displays current status.
3. User views approval progress.

### Postconditions

Request information is displayed.

---

# 6. APPROVAL WORKFLOW USE CASES

## UC-006 Review Procurement Request

### Actor

Department Head

### Main Flow

1. Approver receives notification.
2. Approver opens request.
3. Approver reviews information.
4. Approver selects action.

### Postconditions

Decision is recorded.

---

## UC-007 Approve Request

### Actor

Department Head / Manager

### Main Flow

1. Approver reviews request.
2. Approver clicks Approve.
3. System records approval.
4. Workflow advances.

### Postconditions

Request progresses.

---

## UC-008 Reject Request

### Actor

Department Head / Manager

### Main Flow

1. Approver reviews request.
2. Approver enters comments.
3. Approver clicks Reject.
4. System updates status.

### Postconditions

Request is rejected.

---

# 7. INVENTORY MANAGEMENT USE CASES

## UC-009 Create Inventory Item

### Actor

Procurement Officer

### Main Flow

1. User opens Inventory.
2. User selects Add Item.
3. User enters item details.
4. User saves item.
5. System creates inventory record.

### Postconditions

Inventory item is stored.

---

## UC-010 Update Inventory Item

### Actor

Procurement Officer

### Main Flow

1. User selects item.
2. User edits details.
3. User saves changes.
4. System updates record.

### Postconditions

Inventory item is updated.

---

## UC-011 View Inventory

### Actor

All Authorized Users

### Main Flow

1. User opens inventory module.
2. System displays inventory list.
3. User filters/searches records.

### Postconditions

Inventory information is displayed.

---

## UC-012 Record Inventory Transaction

### Actor

Procurement Officer

### Main Flow

1. User selects inventory item.
2. User records transaction.
3. System updates stock quantity.
4. Transaction history is stored.

### Postconditions

Inventory movement is logged.

---

# 8. SUPPLIER MANAGEMENT USE CASES

## UC-013 Add Supplier

### Actor

Procurement Officer

### Main Flow

1. User opens supplier module.
2. User enters supplier details.
3. User saves record.
4. System stores supplier.

### Postconditions

Supplier is created.

---

## UC-014 Update Supplier

### Actor

Procurement Officer

### Main Flow

1. User selects supplier.
2. User edits information.
3. User saves changes.

### Postconditions

Supplier information is updated.

---

## UC-015 View Suppliers

### Actor

Procurement Officer

### Main Flow

1. User opens supplier module.
2. System displays supplier records.

### Postconditions

Supplier information is displayed.

---

# 9. PURCHASE ORDER USE CASES

## UC-016 Create Purchase Order

### Actor

Procurement Officer

### Main Flow

1. User selects approved request.
2. User creates purchase order.
3. Supplier is selected.
4. Order items are generated.
5. System stores purchase order.

### Postconditions

Purchase order is created.

---

## UC-017 Update Purchase Order Status

### Actor

Procurement Officer

### Main Flow

1. User opens purchase order.
2. User updates delivery status.
3. System saves changes.

### Postconditions

Purchase order status is updated.

---

## UC-018 Receive Purchase Order

### Actor

Procurement Officer

### Main Flow

1. Delivery arrives.
2. User verifies items.
3. User records receipt.
4. Inventory is updated.
5. Transaction history is generated.

### Postconditions

Inventory stock increases.

---

# 10. NOTIFICATION USE CASES

## UC-019 View Notifications

### Actor

All Users

### Main Flow

1. User opens notification center.
2. System displays notifications.
3. User reviews messages.

### Postconditions

Notification information is displayed.

---

## UC-020 Mark Notification Read

### Actor

All Users

### Main Flow

1. User opens notification.
2. User marks notification as read.
3. System updates status.

### Postconditions

Notification status changes.

---

# 11. REPORTING USE CASES

## UC-021 Generate Procurement Report

### Actor

Administrator / Manager

### Main Flow

1. User selects report.
2. User selects date range.
3. System generates report.

### Postconditions

Report is displayed.

---

## UC-022 Generate Inventory Report

### Actor

Administrator / Procurement Officer

### Main Flow

1. User selects inventory report.
2. System generates stock information.

### Postconditions

Inventory report is produced.

---

## UC-023 Generate Supplier Report

### Actor

Administrator / Procurement Officer

### Main Flow

1. User selects supplier report.
2. System generates report.

### Postconditions

Supplier report is displayed.

---

# 12. USER MANAGEMENT USE CASES

## UC-024 Create User

### Actor

Administrator

### Main Flow

1. Administrator opens user module.
2. Administrator enters user details.
3. Administrator saves user.

### Postconditions

User account is created.

---

## UC-025 Update User

### Actor

Administrator

### Main Flow

1. Administrator selects user.
2. Administrator edits information.
3. Administrator saves changes.

### Postconditions

User record is updated.

---

## UC-026 Deactivate User

### Actor

Administrator

### Main Flow

1. Administrator selects account.
2. Administrator deactivates account.
3. System updates status.

### Postconditions

User cannot access the system.

---

# 13. AUDIT USE CASES

## UC-027 View Activity Logs

### Actor

Administrator

### Main Flow

1. Administrator opens activity logs.
2. System displays audit records.
3. Administrator reviews actions.

### Postconditions

Audit trail is displayed.

---

# 14. SUMMARY

Total Actors: 5

Total Use Cases: 27

Core Business Modules:

* Authentication
* User Management
* Procurement Requests
* Approval Workflow
* Inventory Management
* Supplier Management
* Purchase Orders
* Notifications
* Reporting
* Audit Logging

These use cases serve as the functional blueprint for system implementation, interface design, testing, and future expansion.
