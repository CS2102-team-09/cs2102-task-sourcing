-- TEST FOR TRIGGERS (Adding Bid - Change status to in_progress) -- 
SELECT * FROM task_managed_by WHERE task_id = '00000001';
INSERT INTO task_bid_by VALUES ('00000001', 'Siang', 5);
INSERT INTO task_bid_by VALUES ('00000001', 'Caidi', 6);

-- TEST FOR TRIGGERS (Delete Bid - Change status to no_bids) -- 
DELETE FROM task_bid_by WHERE task_id = '00000001';

-- TEST FOR TRIGGERS (Disallow invalid bids - Below current bid point) -- 
SELECT * FROM task_managed_by WHERE task_id = '00000001';
INSERT INTO task_bid_by VALUES ('00000001', 'Siang', 5);
INSERT INTO task_bid_by VALUES ('00000001', 'Caidi', 3); -- ERROR BECAUSE LOWER
INSERT INTO task_bid_by VALUES ('00000001', 'Caidi', 5); -- ERROR BECAUSE SAME

-- TEST FOR TRIGGERS (Deleting Admin) -- 
SELECT * FROM users WHERE is_admin = True;
DELETE FROM users WHERE user_id = 'Siang';

-- TEST FOR TRIGGERS (Multi-tasking not allowed) -- 
SELECT * FROM task_managed_by WHERE user_id = 'alice';
-- OVERLAP WITH task_id = 00000001
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('10000000', 'Car Wash', 'alice', 'no_bids', '2018-12-30', '18:10', '18:20', 'Car Wash');
-- NO OVERLAP 
INSERT INTO task_managed_by (task_id, task_title, user_id, status, date, start_time, end_time, description)
	VALUES ('20000000', 'Car Wash Trial', 'alice', 'no_bids', '2019-11-25', '08:00', '18:00', 'Car Wash');