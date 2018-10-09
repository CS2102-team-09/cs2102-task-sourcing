CREATE TABLE users ( 
	user_id VARCHAR(128) PRIMARY KEY,
	is_admin BOOL DEFAULT False,
	password VARCHAR(128) NOT NULL,
	user_description VARCHAR(256)
);

CREATE TABLE task_managed_by ( 
	task_id CHAR(8) NOT NULL UNIQUE,
	task_title VARCHAR(64) NOT NULL,
	user_id VARCHAR(128),
	status VARCHAR(64) 	
		CHECK (status IN ('no_bids', 'in_progress', 'completed')),
	date DATE NOT NULL 
		CHECK (date >= current_date),
	start_time TIME,
	end_time TIME,
	description VARCHAR(128), 
	
	FOREIGN KEY(user_id) REFERENCES users(user_id)
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
	
	PRIMARY KEY(user_id, task_id)
);

CREATE OR REPLACE FUNCTION add_bid()
	RETURNS TRIGGER AS $$
	BEGIN

	IF ((SELECT COUNT(*) FROM task_bid_by WHERE task_id = NEW.task_id) > 0) THEN
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


