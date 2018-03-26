CREATE TABLE comment (
id int auto_increment PRIMARY KEY NOT NULL,
commentaire text,
user_id INT,
micropost_id INT,
created_at DATETIME DEFAULT NOW(),
FOREIGN KEY (user_id) REFERENCES users(id),
FOREIGN KEY (micropost_id) REFERENCES microposts(id)
);

