# NON-FUNCTIONAL REQUIREMENTS DOCUMENT

# Film Studio Procurement Approval and Inventory Management System

Version 1.0

---

# 1. INTRODUCTION

This document defines the non-functional requirements of the Film Studio Procurement Approval and Inventory Management System.

Non-functional requirements specify quality attributes, constraints, and performance expectations that the system must satisfy.

---

# 2. PERFORMANCE REQUIREMENTS

## NFR-001 Response Time

Requirement:

The system shall respond to normal user requests within 3 seconds.

Priority:

High

---

## NFR-002 Dashboard Loading

Requirement:

The dashboard shall load within 5 seconds under normal operating conditions.

Priority:

High

---

## NFR-003 Search Performance

Requirement:

Inventory, suppliers, and procurement request searches shall return results within 3 seconds.

Priority:

Medium

---

## NFR-004 Report Generation

Requirement:

Standard reports shall be generated within 10 seconds.

Priority:

Medium

---

# 3. SECURITY REQUIREMENTS

## NFR-005 Authentication

Requirement:

Only authenticated users shall access protected system resources.

Priority:

Critical

---

## NFR-006 Password Security

Requirement:

Passwords shall be stored using secure hashing algorithms.

Implementation:

PHP password_hash()

Priority:

Critical

---

## NFR-007 Session Security

Requirement:

Sessions shall be validated on every protected request.

Priority:

Critical

---

## NFR-008 Authorization

Requirement:

Role-based access control shall restrict access to authorized users only.

Priority:

Critical

---

## NFR-009 SQL Injection Protection

Requirement:

All database queries shall use prepared statements.

Priority:

Critical

---

## NFR-010 Cross-Site Scripting Protection

Requirement:

User-generated output shall be escaped before display.

Priority:

Critical

---

## NFR-011 CSRF Protection

Requirement:

Sensitive forms shall implement CSRF protection.

Priority:

High

---

# 4. RELIABILITY REQUIREMENTS

## NFR-012 System Availability

Requirement:

The system shall maintain 99% availability during operational hours.

Priority:

Medium

---

## NFR-013 Data Integrity

Requirement:

All critical transactions shall preserve database consistency.

Priority:

Critical

---

## NFR-014 Transaction Management

Requirement:

Multi-step business operations shall use database transactions.

Examples:

* Request Approval
* Purchase Order Creation
* Goods Receipt

Priority:

Critical

---

# 5. MAINTAINABILITY REQUIREMENTS

## NFR-015 Modular Design

Requirement:

The system shall be developed using modular architecture.

Priority:

High

---

## NFR-016 Code Documentation

Requirement:

Major modules, classes, and functions shall be documented.

Priority:

Medium

---

## NFR-017 Coding Standards

Requirement:

Development shall follow documented coding standards.

Priority:

High

---

## NFR-018 Database Documentation

Requirement:

Database changes shall be documented before implementation.

Priority:

High

---

# 6. USABILITY REQUIREMENTS

## NFR-019 User Interface Consistency

Requirement:

The system shall use a consistent user interface across all modules.

Priority:

Medium

---

## NFR-020 Navigation Simplicity

Requirement:

Users shall access major functions within three clicks.

Priority:

Medium

---

## NFR-021 Error Messages

Requirement:

The system shall provide meaningful and user-friendly error messages.

Priority:

Medium

---

## NFR-022 Form Validation

Requirement:

The system shall validate required fields before submission.

Priority:

High

---

# 7. SCALABILITY REQUIREMENTS

## NFR-023 User Growth

Requirement:

The system shall support future growth in user accounts without architectural redesign.

Priority:

Medium

---

## NFR-024 Inventory Growth

Requirement:

The system shall support thousands of inventory records.

Priority:

Medium

---

## NFR-025 Transaction Growth

Requirement:

The system shall support large volumes of inventory transactions and audit logs.

Priority:

Medium

---

# 8. COMPATIBILITY REQUIREMENTS

## NFR-026 Browser Compatibility

Requirement:

The system shall function correctly on modern browsers.

Supported Browsers:

* Google Chrome
* Microsoft Edge
* Mozilla Firefox

Priority:

High

---

## NFR-027 Database Compatibility

Requirement:

The system shall support MySQL 8+.

Priority:

High

---

## NFR-028 Server Compatibility

Requirement:

The system shall run on standard PHP hosting environments.

Priority:

High

---

# 9. BACKUP AND RECOVERY REQUIREMENTS

## NFR-029 Database Backup

Requirement:

Database backups shall be performed regularly.

Priority:

High

---

## NFR-030 Recovery Capability

Requirement:

The system shall support restoration from backups.

Priority:

High

---

# 10. AUDIT REQUIREMENTS

## NFR-031 Activity Tracking

Requirement:

Critical user activities shall be recorded.

Priority:

High

---

## NFR-032 Change Accountability

Requirement:

The system shall identify the user responsible for major actions.

Priority:

High

---

# 11. DATA QUALITY REQUIREMENTS

## NFR-033 Required Fields

Requirement:

Mandatory information shall not be left blank.

Priority:

High

---

## NFR-034 Referential Integrity

Requirement:

Foreign key constraints shall enforce valid relationships.

Priority:

Critical

---

## NFR-035 Unique Records

Requirement:

Unique business identifiers shall be enforced.

Examples:

* username
* email
* request_number
* po_number
* item_code

Priority:

High

---

# 12. ACCESSIBILITY REQUIREMENTS

## NFR-036 Readability

Requirement:

Text shall remain readable across supported devices and resolutions.

Priority:

Medium

---

## NFR-037 Responsive Design

Requirement:

The interface shall adapt to desktop and tablet screen sizes.

Priority:

Medium

---

# 13. LEGAL AND COMPLIANCE REQUIREMENTS

## NFR-038 Data Protection

Requirement:

User information shall be protected from unauthorized access.

Priority:

Critical

---

## NFR-039 Audit Trail Retention

Requirement:

Audit records shall be retained for accountability and reporting purposes.

Priority:

High

---

# 14. SYSTEM CONSTRAINTS

## Technology Constraints

Backend:

* PHP 8+

Frontend:

* HTML5
* CSS3
* Bootstrap 5
* JavaScript

Database:

* MySQL 8+

Environment:

* Laragon Development Environment

---

# 15. QUALITY TARGETS

| Quality Attribute       | Target              |
| ----------------------- | ------------------- |
| Authentication Security | High                |
| Data Integrity          | High                |
| Availability            | 99%                 |
| Dashboard Load Time     | < 5 Seconds         |
| Search Response Time    | < 3 Seconds         |
| Report Generation       | < 10 Seconds        |
| Browser Compatibility   | Modern Browsers     |
| Database Integrity      | 100% FK Enforcement |

---

# 16. SUMMARY

Total Non-Functional Requirements:

39

Critical Areas:

* Security
* Data Integrity
* Authorization
* Reliability

Quality Objectives:

* Secure
* Reliable
* Maintainable
* Scalable
* Usable

System Version:

1.0
