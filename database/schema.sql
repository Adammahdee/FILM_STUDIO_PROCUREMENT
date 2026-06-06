-- =====================================================
-- FILM STUDIO PROCUREMENT APPROVAL AND INVENTORY
-- MANAGEMENT SYSTEM
-- PRODUCTION SCHEMA
-- =====================================================

DROP DATABASE IF EXISTS film_studio_procurement;

CREATE DATABASE film_studio_procurement
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE film_studio_procurement;

-- =====================================================
-- USERS
-- =====================================================

CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,

username VARCHAR(50) NOT NULL UNIQUE,
email VARCHAR(100) NOT NULL UNIQUE,
password_hash VARCHAR(255) NOT NULL,

full_name VARCHAR(100) NOT NULL,

role ENUM(
    'admin',
    'manager',
    'procurement_officer',
    'department_head',
    'staff'
) NOT NULL DEFAULT 'staff',

department VARCHAR(100) NULL,
phone VARCHAR(30) NULL,

is_active BOOLEAN NOT NULL DEFAULT TRUE,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP

) ENGINE=InnoDB;

-- =====================================================
-- CATEGORIES
-- =====================================================

CREATE TABLE categories (
id INT AUTO_INCREMENT PRIMARY KEY,


name VARCHAR(100) NOT NULL UNIQUE,
description TEXT NULL,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

) ENGINE=InnoDB;

-- =====================================================
-- SUPPLIERS
-- =====================================================

CREATE TABLE suppliers (
id INT AUTO_INCREMENT PRIMARY KEY,

company_name VARCHAR(150) NOT NULL,

contact_person VARCHAR(100) NULL,
email VARCHAR(100) NULL,
phone VARCHAR(30) NULL,

address TEXT NULL,
website VARCHAR(255) NULL,

tax_id VARCHAR(50) NULL,
payment_terms VARCHAR(100) NULL,

rating DECIMAL(3,1) DEFAULT 0.0,

is_active BOOLEAN NOT NULL DEFAULT TRUE,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP

) ENGINE=InnoDB;

-- =====================================================
-- INVENTORY ITEMS
-- =====================================================

CREATE TABLE inventory_items (
id INT AUTO_INCREMENT PRIMARY KEY,

item_code VARCHAR(50) NOT NULL UNIQUE,

name VARCHAR(200) NOT NULL,
description TEXT NULL,

category_id INT NULL,
supplier_id INT NULL,

unit_of_measure VARCHAR(30)
    DEFAULT 'pcs',

unit_price DECIMAL(12,2)
    DEFAULT 0.00,

quantity_in_stock INT
    DEFAULT 0,

reorder_level INT
    DEFAULT 10,

reorder_quantity INT
    DEFAULT 50,

location VARCHAR(100) NULL,

status ENUM(
    'active',
    'inactive',
    'discontinued'
) DEFAULT 'active',

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP,

CONSTRAINT fk_inventory_category
    FOREIGN KEY (category_id)
    REFERENCES categories(id)
    ON DELETE SET NULL,

CONSTRAINT fk_inventory_supplier
    FOREIGN KEY (supplier_id)
    REFERENCES suppliers(id)
    ON DELETE SET NULL

) ENGINE=InnoDB;

-- =====================================================
-- PROCUREMENT REQUESTS
-- =====================================================

CREATE TABLE procurement_requests (
id INT AUTO_INCREMENT PRIMARY KEY,


request_number VARCHAR(30)
    NOT NULL UNIQUE,

requester_id INT NULL,

title VARCHAR(200)
    NOT NULL,

description TEXT NULL,
justification TEXT NULL,

estimated_total DECIMAL(12,2)
    DEFAULT 0.00,

priority ENUM(
    'low',
    'medium',
    'high',
    'urgent'
) DEFAULT 'medium',

status ENUM(
    'draft',
    'pending',
    'under_review',
    'approved',
    'rejected',
    'ordered',
    'received',
    'cancelled'
) DEFAULT 'draft',

required_date DATE NULL,
submitted_at TIMESTAMP NULL,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP,

CONSTRAINT fk_request_user
    FOREIGN KEY (requester_id)
    REFERENCES users(id)
    ON DELETE SET NULL

) ENGINE=InnoDB;

-- =====================================================
-- PROCUREMENT REQUEST ITEMS
-- =====================================================

CREATE TABLE procurement_request_items (
id INT AUTO_INCREMENT PRIMARY KEY,

request_id INT NOT NULL,

item_name VARCHAR(200) NOT NULL,
description TEXT NULL,

quantity INT NOT NULL,

unit_of_measure VARCHAR(30)
    DEFAULT 'pcs',

estimated_unit_price DECIMAL(12,2)
    DEFAULT 0.00,

estimated_total_price DECIMAL(12,2)
    DEFAULT 0.00,

inventory_item_id INT NULL,

CONSTRAINT fk_request_item_parent
    FOREIGN KEY (request_id)
    REFERENCES procurement_requests(id)
    ON DELETE CASCADE,

CONSTRAINT fk_request_item_inventory
    FOREIGN KEY (inventory_item_id)
    REFERENCES inventory_items(id)
    ON DELETE SET NULL

) ENGINE=InnoDB;

-- =====================================================
-- APPROVAL WORKFLOWS
-- =====================================================

