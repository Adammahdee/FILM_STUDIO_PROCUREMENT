USE film_studio_procurement;

-- =====================================================
-- USERS
-- Password Hash = password
-- =====================================================

INSERT INTO users (
username,
email,
password_hash,
full_name,
role,
department
)
VALUES
(
'admin',
'[admin@filmstudio.com](mailto:admin@filmstudio.com)',
'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
'System Administrator',
'admin',
'Administration'
),
(
'manager',
'[manager@filmstudio.com](mailto:manager@filmstudio.com)',
'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
'Production Manager',
'manager',
'Production'
),
(
'procurement',
'[procurement@filmstudio.com](mailto:procurement@filmstudio.com)',
'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
'Procurement Officer',
'procurement_officer',
'Procurement'
),
(
'department_head',
'[departmenthead@filmstudio.com](mailto:departmenthead@filmstudio.com)',
'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
'Department Head',
'department_head',
'Production'
);

-- =====================================================
-- CATEGORIES
-- =====================================================

INSERT INTO categories (
name,
description
)
VALUES
(
'Camera Equipment',
'Cameras, lenses and accessories'
),
(
'Lighting Equipment',
'Studio lights and accessories'
),
(
'Audio Equipment',
'Microphones and recording equipment'
),
(
'Production Supplies',
'General production consumables'
),
(
'Props and Set Design',
'Props and stage materials'
),
(
'Transportation',
'Vehicles and transportation support'
);

-- =====================================================
-- SUPPLIERS
-- =====================================================

INSERT INTO suppliers (
company_name,
contact_person,
email,
phone,
address,
website,
payment_terms,
rating
)
VALUES
(
'CineGear Pro',
'John Smith',
'[john@cinegearpro.com](mailto:john@cinegearpro.com)',
'+1-555-0101',
'Hollywood, California',
'https://www.cinegearpro.com',
'Net 30',
4.8
),
(
'Studio Lights Inc',
'Sarah Johnson',
'[sarah@studiolights.com](mailto:sarah@studiolights.com)',
'+1-555-0102',
'Burbank, California',
'https://www.studiolights.com',
'Net 30',
4.5
),
(
'Sound Masters',
'Mike Davis',
'[mike@soundmasters.com](mailto:mike@soundmasters.com)',
'+1-555-0103',
'Los Angeles, California',
'https://www.soundmasters.com',
'Net 15',
4.7
),
(
'Film Supply Depot',
'Lisa Wilson',
'[lisa@filmsupplydepot.com](mailto:lisa@filmsupplydepot.com)',
'+1-555-0104',
'Santa Monica, California',
'https://www.filmsupplydepot.com',
'Net 30',
4.4
);

-- =====================================================
-- INVENTORY ITEMS
-- =====================================================

INSERT INTO inventory_items (
item_code,
name,
description,
category_id,
supplier_id,
unit_of_measure,
unit_price,
quantity_in_stock,
reorder_level,
reorder_quantity,
location
)
VALUES
(
'CAM-001',
'ARRI Alexa Mini LF',
'Large format cinema camera',
1,
1,
'unit',
45000.00,
3,
2,
2,
'Camera Room A'
),
(
'CAM-002',
'Canon C500 Mark II',
'Cinema camera',
1,
1,
'unit',
15999.00,
5,
2,
2,
'Camera Room A'
),
(
'LIGHT-001',
'Aputure 600D Pro',
'LED Light',
2,
2,
'unit',
1890.00,
8,
4,
4,
'Lighting Store'
),
(
'LIGHT-002',
'Aputure 300X',
'Bi-color LED Light',
2,
2,
'unit',
1090.00,
10,
5,
5,
'Lighting Store'
),
(
'AUDIO-001',
'Sennheiser MKH 416',
'Shotgun Microphone',
3,
3,
'unit',
999.00,
6,
2,
2,
'Audio Room'
),
(
'PROP-001',
'Director Chair',
'Production chair',
5,
4,
'unit',
120.00,
20,
5,
10,
'Prop Store'
);

-- =====================================================
-- PROCUREMENT REQUESTS
-- =====================================================

INSERT INTO procurement_requests (
request_number,
requester_id,
title,
description,
justification,
estimated_total,
priority,
status,
required_date
)
VALUES
(
'PR-2026-0001',
3,
'Purchase Additional LED Lights',
'Additional lighting for studio expansion',
'New production stage requires more lighting',
5000.00,
'high',
'pending',
'2026-07-15'
),
(
'PR-2026-0002',
3,
'Purchase Audio Equipment',
'New microphones required',
'Replacement of aging equipment',
2500.00,
'medium',
'approved',
'2026-07-20'
);

-- =====================================================
-- PROCUREMENT REQUEST ITEMS
-- =====================================================

INSERT INTO procurement_request_items (
request_id,
item_name,
quantity,
estimated_unit_price,
estimated_total_price
)
VALUES
(
1,
'Aputure 600D Pro',
2,
1890.00,
3780.00
),
(
2,
'Sennheiser MKH 416',
2,
999.00,
1998.00
);

-- =====================================================
-- APPROVAL WORKFLOW
-- =====================================================

INSERT INTO approval_workflows (
request_id,
approver_id,
approval_level,
status,
comments
)
VALUES
(
1,
2,
1,
'pending',
'Awaiting manager approval'
),
(
2,
2,
1,
'approved',
'Approved for procurement'
);

-- =====================================================
-- PURCHASE ORDERS
-- =====================================================

INSERT INTO purchase_orders (
po_number,
request_id,
supplier_id,
created_by,
order_date,
subtotal,
tax_amount,
total_amount,
status
)
VALUES
(
'PO-2026-0001',
2,
3,
3,
CURDATE(),
1998.00,
0.00,
1998.00,
'confirmed'
);

-- =====================================================
-- PURCHASE ORDER ITEMS
-- =====================================================

INSERT INTO purchase_order_items (
po_id,
inventory_item_id,
item_name,
quantity_ordered,
quantity_received,
unit_price,
total_price
)
VALUES
(
1,
5,
'Sennheiser MKH 416',
2,
2,
999.00,
1998.00
);

-- =====================================================
-- NOTIFICATIONS
-- =====================================================

INSERT INTO notifications (
user_id,
title,
message,
type
)
VALUES
(
2,
'Procurement Approval Required',
'A procurement request requires your approval.',
'warning'
),
(
3,
'Purchase Order Created',
'Purchase order PO-2026-0001 has been created.',
'success'
);

-- =====================================================
-- ACTIVITY LOGS
-- =====================================================

INSERT INTO activity_logs (
user_id,
action,
entity_type,
entity_id,
details,
ip_address
)
VALUES
(
1,
'SYSTEM_SETUP',
'DATABASE',
1,
'Initial seed data loaded',
'127.0.0.1'
);
