CREATE SEQUENCE serial_sequence START 101; -- for task_id

CREATE TABLE users ( 
	user_id VARCHAR(128) PRIMARY KEY,
	is_admin BOOL DEFAULT False,
	password VARCHAR(128) NOT NULL,
	user_description VARCHAR(256)
);

CREATE TABLE task_managed_by ( 
	task_id CHAR(8) NOT NULL UNIQUE DEFAULT nextval(('"serial_sequence"'::text)::regclass),
	task_title VARCHAR(64) NOT NULL,
	user_id VARCHAR(128),
	status VARCHAR(64) DEFAULT 'no_bids'
		CHECK (status IN ('no_bids', 'in_progress', 'completed', 'not_successful')),
	winning_bid NUMERIC,
	winner VARCHAR(128),
	date DATE NOT NULL 
		CHECK (date >= current_date),
	start_time TIME,
	end_time TIME,
	description VARCHAR(128), 
	
	FOREIGN KEY(user_id) REFERENCES users(user_id)
		ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (winner) REFERENCES users(user_id)
		ON UPDATE CASCADE ON DELETE CASCADE,
	
	PRIMARY KEY(task_id, user_id)
);

CREATE TABLE task_bid_by (
	task_id CHAR(8),
	user_id VARCHAR(128),
	amount NUMERIC,
	comments_by_bidder VARCHAR(256),
	
	FOREIGN KEY (user_id) REFERENCES users(user_id)
		ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (task_id) REFERENCES task_managed_by(task_id)
		ON DELETE CASCADE ON UPDATE CASCADE,
	
	PRIMARY KEY(user_id, task_id, amount)
);

CREATE OR REPLACE FUNCTION add_bid()
	RETURNS TRIGGER AS $$
	BEGIN

	IF ((SELECT COUNT(*) FROM task_bid_by WHERE task_id = NEW.task_id) = 1) THEN
		UPDATE task_managed_by SET status = 'in_progress' WHERE task_id = NEW.task_id;
	END IF;

	RETURN NEW;
	END; $$ LANGUAGE PLPGSQL;

CREATE TRIGGER add_bid_status
	AFTER UPDATE OR INSERT
	ON task_bid_by
	FOR EACH ROW
	EXECUTE PROCEDURE add_bid();

CREATE OR REPLACE FUNCTION remove_bid()
	RETURNS TRIGGER AS $$
	BEGIN
	IF ((SELECT COUNT(*) FROM task_bid_by WHERE task_id = OLD.task_id) = 1) THEN
		UPDATE task_managed_by SET status = 'no_bids' WHERE task_id = OLD.task_id;
	END IF;
	RETURN OLD;
	END;
	$$ LANGUAGE PLPGSQL;

CREATE TRIGGER remove_bid_status
	BEFORE DELETE
	ON task_bid_by
	FOR EACH ROW
	EXECUTE PROCEDURE remove_bid();

CREATE OR REPLACE FUNCTION remove_invalid_bids()
RETURNS TRIGGER AS $$
DECLARE
	current_bid NUMERIC := (SELECT (CASE WHEN highest_bid.amount IS NULL THEN 0 ELSE highest_bid.amount END) FROM (SELECT MAX(amount) AS amount FROM task_bid_by WHERE task_id = NEW.task_id) AS highest_bid);
BEGIN
	IF (current_bid >= NEW.amount) THEN
		RAISE EXCEPTION 'Given bid is $%, highest bid so far is $%. Please input a bid higher than existing bid.', NEW.amount, current_bid;
		RETURN NULL;
	ELSE
		RETURN NEW;
	END IF;
	END; $$
	LANGUAGE PLPGSQL;

CREATE TRIGGER remove_invalid_bids
BEFORE INSERT OR UPDATE
ON task_bid_by
FOR EACH ROW
EXECUTE PROCEDURE remove_invalid_bids();

CREATE OR REPLACE FUNCTION disable_delete_admin()
	RETURNS TRIGGER AS $$
	BEGIN
		RAISE EXCEPTION 'Attempting to delete admin. Operation void';
		RETURN NULL;
	END;
	$$ LANGUAGE PLPGSQL;

CREATE TRIGGER disable_delete_admin
BEFORE DELETE
on users
FOR EACH ROW
WHEN (OLD.is_admin = True)
EXECUTE PROCEDURE disable_delete_admin();

CREATE OR REPLACE FUNCTION remove_multitask()
	RETURNS TRIGGER AS $$
	BEGIN
		IF ((SELECT COUNT(*) FROM task_managed_by WHERE user_id = NEW.user_id AND date = NEW.date AND start_time <= NEW.start_time
			AND end_time >= NEW.start_time) >= 1) THEN
			RAISE EXCEPTION 'A user cannot be at two places at once!';
			RETURN NULL;
		END IF;
		RETURN NEW;
	END;
	$$ LANGUAGE PLPGSQL;

CREATE TRIGGER remove_multitask_update
BEFORE UPDATE
ON task_managed_by
FOR EACH ROW
WHEN ((OLD.status IS NOT DISTINCT FROM NEW.status) AND (OLD.date IS DISTINCT FROM NEW.date))
EXECUTE PROCEDURE remove_multitask();

CREATE TRIGGER remove_multitask_insert
BEFORE INSERT
ON task_managed_by
FOR EACH ROW
EXECUTE PROCEDURE remove_multitask();

CREATE FUNCTION prevent_outbidding_by_same_user()
	RETURNS TRIGGER AS $$
	DECLARE
		current_highest_user VARCHAR(128) := (SELECT user_id FROM task_bid_by WHERE task_id = NEW.task_id GROUP BY user_id, amount HAVING amount >= ALL (SELECT amount from task_bid_by WHERE task_id = NEW.task_id));
	BEGIN
		IF (current_highest_user = NEW.user_id) THEN
			RAISE EXCEPTION 'Outbidding yourself is silly';
			RETURN NULL;
		END IF;
		RETURN NEW;
	END;
	$$ LANGUAGE PLPGSQL;

CREATE TRIGGER prevent_outbidding_by_same_user
	-- You stupid? trigger
	BEFORE INSERT
	ON task_bid_by
	FOR EACH ROW
	EXECUTE PROCEDURE prevent_outbidding_by_same_user();

