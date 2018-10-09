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