CREATE TABLE approval_workflows (
id INT AUTO_INCREMENT PRIMARY KEY,

request_id INT NOT NULL,

approver_id INT NULL,

approval_level INT DEFAULT 1,

status ENUM(
    'pending',
    'approved',
    'rejected'
) DEFAULT 'pending',

comments TEXT NULL,

decided_at TIMESTAMP NULL,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

CONSTRAINT fk_workflow_request
    FOREIGN KEY (request_id)
    REFERENCES procurement_requests(id)
    ON DELETE CASCADE,

CONSTRAINT fk_workflow_user
    FOREIGN KEY (approver_id)
    REFERENCES users(id)
    ON DELETE SET NULL

) ENGINE=InnoDB;

-- =====================================================
-- PURCHASE ORDERS
-- =====================================================

CREATE TABLE purchase_orders (
id INT AUTO_INCREMENT PRIMARY KEY,

po_number VARCHAR(30)
    NOT NULL UNIQUE,

request_id INT NULL,

supplier_id INT NOT NULL,

created_by INT NULL,

order_date DATE NOT NULL,

expected_delivery_date DATE NULL,
actual_delivery_date DATE NULL,

subtotal DECIMAL(12,2)
    DEFAULT 0.00,

tax_amount DECIMAL(12,2)
    DEFAULT 0.00,

total_amount DECIMAL(12,2)
    DEFAULT 0.00,

status ENUM(
    'draft',
    'sent',
    'confirmed',
    'partially_received',
    'received',
    'cancelled'
) DEFAULT 'draft',

notes TEXT NULL,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ON UPDATE CURRENT_TIMESTAMP,

CONSTRAINT fk_po_request
    FOREIGN KEY (request_id)
    REFERENCES procurement_requests(id)
    ON DELETE SET NULL,

CONSTRAINT fk_po_supplier
    FOREIGN KEY (supplier_id)
    REFERENCES suppliers(id),

CONSTRAINT fk_po_creator
    FOREIGN KEY (created_by)
    REFERENCES users(id)

) ENGINE=InnoDB;

-- =====================================================
-- PURCHASE ORDER ITEMS
-- =====================================================

CREATE TABLE purchase_order_items (
id INT AUTO_INCREMENT PRIMARY KEY,

po_id INT NOT NULL,

inventory_item_id INT NULL,

item_name VARCHAR(200) NOT NULL,

quantity_ordered INT NOT NULL,

quantity_received INT DEFAULT 0,

unit_price DECIMAL(12,2) NOT NULL,

total_price DECIMAL(12,2) NOT NULL,

CONSTRAINT fk_po_item_parent
    FOREIGN KEY (po_id)
    REFERENCES purchase_orders(id)
    ON DELETE CASCADE,

CONSTRAINT fk_po_item_inventory
    FOREIGN KEY (inventory_item_id)
    REFERENCES inventory_items(id)
    ON DELETE SET NULL

) ENGINE=InnoDB;

-- =====================================================
-- INVENTORY TRANSACTIONS
-- =====================================================

CREATE TABLE inventory_transactions (
id INT AUTO_INCREMENT PRIMARY KEY,

inventory_item_id INT NOT NULL,

transaction_type ENUM(
    'receipt',
    'issue',
    'adjustment',
    'return',
    'transfer'
) NOT NULL,

reference_type VARCHAR(50) NULL,
reference_id INT NULL,

quantity INT NOT NULL,

unit_cost DECIMAL(12,2) NULL,
total_cost DECIMAL(12,2) NULL,

notes TEXT NULL,

performed_by INT NULL,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

CONSTRAINT fk_transaction_inventory
    FOREIGN KEY (inventory_item_id)
    REFERENCES inventory_items(id)
    ON DELETE CASCADE,

CONSTRAINT fk_transaction_user
    FOREIGN KEY (performed_by)
    REFERENCES users(id)
    ON DELETE SET NULL

) ENGINE=InnoDB;

-- =====================================================
-- NOTIFICATIONS
-- =====================================================

CREATE TABLE notifications (
id INT AUTO_INCREMENT PRIMARY KEY,

user_id INT NOT NULL,

title VARCHAR(200) NOT NULL,
message TEXT NULL,

type ENUM(
    'info',
    'warning',
    'success',
    'error'
) DEFAULT 'info',

is_read BOOLEAN DEFAULT FALSE,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

CONSTRAINT fk_notification_user
    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE

) ENGINE=InnoDB;

-- =====================================================
-- ACTIVITY LOGS
-- =====================================================

CREATE TABLE activity_logs (
id INT AUTO_INCREMENT PRIMARY KEY,


user_id INT NULL,

action VARCHAR(100) NOT NULL,

entity_type VARCHAR(100) NULL,
entity_id INT NULL,

details TEXT NULL,

ip_address VARCHAR(45) NULL,

created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

CONSTRAINT fk_activity_user
    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE SET NULL

) ENGINE=InnoDB;

-- =====================================================
-- INDEXES
-- =====================================================

CREATE INDEX idx_request_status
ON procurement_requests(status);

CREATE INDEX idx_request_priority
ON procurement_requests(priority);

CREATE INDEX idx_inventory_stock
ON inventory_items(quantity_in_stock);

CREATE INDEX idx_workflow_status
ON approval_workflows(status);

CREATE INDEX idx_po_status
ON purchase_orders(status);
