# FUNCTIONAL REQUIREMENTS DOCUMENT

# Film Studio Procurement Approval and Inventory Management System

Version 1.0

---

# 1. INTRODUCTION

This document defines the functional requirements of the Film Studio Procurement Approval and Inventory Management System.

Functional requirements describe what the system must do.

---

# 2. USER AUTHENTICATION MODULE

## FR-001 User Login

Description:

The system shall allow registered users to log in using their credentials.

Inputs:

* Username or Email
* Password

Outputs:

* Successful Login
* Error Message

Priority:

High

---

## FR-002 User Logout

Description:

The system shall allow authenticated users to terminate their session.

Priority:

High

---

## FR-003 Session Validation

Description:

The system shall validate active sessions before granting access.

Priority:

High

---

# 3. USER MANAGEMENT MODULE

## FR-004 Create User

Description:

Administrators shall create user accounts.

Priority:

High

---

## FR-005 Update User

Description:

Administrators shall update user information.

Priority:

High

---

## FR-006 Deactivate User

Description:

Administrators shall deactivate users.

Priority:

Medium

---

## FR-007 Assign Roles

Description:

Administrators shall assign system roles.

Roles:

* Admin
* Manager
* Procurement Officer
* Department Head
* Staff

Priority:

High

---

# 4. PROCUREMENT REQUEST MODULE

## FR-008 Create Procurement Request

Description:

Staff shall create procurement requests.

Priority:

High

---

## FR-009 Add Request Items

Description:

Users shall add one or more items to a request.

Priority:

High

---

## FR-010 Edit Draft Request

Description:

Users shall edit requests before submission.

Priority:

High

---

## FR-011 Submit Request

Description:

Users shall submit requests for approval.

Priority:

High

---

## FR-012 View Request Status

Description:

Users shall track request progress.

Priority:

High

---

## FR-013 View Request History

Description:

Users shall view previous requests.

Priority:

Medium

---

# 5. APPROVAL WORKFLOW MODULE

## FR-014 View Pending Approvals

Description:

Approvers shall view requests awaiting review.

Priority:

High

---

## FR-015 Approve Request

Description:

Approvers shall approve requests.

Priority:

High

---

## FR-016 Reject Request

Description:

Approvers shall reject requests.

Priority:

High

---

## FR-017 Record Approval Comments

Description:

Approvers shall provide comments.

Priority:

Medium

---

## FR-018 View Approval History

Description:

Users shall view workflow history.

Priority:

Medium

---

# 6. INVENTORY MANAGEMENT MODULE

## FR-019 Create Inventory Item

Description:

Procurement officers shall create inventory items.

Priority:

High

---

## FR-020 Update Inventory Item

Description:

Inventory records shall be editable.

Priority:

High

---

## FR-021 Search Inventory

Description:

Users shall search inventory items.

Priority:

Medium

---

## FR-022 View Inventory Details

Description:

Users shall view inventory information.

Priority:

Medium

---

## FR-023 Monitor Stock Levels

Description:

System shall monitor stock quantities.

Priority:

High

---

## FR-024 Generate Low Stock Alerts

Description:

System shall identify low-stock items.

Priority:

High

---

# 7. SUPPLIER MANAGEMENT MODULE

## FR-025 Create Supplier

Description:

Procurement officers shall register suppliers.

Priority:

High

---

## FR-026 Update Supplier

Description:

Supplier information shall be editable.

Priority:

High

---

## FR-027 View Supplier Details

Description:

Users shall view supplier profiles.

Priority:

Medium

---

## FR-028 Deactivate Supplier

Description:

Suppliers may be deactivated.

Priority:

Low

---

# 8. PURCHASE ORDER MODULE

## FR-029 Create Purchase Order

Description:

Approved requests shall generate purchase orders.

Priority:

High

---

## FR-030 Add Purchase Order Items

Description:

Procurement officers shall define PO items.

Priority:

High

---

## FR-031 View Purchase Orders

Description:

Users shall browse purchase orders.

Priority:

Medium

---

## FR-032 Update Purchase Order Status

Description:

PO status shall be updated.

Statuses:

* Draft
* Sent
* Confirmed
* Partially Received
* Received
* Cancelled

Priority:

High

---

## FR-033 Receive Goods

Description:

Goods receipts shall update inventory.

Priority:

High

---

# 9. INVENTORY TRANSACTION MODULE

## FR-034 Record Receipt Transaction

Description:

System shall record stock receipts.

Priority:

High

---

## FR-035 Record Issue Transaction

Description:

System shall record stock issues.

Priority:

High

---

## FR-036 Record Adjustment Transaction

Description:

System shall record stock adjustments.

Priority:

High

---

## FR-037 View Transaction History

Description:

Users shall view inventory movement history.

Priority:

Medium

---

# 10. NOTIFICATION MODULE

## FR-038 Generate Approval Notifications

Description:

System shall notify approvers.

Priority:

Medium

---

## FR-039 Generate Status Notifications

Description:

System shall notify users of workflow changes.

Priority:

Medium

---

## FR-040 Mark Notification as Read

Description:

Users shall manage notifications.

Priority:

Low

---

# 11. REPORTING MODULE

## FR-041 Procurement Report

Description:

Generate procurement activity reports.

Priority:

High

---

## FR-042 Inventory Report

Description:

Generate inventory reports.

Priority:

High

---

## FR-043 Supplier Report

Description:

Generate supplier reports.

Priority:

Medium

---

## FR-044 Purchase Order Report

Description:

Generate purchase order reports.

Priority:

Medium

---

# 12. AUDIT MODULE

## FR-045 Record User Activities

Description:

System shall maintain audit logs.

Priority:

High

---

## FR-046 View Audit Logs

Description:

Administrators shall review system activities.

Priority:

Medium

---

# 13. DASHBOARD MODULE

## FR-047 View Dashboard Metrics

Description:

System shall display operational KPIs.

Priority:

High

---

## FR-048 View Pending Actions

Description:

Users shall see pending tasks.

Priority:

High

---

## FR-049 View Alerts

Description:

System shall display notifications and warnings.

Priority:

Medium

---

# 14. REQUIREMENTS SUMMARY

Total Functional Requirements:

49

Critical Requirements:

* Authentication
* Procurement Requests
* Approval Workflow
* Inventory Management
* Purchase Orders

Supporting Requirements:

* Notifications
* Reports
* Audit Logs

System Version:

1.0
