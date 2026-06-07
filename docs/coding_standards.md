# CODING STANDARDS

# Film Studio Procurement Approval and Inventory Management System

Version 1.0

---

# 1. PURPOSE

This document defines the coding, database, security, documentation, and version control standards that must be followed throughout the development of the Film Studio Procurement Approval and Inventory Management System.

These standards ensure:

* Consistency
* Maintainability
* Security
* Scalability
* Readability

---

# 2. GENERAL DEVELOPMENT PRINCIPLES

All code must be:

* Clean
* Readable
* Modular
* Reusable
* Secure
* Documented

Developers shall prioritize:

1. Correctness
2. Security
3. Maintainability
4. Performance

---

# 3. PROJECT DIRECTORY STANDARDS

## Root Structure

FILM_STUDIO_PROCUREMENT/

config/

database/

docs/

public/

src/

templates/

tests/

vendor/

---

## Module Structure

Example:

src/

Authentication/

Dashboard/

Procurement/

Approval/

Inventory/

Suppliers/

PurchaseOrders/

Reports/

Notifications/

Audit/

Settings/

---

## Rules

1. One responsibility per folder.

2. Avoid mixing unrelated functionality.

3. Business logic must remain outside templates.

---

# 4. FILE NAMING STANDARDS

## PHP Files

Use:

PascalCase

Examples:

AuthenticationController.php

InventoryService.php

PurchaseOrderRepository.php

ApprovalWorkflow.php

---

## Template Files

Use:

snake_case

Examples:

login.php

dashboard.php

create_request.php

edit_supplier.php

---

## Documentation Files

Use:

snake_case

Examples:

architecture.md

coding_standards.md

implementation_plan.md

---

# 5. PHP CODING STANDARDS

## PHP Version

Minimum:

PHP 8+

---

## Opening Tags

Use:

<?php

Never use:

<?

---

## Strict Typing

Preferred:

declare(strict_types=1);

---

## Variable Naming

Use:

camelCase

Examples:

$userId

$requestNumber

$totalAmount

$approvalStatus

---

## Constant Naming

Use:

UPPER_CASE

Examples:

APP_NAME

DB_HOST

MAX_UPLOAD_SIZE

---

## Method Naming

Use:

camelCase

Examples:

createRequest()

approveRequest()

generatePurchaseOrder()

---

## Class Naming

Use:

PascalCase

Examples:

InventoryService

RequestController

ApprovalManager

---

# 6. CODE STRUCTURE STANDARDS

Maximum Function Length:

50 Lines

Preferred:

20–30 Lines

---

Maximum File Length:

500 Lines

Preferred:

300 Lines

---

Single Responsibility Principle

Each class should have one primary responsibility.

---

# 7. DATABASE NAMING STANDARDS

## Database Name

film_studio_procurement

---

## Table Naming

Use:

snake_case

Plural nouns

Examples:

users

suppliers

inventory_items

procurement_requests

purchase_orders

inventory_transactions

---

## Column Naming

Use:

snake_case

Examples:

user_id

request_number

supplier_id

created_at

updated_at

---

## Primary Keys

Format:

table_name_singular_id

Examples:

user_id

supplier_id

request_id

purchase_order_id

---

## Foreign Keys

Format:

referenced_table_singular_id

Examples:

user_id

supplier_id

request_id

item_id

---

# 8. SQL STANDARDS

## Keywords

Use uppercase.

Example:

SELECT

FROM

WHERE

ORDER BY

GROUP BY

---

## Indentation

Example:

SELECT
    user_id,
    full_name
FROM users
WHERE role = 'ADMIN';

---

## Avoid SELECT *

Always specify required columns.

Bad:

SELECT *
FROM users;

Good:

SELECT
    user_id,
    full_name,
    email
FROM users;

---

## Use Foreign Keys

All relationships must be enforced.

---

## Use Transactions

Required for:

