# SCREEN INVENTORY DOCUMENT

# Film Studio Procurement Approval and Inventory Management System

Version 1.0

---

# 1. INTRODUCTION

This document defines all screens, pages, forms, dashboards, reports, modals, and workflows planned for the system.

Purpose:

* UI Planning
* Development Estimation
* Testing Planning
* Documentation Reference

---

# 2. AUTHENTICATION MODULE

## AUTH-001 Login Page

Purpose:

Authenticate users.

Functions:

* Login
* Password Validation
* Session Creation

Fields:

* Username/Email
* Password

Actions:

* Login

---

## AUTH-002 Logout Process

Purpose:

Terminate active session.

Actions:

* Logout

---

# 3. DASHBOARD MODULE

## DASH-001 Main Dashboard

Purpose:

Provide operational overview.

Widgets:

* Total Procurement Requests
* Pending Requests
* Approved Requests
* Rejected Requests
* Inventory Items
* Low Stock Alerts
* Purchase Orders
* Suppliers

Quick Actions:

* Create Request
* Approve Requests
* View Inventory
* Create Purchase Order

---

## DASH-002 Notifications Panel

Purpose:

Display user notifications.

Functions:

* View Notifications
* Mark as Read

---

# 4. USER MANAGEMENT MODULE

## USER-001 User List

Purpose:

Display all users.

Functions:

* Search Users
* Filter Users
* View Details

Actions:

* Create
* Edit
* Activate
* Deactivate

---

## USER-002 Create User

Purpose:

Create new system user.

Fields:

* Username
* Email
* Full Name
* Password
* Role
* Department

---

## USER-003 Edit User

Purpose:

Update user information.

Fields:

* Full Name
* Email
* Department
* Role
* Status

---

## USER-004 User Profile

Purpose:

Display personal account information.

Functions:

* Update Profile
* Change Password

---

# 5. PROCUREMENT REQUEST MODULE

## REQ-001 Request List

Purpose:

Display procurement requests.

Functions:

* Search
* Filter
* Sort

Filters:

* Status
* Priority
* Date

---

## REQ-002 Create Request

Purpose:

Create procurement request.

Fields:

* Title
* Description
* Justification
* Required Date
* Priority

Functions:

* Add Request Items
* Save Draft
* Submit

---

## REQ-003 Request Items Form

Purpose:

Manage request line items.

Fields:

* Item Name
* Description
* Quantity
* Unit
* Estimated Price

Actions:

* Add Item
* Edit Item
* Remove Item

---

## REQ-004 Request Details

Purpose:

Display complete request information.

Sections:

* Request Information
* Requested Items
* Approval History
* Current Status

---

## REQ-005 Edit Draft Request

Purpose:

Modify draft requests.

Actions:

* Save
* Submit

---

# 6. APPROVAL WORKFLOW MODULE

## APR-001 Pending Approvals

Purpose:

Display requests awaiting approval.

Functions:

* Review Request
* Approve
* Reject

---

## APR-002 Approval Review Screen

Purpose:

Review procurement request.

Sections:

* Request Information
* Requested Items
* Requester Details
* Previous Approvals

Actions:

* Approve
* Reject

Fields:

* Comments

---

## APR-003 Approval History

Purpose:

Display approval records.

Columns:

* Request Number
* Approver
* Decision
* Date
* Comments

---

# 7. INVENTORY MANAGEMENT MODULE

## INV-001 Inventory List

Purpose:

Display inventory items.

Functions:

* Search
* Filter
* Sort

Filters:

* Category
* Supplier
* Status

---

## INV-002 Create Inventory Item

Purpose:

Create inventory record.

Fields:

* Item Code
* Name
* Description
* Category
* Supplier
* Unit Price
* Quantity
* Reorder Level
* Location

---

## INV-003 Edit Inventory Item

Purpose:

Update inventory records.

---

## INV-004 Inventory Details

Purpose:

Display inventory information.

Sections:

* General Information
* Supplier
* Stock Information
* Transaction History

---

## INV-005 Low Stock Report

