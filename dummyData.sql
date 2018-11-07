-- Users data
INSERT INTO users (user_id, password) VALUES ('alice', '63be1f98cdf39355c37e5e6196207e7e');
INSERT INTO users (user_id, password) VALUES ('tom', '63be1f98cdf39355c37e5e6196207e7e');
INSERT INTO users (user_id, password) VALUES ('samy', '63be1f98cdf39355c37e5e6196207e7e');
INSERT INTO users (user_id, password) VALUES ('sully', '63be1f98cdf39355c37e5e6196207e7e');
INSERT INTO users (user_id, password) VALUES ('bob', '63be1f98cdf39355c37e5e6196207e7e');
INSERT INTO users (user_id, password) VALUES ('Seng', '63be1f98cdf39355c37e5e6196207e7e');
INSERT INTO users (user_id, password) VALUES ('charlene', '63be1f98cdf39355c37e5e6196207e7e');
INSERT INTO users (user_id, password) VALUES ('sarah', '63be1f98cdf39355c37e5e6196207e7e');
INSERT INTO users (user_id, password) VALUES ('Lee', '63be1f98cdf39355c37e5e6196207e7e');
INSERT INTO users (user_id, password) VALUES ('Nancy', '63be1f98cdf39355c37e5e6196207e7e');
INSERT INTO users (user_id, is_admin, password) VALUES ('Caidi', true, '63be1f98cdf39355c37e5e6196207e7e');
INSERT INTO users (user_id, is_admin, password) VALUES ('Wanqing', true, '63be1f98cdf39355c37e5e6196207e7e');
INSERT INTO users (user_id, is_admin, password) VALUES ('Gerald', true, '63be1f98cdf39355c37e5e6196207e7e');
INSERT INTO users (user_id, is_admin, password) VALUES ('Siang', true, '63be1f98cdf39355c37e5e6196207e7e');