- Approvals
- Purchase Orders
- Inventory Updates

---

# 9. SECURITY STANDARDS

## Authentication

Passwords must be hashed.

Use:

password_hash()

password_verify()

---

## SQL Injection Prevention

Always use prepared statements.

Example:

$stmt = $pdo->prepare(
    "SELECT * FROM users
     WHERE email = ?"
);

---

## Output Escaping

Always escape user-generated output.

Example:

htmlspecialchars(
    $userInput,
    ENT_QUOTES,
    'UTF-8'
);

---

## Session Validation

Validate session on every protected page.

---

## CSRF Protection

Required for:

- Forms
- Updates
- Deletes
- Approvals

---

## Authorization

Validate role permissions before processing.

---

# 10. ERROR HANDLING STANDARDS

Use:

try/catch

Example:

try {

    $stmt->execute();

} catch (PDOException $e) {

    error_log(
        $e->getMessage()
    );

}

---

## User Messages

Do not expose:

- SQL Queries
- Stack Traces
- Internal Errors

---

# 11. LOGGING STANDARDS

All critical actions must be logged.

Examples:

- Login
- Logout
- Request Creation
- Approval
- Rejection
- Purchase Order Creation
- Inventory Update

---

## Log Contents

User

Action

Module

Timestamp

Details

---

# 12. DOCUMENTATION STANDARDS

All major classes require:

Purpose

Parameters

Return Values

Dependencies

Example:

/**
 * Creates procurement request.
 *
 * @param array $data
 * @return int
 */

---

# 13. HTML STANDARDS

Use semantic HTML.

Examples:

<header>

<nav>

<main>

<section>

<footer>

---

Avoid excessive nested divs.

---

# 14. CSS STANDARDS

Use:

kebab-case

Examples:

dashboard-card

request-table

approval-status

---

Avoid inline styles.

Use external stylesheets.

---

# 15. JAVASCRIPT STANDARDS

Use:

camelCase

Examples:

loadDashboard()

submitRequest()

updateInventory()

---

Avoid inline JavaScript.

Use separate JS files.

---

# 16. GIT STANDARDS

## Branch Naming

feature/authentication

feature/inventory

feature/procurement

bugfix/login

bugfix/dashboard

---

## Commit Message Format

Type: Description

Examples:

feat: add authentication module

feat: implement inventory management

fix: resolve approval workflow bug

refactor: simplify dashboard queries

docs: update architecture documentation

test: add inventory test cases

---

# 17. TESTING STANDARDS

Every module must include:

- Positive Tests
- Negative Tests
- Boundary Tests

---

Critical workflows require:

- Integration Tests
- User Acceptance Tests

---

# 18. CODE REVIEW CHECKLIST

Before merging:

✓ Code compiles

✓ Naming conventions followed

✓ Security validated

✓ Documentation updated

✓ Tests completed

✓ No duplicate logic

✓ No hardcoded credentials

✓ Foreign keys maintained

---

# 19. PROHIBITED PRACTICES

Do NOT:

✗ Use SELECT *

✗ Hardcode passwords

✗ Store plaintext passwords

✗ Disable foreign keys permanently

✗ Mix business logic with presentation

✗ Duplicate code unnecessarily

✗ Ignore exceptions

✗ Bypass authorization checks

---

# 20. PROJECT-SPECIFIC STANDARDS

Database Naming Convention:

Use underscores (_) consistently.

Examples:

procurement_requests

purchase_order_items

inventory_transactions

approval_workflows

---

Documentation First Rule

Before implementing:

1. Architecture updated
2. Database updated
3. Module documented
4. Development begins

---

# 21. DEFINITION OF DONE

A task is complete when:

✓ Functionality implemented

✓ Security validated

✓ Database updated

✓ Documentation updated

✓ Testing completed

✓ Code reviewed

✓ Commit created

---

Document Status:

Approved

Version:

1.0
