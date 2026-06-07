# TESTING STRATEGY

# Film Studio Procurement Approval and Inventory Management System

Version 1.0

---

# 1. PURPOSE

This document defines the testing approach, testing scope, testing methods, test responsibilities, and acceptance criteria for the Film Studio Procurement Approval and Inventory Management System.

The objective is to ensure that the system is reliable, secure, accurate, and ready for deployment.

---

# 2. TESTING OBJECTIVES

The testing process aims to:

* Verify all functional requirements.
* Verify all non-functional requirements.
* Ensure data integrity.
* Validate business workflows.
* Detect defects before deployment.
* Confirm user acceptance.

---

# 3. TESTING PRINCIPLES

1. Testing begins during development.

2. Every module must be tested individually.

3. Integrated modules must be tested together.

4. Critical workflows receive priority.

5. Defects must be documented and resolved.

6. Testing evidence must be retained.

---

# 4. TESTING LEVELS

## 4.1 Unit Testing

Purpose:

Verify individual functions, classes, and modules.

Performed By:

Developers

Examples:

* Login validation
* Inventory quantity update
* Approval status update
* Purchase order calculation

---

## 4.2 Integration Testing

Purpose:

Verify interaction between modules.

Performed By:

Development Team

Examples:

* Request → Approval Workflow
* Approval → Purchase Order
* Purchase Order → Inventory
* Inventory → Reports

---

## 4.3 System Testing

Purpose:

Verify complete system behavior.

Performed By:

Testing Team

Examples:

* End-to-end procurement process
* Inventory tracking process
* User management process

---

## 4.4 User Acceptance Testing (UAT)

Purpose:

Verify that the system satisfies user expectations.

Performed By:

End Users

Examples:

* Procurement Officer testing
* Manager testing
* Administrator testing

---

# 5. TESTING TYPES

## Functional Testing

Verify business functionality.

Examples:

* Create Request
* Approve Request
* Create Supplier
* Receive Goods

---

## Database Testing

Verify data storage and integrity.

Examples:

* Foreign keys
* Constraints
* Cascading actions
* Transactions

---

## Security Testing

Verify protection against attacks.

Examples:

* Authentication
* Authorization
* Session Validation
* SQL Injection Protection
* CSRF Protection

---

## Performance Testing

Verify system responsiveness.

Examples:

* Dashboard Loading
* Report Generation
* Search Performance

---

## Usability Testing

Verify ease of use.

Examples:

* Navigation
* Form Design
* Error Messages

---

## Regression Testing

Verify existing functionality after changes.

Examples:

* Existing workflows after module updates

---

# 6. TEST ENVIRONMENT

## Software

PHP 8+

MySQL 8+

Apache

Laragon

Google Chrome

Microsoft Edge

Mozilla Firefox

---

## Database

Dedicated Test Database

Example:

film_studio_procurement_test

---

# 7. TEST DATA

The following sample records shall be maintained.

Users

* Administrator
* Procurement Officer
* Manager
* Staff

Suppliers

* Multiple Suppliers

Inventory

* Multiple Categories
* Various Stock Levels

Requests

* Draft
* Pending
* Approved
* Rejected

Purchase Orders

* Pending
* Completed

---

# 8. MODULE TEST CASES

## Authentication Module

### Test Case AUTH-001

Scenario:

Valid Login

Expected Result:

User successfully logs in.

Status:

Pass / Fail

---

### Test Case AUTH-002

Scenario:

Invalid Password

Expected Result:

Login denied.

Status:

Pass / Fail

---

## User Management Module

### Test Case USER-001

Scenario:

Create User

Expected Result:

User record created successfully.

---

### Test Case USER-002

Scenario:

Duplicate Email

Expected Result:

Validation error displayed.

---

## Procurement Request Module

### Test Case REQ-001

Scenario:

Create Request

Expected Result:

Request created successfully.

---

### Test Case REQ-002

Scenario:

Submit Request

Expected Result:

Status changes to Pending.

---

## Approval Workflow Module

### Test Case APR-001

Scenario:

Approve Request

Expected Result:

Request status updated.

---

### Test Case APR-002

Scenario:

Reject Request

Expected Result:

Request status becomes Rejected.

---

## Supplier Module

### Test Case SUP-001

Scenario:

Create Supplier

Expected Result:

Supplier saved successfully.

---

## Purchase Order Module

### Test Case PO-001

Scenario:

Create Purchase Order

Expected Result:

Purchase Order generated.

---

### Test Case PO-002

Scenario:

Receive Goods

Expected Result:

Inventory updated.

---

## Inventory Module

### Test Case INV-001

Scenario:

Create Inventory Item

Expected Result:

Item saved successfully.

---

### Test Case INV-002

Scenario:

Low Stock Detection

Expected Result:

Alert generated.

---

## Reporting Module

### Test Case REP-001

Scenario:

Generate Procurement Report

Expected Result:

Report displayed correctly.

---

## Audit Module

### Test Case AUD-001

Scenario:

Create Audit Log

Expected Result:

Audit entry recorded.

---

# 9. INTEGRATION TEST SCENARIOS

## IT-001

Request Creation → Approval Workflow

Expected:

Approval process begins.

---

## IT-002

Approval Workflow → Purchase Order

Expected:

Approved request generates PO.

---

## IT-003

Purchase Order → Inventory

Expected:

Received goods update inventory.

---

## IT-004

Inventory → Reports

Expected:

Reports reflect latest inventory.

---

# 10. SECURITY TEST SCENARIOS

## SEC-001

Unauthorized Access Attempt

Expected:

Access denied.

---

## SEC-002

Direct URL Access

Expected:

Redirect to login.

---

## SEC-003

SQL Injection Attempt

Expected:

Input rejected.

---

## SEC-004

Session Expiration

Expected:

User redirected to login.

---

# 11. PERFORMANCE TEST SCENARIOS

| Scenario          | Target       |
| ----------------- | ------------ |
| Login             | < 3 Seconds  |
| Dashboard Load    | < 5 Seconds  |
| Search Results    | < 3 Seconds  |
| Report Generation | < 10 Seconds |

---

# 12. DEFECT MANAGEMENT

Severity Levels

Critical

* System crash
* Data corruption
* Security vulnerability

High

* Core workflow failure

Medium

* Incorrect behavior

Low

* Cosmetic issues

---

# 13. TESTING DELIVERABLES

Test Plan

Test Cases

Test Results

Defect Reports

User Acceptance Report

Final Testing Report

---

# 14. ENTRY CRITERIA

Testing begins when:

* Development completed
* Database ready
* Test environment available

---

# 15. EXIT CRITERIA

Testing ends when:

✓ Critical defects resolved

✓ High defects resolved

✓ Acceptance testing passed

✓ Documentation updated

---

# 16. SUCCESS METRICS

| Metric                    | Target |
| ------------------------- | ------ |
| Functional Test Pass Rate | 100%   |
| Security Test Pass Rate   | 100%   |
| Critical Defects Open     | 0      |
| High Defects Open         | 0      |
| User Acceptance Rate      | ≥ 90%  |

---

# 17. TESTING PHASE SUMMARY

Phase 1

Unit Testing

Phase 2

Integration Testing

Phase 3

System Testing

Phase 4

User Acceptance Testing

Phase 5

Deployment Validation

---

Document Status:

Approved

Version:

1.0