Purpose:

Display low stock items.

Criteria:

Quantity <= Reorder Level

---

## INV-006 Inventory Transaction History

Purpose:

Display stock movement history.

Filters:

* Date
* Item
* Transaction Type

---

# 8. SUPPLIER MANAGEMENT MODULE

## SUP-001 Supplier List

Purpose:

Display suppliers.

Functions:

* Search
* Filter

---

## SUP-002 Create Supplier

Purpose:

Register supplier.

Fields:

* Company Name
* Contact Person
* Email
* Phone
* Address
* Website

---

## SUP-003 Edit Supplier

Purpose:

Update supplier information.

---

## SUP-004 Supplier Details

Purpose:

Display supplier profile.

Sections:

* Company Information
* Contact Information
* Related Purchase Orders
* Related Inventory Items

---

# 9. PURCHASE ORDER MODULE

## PO-001 Purchase Order List

Purpose:

Display purchase orders.

Filters:

* Status
* Supplier
* Date

---

## PO-002 Create Purchase Order

Purpose:

Generate purchase order.

Fields:

* Supplier
* Request Reference
* Delivery Date
* Notes

Functions:

* Add Items
* Calculate Totals

---

## PO-003 Purchase Order Details

Purpose:

Display complete purchase order.

Sections:

* Supplier
* Order Information
* Ordered Items
* Delivery Status

---

## PO-004 Receive Goods

Purpose:

Record goods receipt.

Functions:

* Update Received Quantity
* Update Inventory
* Generate Transaction Record

---

## PO-005 Purchase Order History

Purpose:

Display historical purchase orders.

---

# 10. REPORTING MODULE

## REP-001 Procurement Report

Purpose:

Display procurement activity.

---

## REP-002 Inventory Report

Purpose:

Display inventory status.

---

## REP-003 Supplier Report

Purpose:

Display supplier performance.

---

## REP-004 Purchase Order Report

Purpose:

Display purchasing activities.

---

## REP-005 Inventory Transaction Report

Purpose:

Display stock movement analysis.

---

## REP-006 Audit Report

Purpose:

Display system activities.

---

# 11. NOTIFICATION MODULE

## NOT-001 Notification List

Purpose:

Display user notifications.

Functions:

* Mark as Read
* Delete Notification

---

## NOT-002 Notification Details

Purpose:

Display notification information.

---

# 12. AUDIT MODULE

## AUD-001 Activity Log List

Purpose:

Display system activity records.

Filters:

* User
* Action
* Date

---

## AUD-002 Activity Log Details

Purpose:

Display audit log details.

---

# 13. SETTINGS MODULE

## SET-001 System Settings

Purpose:

Manage application settings.

Functions:

* Update Configuration
* Save Settings

---

# 14. ERROR PAGES

## ERR-001 403 Forbidden

Purpose:

Unauthorized access.

---

## ERR-002 404 Not Found

Purpose:

Missing page.

---

## ERR-003 500 Internal Server Error

Purpose:

Application error.

---

# 15. SCREEN COUNT SUMMARY

| Module               | Screens |
| -------------------- | ------- |
| Authentication       | 2       |
| Dashboard            | 2       |
| Users                | 4       |
| Procurement Requests | 5       |
| Approvals            | 3       |
| Inventory            | 6       |
| Suppliers            | 4       |
| Purchase Orders      | 5       |
| Reports              | 6       |
| Notifications        | 2       |
| Audit Logs           | 2       |
| Settings             | 1       |
| Error Pages          | 3       |

Total Planned Screens: 45

---

# 16. DEVELOPMENT ORDER

Phase 1

* Login
* Dashboard

Phase 2

* Users

Phase 3

* Procurement Requests

Phase 4

* Approval Workflow

Phase 5

* Inventory

Phase 6

* Suppliers

Phase 7

* Purchase Orders

Phase 8

* Notifications

Phase 9

* Reports

Phase 10

* Audit Logs

Phase 11

* Settings

Phase 12

* Testing and Deployment

---

System Version:

1.0