-- task_managed_by
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000001', 'War Wash Services', 'alice', 'no_bids', '2018-12-30', '18:00', '20:00', 'Washing of car @ CP13');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000002', 'Dusting Services', 'alice', 'no_bids', '2018-11-20', '08:00', '12:00', 'Cleaning services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time)
	VALUES ('00000003', 'Breakfast Delivery Services', 'samy', 'no_bids', '2018-11-21', '06:00', '07:00');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time)
	VALUES ('00000004', 'Lunch Delivery Services', 'samy', 'no_bids', '2018-11-21', '12:00', '13:00');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000005', 'Dinner Delivery Services', 'samy', 'no_bids', '2018-11-21', '18:00', '19:00', 'Dinner Delivery Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000006', 'Supper Delivery Services', 'samy', 'no_bids', '2018-11-21', '20:00', '22:00', 'Supper Delivery Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000007', 'Parcel Delivery Services', 'Seng', 'no_bids', '2018-12-30', '07:00', '09:30', 'Parcel Delivery Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000008', 'Plumbing Services', 'tom', 'no_bids', '2018-11-21', '10:00', '22:00', 'Plumbing Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000009', 'Vacuuming Services', 'alice', 'no_bids', '2018-12-29', '08:00', '20:00', 'Vacuuming Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000010', 'Dish Washing Services', 'alice', 'no_bids', '2019-01-01', '07:00', '09:00', 'Dish Washing Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000011', 'Bathroom Washing Services', 'alice', 'no_bids', '2018-11-21', '11:00', '12:00', 'Bathroom Washing Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000012', 'Lunch Delivery Services', 'samy', 'no_bids', '2018-11-21', '12:00', '13:00', 'Lunch Delivery Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000013', 'Dinner Delivery Services', 'samy', 'no_bids', '2018-11-21', '18:00', '19:00', 'Dinner Delivery Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000014', 'Supper Delivery Services', 'samy', 'no_bids', '2018-11-21', '20:00', '22:00', 'Supper Delivery Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000015', 'One on One Tuition', 'sully', 'no_bids', '2019-01-02', '16:00', '18:00', 'Slot 1');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000016', 'One on One Tuition', 'sully', 'no_bids', '2019-01-02', '18:30', '20:30', 'Slot 2');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000017', 'One on One Tuition', 'sully', 'no_bids', '2019-01-02', '21:00', '23:00', 'Slot 3');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000018', 'Online Tuition', 'sully', 'no_bids', '2018-11-22', '08:00', '22:00', 'Revision Online');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000019', 'Plumbing Services', 'tom', 'no_bids', '2018-11-20', '08:00', '22:00', 'Tap, Hose, Bathroom, Basin');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000020', 'Electrician Contractor', 'tom', 'no_bids', '2018-11-22', '08:00', '19:00', 'Cables Running Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000051', 'Roof Leakage', 'tom', 'no_bids', '2018-11-23', '08:00', '18:00', 'Roof Leakage Repair');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000021', 'Maintain lift', 'tom', 'no_bids', '2018-11-25', '08:00', '18:00', 'Lift Maintanence');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000022', 'Laundry', 'alice', 'no_bids', '2019-01-02', '08:00', '13:00', 'Laundry Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000024', 'Mopping', 'alice', 'no_bids', '2019-01-02', '21:00', '23:00', 'Mopping Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000023', 'Home Pet Consultation', 'charlene', 'no_bids', '2019-01-05', '00:00', '23:59', 'Full Day Home Pet Visit');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000025', 'Taxi for Pets', 'sarah', 'no_bids', '2018-11-22', '08:00', '18:00', 'Pet Taxi');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000026', 'Taxi for Pets', 'sarah', 'no_bids', '2018-11-23', '08:00', '18:00', 'Pet Taxi');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000027', 'Food for Pets', 'sarah', 'no_bids', '2018-11-24', '08:00', '18:00', 'Pet Food Delivery');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000028', 'Painter for Hire', 'Lee', 'no_bids', '2018-11-20', '08:00', '12:00', 'Morning slot');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000029', 'Painter for Hire', 'Lee', 'no_bids', '2018-11-20', '13:00', '18:00', 'Afternoon slot');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000030', 'Daycare for children', 'Nancy', 'no_bids', '2019-01-02', '08:00', '18:00', 'Daycare');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000031', 'Pick up service', 'Nancy', 'no_bids', '2019-01-02', '18:30', '20:30', 'Pick up children');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000032', 'Private cab', 'Seng', 'no_bids', '2019-01-03', '09:00', '23:00', 'Private Hire Cab Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000036', 'Private cab', 'Seng', 'no_bids', '2018-11-22', '09:00', '22:00', 'Private Hire Cab Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000033', 'Food for pets', 'sarah', 'no_bids', '2018-11-23', '08:00', '18:00', 'Pet Food Delivery');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000034', 'Food for pets', 'sarah', 'no_bids', '2018-11-24', '08:00', '18:00', 'Pet Food Delivery');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000035', 'Food for pets', 'sarah', 'no_bids', '2018-11-22', '08:00', '18:00', 'Pet Food Delivery');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000037', 'Interior Design', 'bob', 'no_bids', '2018-12-20', '08:00', '18:00', 'Design Consultation Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000038', 'A&A consultation', 'bob', 'no_bids', '2018-12-25', '08:00', '18:00', 'A&A Consultation');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000039', 'Painting (Touch up)', 'Lee', 'no_bids', '2018-12-25', '08:30', '12:30', 'Touch up paint Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000040', 'Private Cab', 'Seng', 'no_bids', '2018-12-25', '09:00', '23:00', 'Private Hire Cab Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000041', 'Private Cab', 'Seng', 'no_bids', '2018-12-22', '09:00', '22:00', 'Private Hire Cab Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000042', 'Pet food for sale', 'sarah', 'no_bids', '2018-12-23', '08:00', '18:00', 'Pet Food Delivery');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000043', 'Pet food for sale', 'sarah', 'no_bids', '2018-12-24', '08:00', '18:00', 'Pet Food Delivery');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000044', 'Pet food for sale', 'sarah', 'no_bids', '2018-12-22', '08:00', '18:00', 'Pet Food Delivery');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000045', 'Painter for hire', 'Lee', 'no_bids', '2018-12-20', '13:00', '18:00', 'Painting Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000046', 'Day Care', 'Nancy', 'no_bids', '2018-12-25', '08:00', '18:00', 'Daycare');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000047', 'Pick children service', 'Nancy', 'no_bids', '2018-12-25', '18:30', '20:30', 'Pick up children');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000048', 'Private cab', 'Seng', 'no_bids', '2018-12-25', '09:00', '23:00', 'Private Hire Cab Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000049', 'Full day cab', 'Seng', 'no_bids', '2018-12-22', '09:00', '22:00', 'Private Hire Cab Services');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000050', 'Pet food for sale', 'sarah', 'no_bids', '2018-12-23', '08:00', '18:00', 'Pet Food Delivery');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000052', 'Vet consultation (clinic)', 'charlene', 'no_bids', '2018-12-25', '08:00', '08:30', 'Slot 1');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000053', 'Vet consultation (clinic)', 'charlene', 'no_bids', '2018-12-25', '08:30', '09:00', 'Slot 2');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000054', 'Vet consultation (clinic)', 'charlene', 'no_bids', '2018-12-25', '09:00', '09:30', 'Slot 3');
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('00000055', 'Pet surgery (clinic)','charlene', 'no_bids', '2018-12-26', '09:30', '12:00', 'Pet Surgery');


