-- Users data
INSERT INTO users (user_id, password) VALUES ('alice', 'cs2102');
INSERT INTO users (user_id, password) VALUES ('tom', 'cs2102');
INSERT INTO users (user_id, password) VALUES ('samy', 'cs2102');
INSERT INTO users (user_id, password) VALUES ('sully', 'cs2102');
INSERT INTO users (user_id, password) VALUES ('bob', 'cs2102');
INSERT INTO users (user_id, password) VALUES ('Seng', 'cs2102');
INSERT INTO users (user_id, password) VALUES ('charlene', 'cs2102');
INSERT INTO users (user_id, password) VALUES ('sarah', 'cs2102');
INSERT INTO users (user_id, password) VALUES ('Lee', 'cs2102');
INSERT INTO users (user_id, password) VALUES ('Nancy', 'cs2102');
INSERT INTO users (user_id, is_admin, password) VALUES ('Caidi', true, 'cs2102');
INSERT INTO users (user_id, is_admin, password) VALUES ('Wanqing', true, 'cs2102');
INSERT INTO users (user_id, is_admin, password) VALUES ('Gerald', true, 'cs2102');
INSERT INTO users (user_id, is_admin, password) VALUES ('Siang', true, 'cs2102');

-- Task_managed_by
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000001', 'alice', 'bidding', '2018-12-30', '18:00', '20:00', 'War Wash Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000002', 'alice', 'bidding', '2018-11-20', '08:00', '12:00', 'Dusting Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000003', 'samy', 'bidding', '2018-11-21', '06:00', '07:00', 'Breakfast Delivery Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000004', 'samy', 'bidding', '2018-11-21', '12:00', '13:00', 'Lunch Delivery Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000005', 'samy', 'bidding', '2018-11-21', '18:00', '19:00', 'Dinner Delivery Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000006', 'samy', 'bidding', '2018-11-21', '20:00', '22:00', 'Supper Delivery Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000007', 'Seng', 'bidding', '2018-10-25', '07:00', '09:30', 'Parcel Delivery Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000008', 'tom', 'bidding', '2018-11-21', '10:00', '22:00', 'Plumbing Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000009', 'alice', 'bidding', '2018-10-15', '08:00', '20:00', 'Vacuuming Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000010', 'alice', 'bidding', '2018-11-29', '07:00', '09:00', 'Dish Washing Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000011', 'alice', 'bidding', '2018-11-21', '11:00', '12:00', 'Bathroom Washing Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000012', 'samy', 'bidding', '2018-11-21', '12:00', '13:00', 'Lunch Delivery Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000013', 'samy', 'bidding', '2018-11-21', '18:00', '19:00', 'Dinner Delivery Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000014', 'samy', 'bidding', '2018-11-21', '20:00', '22:00', 'Supper Delivery Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000015', 'sully', 'bidding', '2018-10-25', '16:00', '18:00', 'One on One Tuition Slot 1');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000016', 'sully', 'bidding', '2018-10-25', '18:30', '20:30', 'One on One Tuition Slot 2');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000017', 'sully', 'bidding', '2018-10-25', '21:00', '23:00', 'One on One Tuition Slot 3');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000018', 'sully', 'bidding', '2018-11-22', '08:00', '22:00', 'Revision Online');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000019', 'tom', 'bidding', '2018-11-20', '08:00', '22:00', 'Plumbing Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000020', 'tom', 'bidding', '2018-11-22', '08:00', '19:00', 'Cables Running Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000051', 'tom', 'bidding', '2018-11-23', '08:00', '18:00', 'Roof Leakage Repair');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000021', 'tom', 'bidding', '2018-11-25', '08:00', '18:00', 'Lift Maintanence');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000022', 'alice', 'bidding', '2018-11-13', '08:00', '13:00', 'Laundry Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000024', 'alice', 'bidding', '2018-10-25', '21:00', '23:00', 'Mopping Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000023', 'charlene', 'bidding', '2018-10-26', '00:00', '23:59', 'Full Day Home Pet Visit');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000025', 'sarah', 'bidding', '2018-11-22', '08:00', '18:00', 'Pet Taxi');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000026', 'sarah', 'bidding', '2018-11-23', '08:00', '18:00', 'Pet Taxi');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000027', 'sarah', 'bidding', '2018-11-24', '08:00', '18:00', 'Pet Food Delivery');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000028', 'Lee', 'bidding', '2018-11-20', '08:00', '12:00', 'Painting Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000029', 'Lee', 'bidding', '2018-11-20', '13:00', '18:00', 'Painting Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000030', 'Nancy', 'bidding', '2018-10-25', '08:00', '18:00', 'Daycare');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000031', 'Nancy', 'bidding', '2018-10-25', '18:30', '20:30', 'Pick up children');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000032', 'Seng', 'bidding', '2018-10-25', '09:00', '23:00', 'Private Hire Cab Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000036', 'Seng', 'bidding', '2018-11-22', '09:00', '22:00', 'Private Hire Cab Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000033', 'sarah', 'bidding', '2018-11-23', '08:00', '18:00', 'Pet Food Delivery');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000034', 'sarah', 'bidding', '2018-11-24', '08:00', '18:00', 'Pet Food Delivery');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000035', 'sarah', 'bidding', '2018-11-22', '08:00', '18:00', 'Pet Food Delivery');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000037', 'bob', 'bidding', '2018-12-20', '08:00', '18:00', 'Design Consultation Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000038', 'bob', 'bidding', '2018-12-25', '08:00', '18:00', 'A&A Consultation');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000039', 'Lee', 'bidding', '2018-12-25', '08:30', '12:30', 'Touch up paint Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000040', 'Seng', 'bidding', '2018-12-25', '09:00', '23:00', 'Private Hire Cab Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000041', 'Seng', 'bidding', '2018-12-22', '09:00', '22:00', 'Private Hire Cab Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000042', 'sarah', 'bidding', '2018-12-23', '08:00', '18:00', 'Pet Food Delivery');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000043', 'sarah', 'bidding', '2018-12-24', '08:00', '18:00', 'Pet Food Delivery');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000044', 'sarah', 'bidding', '2018-12-22', '08:00', '18:00', 'Pet Food Delivery');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000045', 'Lee', 'bidding', '2018-12-20', '13:00', '18:00', 'Painting Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000046', 'Nancy', 'bidding', '2018-12-25', '08:00', '18:00', 'Daycare');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000047', 'Nancy', 'bidding', '2018-12-25', '18:30', '20:30', 'Pick up children');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000048', 'Seng', 'bidding', '2018-12-25', '09:00', '23:00', 'Private Hire Cab Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000049', 'Seng', 'bidding', '2018-12-22', '09:00', '22:00', 'Private Hire Cab Services');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000050', 'sarah', 'bidding', '2018-12-23', '08:00', '18:00', 'Pet Food Delivery');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000052', 'charlene', 'bidding', '2018-12-25', '08:00', '08:30', 'Pet Checkup');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000053', 'charlene', 'bidding', '2018-12-25', '08:30', '09:00', 'Pet Checkup');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000054', 'charlene', 'bidding', '2018-12-25', '09:00', '09:30', 'Pet Checkup');
INSERT INTO task_managed_by (task_id, user_id, status, date, start_time, end_time, description)
	VALUES ('00000055', 'charlene', 'bidding', '2018-12-26', '09:30', '12:00', 'Pet Surgery');





