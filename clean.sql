DROP SEQUENCE serial_sequence;
DROP TABLE users, task_managed_by, task_bid_by;
DROP FUNCTION remove_bid() CASCADE;
DROP FUNCTION add_bid() CASCADE;
DROP FUNCTION remove_invalid_bids() CASCADE;
DROP FUNCTION disable_delete_admin() CASCADE;
DROP FUNCTION remove_multitask() CASCADE;