-- task_bid_by
INSERT INTO task_bid_by VALUES ('00000012', 'charlene', 13);
INSERT INTO task_bid_by VALUES ('00000024', 'charlene', 20);
INSERT INTO task_bid_by VALUES ('00000011', 'sully', 15);
INSERT INTO task_bid_by VALUES ('00000011', 'tom', 150);
INSERT INTO task_bid_by VALUES ('00000001', 'Lee', 20);
INSERT INTO task_bid_by VALUES ('00000052', 'sully', 150);
INSERT INTO task_bid_by VALUES ('00000052', 'Nancy', 151);
INSERT INTO task_bid_by VALUES ('00000055', 'bob', 1500);
INSERT INTO task_bid_by VALUES ('00000037', 'sully', 0);
INSERT INTO task_bid_by VALUES ('00000049', 'Nancy', 6);
INSERT INTO task_bid_by VALUES ('00000041', 'Lee', 5);
INSERT INTO task_bid_by VALUES ('00000015', 'Nancy', 200);
INSERT INTO task_bid_by VALUES ('00000015', 'charlene', 210);
INSERT INTO task_bid_by VALUES ('00000015', 'sarah', 150);
INSERT INTO task_bid_by VALUES ('00000018', 'sarah', 80);
INSERT INTO task_bid_by VALUES ('00000008', 'Nancy', 50);
INSERT INTO task_bid_by VALUES ('00000051', 'charlene', 2000);
INSERT INTO task_bid_by VALUES ('00000021', 'charlene', 130);
INSERT INTO task_bid_by VALUES ('00000021', 'sully', 130);
INSERT INTO task_bid_by VALUES ('00000027', 'sully', 15);
INSERT INTO task_bid_by VALUES ('00000034', 'sully', 15);
INSERT INTO task_bid_by VALUES ('00000050', 'charlene', 15);
INSERT INTO task_bid_by VALUES ('00000028', 'tom', 50);
INSERT INTO task_bid_by VALUES ('00000039', 'tom', 35);
INSERT INTO task_bid_by VALUES ('00000045', 'charlene', 75);
INSERT INTO task_bid_by VALUES ('00000046', 'sully', 150);
INSERT INTO task_bid_by VALUES ('00000030', 'tom', 178);
INSERT INTO task_bid_by VALUES ('00000047', 'charlene', 15);

