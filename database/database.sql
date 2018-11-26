/* ---------------------------------------------------- */
/*  Generated by Enterprise Architect Version 13.5 		*/
/*  Created On : 23-Nov-2018 11:49:25 				*/
/*  DBMS       : SQLite 								*/
/* ---------------------------------------------------- */

/* Drop Tables */

DROP TABLE IF EXISTS 'channel'
;

DROP TABLE IF EXISTS 'comment'
;

DROP TABLE IF EXISTS 'story'
;

DROP TABLE IF EXISTS 'subcription'
;

DROP TABLE IF EXISTS 'user'
;

DROP TABLE IF EXISTS 'vote_comment'
;

DROP TABLE IF EXISTS 'vote_story'
;

DROP TABLE IF EXISTS 'vote_type'
;

/* Create Tables with Primary and Foreign Keys, Check and Unique Constraints */

CREATE TABLE 'channel'
(
	'ID' INTEGER NOT NULL PRIMARY KEY,
	'name' TEXT NOT NULL,
	'coverImage' TEXT NULL,
	'author' INTEGER NOT NULL,
	CONSTRAINT 'FK_author' FOREIGN KEY ('author') REFERENCES 'user' ('ID') ON DELETE No Action ON UPDATE No Action
)
;

CREATE TABLE 'comment'
(
	'ID' INTEGER NOT NULL PRIMARY KEY,
	'content' TEXT NOT NULL,
	'date' TEXT NOT NULL,
	'story' INTEGER NOT NULL,
	'author' INTEGER NOT NULL,
	'upvotes' INTEGER NOT NULL DEFAULT 0,
	'downvotes' INTEGER NOT NULL DEFAULT 0,
	'parent_comment' INTEGER NOT NULL DEFAULT NULL,
	CONSTRAINT 'FK_author' FOREIGN KEY ('author') REFERENCES 'user' ('ID') ON DELETE No Action ON UPDATE No Action,
	CONSTRAINT 'FK_parent_comment' FOREIGN KEY ('parent_comment') REFERENCES 'comment' ('ID') ON DELETE No Action ON UPDATE No Action,
	CONSTRAINT 'FK_story' FOREIGN KEY ('story') REFERENCES 'story' ('ID') ON DELETE No Action ON UPDATE No Action
)
;

CREATE TABLE 'story'
(
	'ID' INTEGER NOT NULL PRIMARY KEY,
	'title' TEXT NOT NULL,
	'content' TEXT NOT NULL,
	'upvotes' INTEGER NOT NULL DEFAULT 0,
	'downvotes' INTEGER NOT NULL DEFAULT 0,
	'author' INTEGER NOT NULL,
	'date' TEXT NOT NULL,
	'channel' INTEGER NOT NULL,
	CONSTRAINT 'FK_author' FOREIGN KEY ('author') REFERENCES 'user' ('ID') ON DELETE No Action ON UPDATE No Action,
	CONSTRAINT 'FK_story_channel' FOREIGN KEY ('channel') REFERENCES 'channel' ('ID') ON DELETE No Action ON UPDATE No Action
)
;

CREATE TABLE 'subcription'
(
	'user' INTEGER NOT NULL,
	'channel' INTEGER NOT NULL,
	CONSTRAINT 'PK_subsription' PRIMARY KEY ('user','channel'),
	CONSTRAINT 'FK_subcription_channel' FOREIGN KEY ('channel') REFERENCES 'channel' ('ID') ON DELETE No Action ON UPDATE No Action,
	CONSTRAINT 'FK_subcription_user' FOREIGN KEY ('user') REFERENCES 'user' ('ID') ON DELETE No Action ON UPDATE No Action
)
;

CREATE TABLE 'user'
(
	'ID' INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	'username' TEXT NOT NULL,
	'email' TEXT NOT NULL,
	'password' TEXT NOT NULL,
	'birth' TEXT ,
	'profilePic' TEXT,
	CONSTRAINT 'username' UNIQUE ('username')
)
;

CREATE TABLE 'vote_comment'
(
	'user' INTEGER NOT NULL,
	'comment' INTEGER NOT NULL,
	'type' INTEGER NOT NULL,
	CONSTRAINT 'PK_vote_comment' PRIMARY KEY ('comment','user'),
	CONSTRAINT 'FK_vote_comment_comment' FOREIGN KEY ('comment') REFERENCES 'comment' ('ID') ON DELETE No Action ON UPDATE No Action,
	CONSTRAINT 'FK_vote_comment_user' FOREIGN KEY ('user') REFERENCES 'user' ('ID') ON DELETE No Action ON UPDATE No Action,
	CONSTRAINT 'FK_vote_comment_vote_type' FOREIGN KEY ('type') REFERENCES 'vote_type' ('ID') ON DELETE No Action ON UPDATE No Action
)
;

CREATE TABLE 'vote_story'
(
	'user' INTEGER NOT NULL,
	'story' INTEGER NOT NULL,
	'type' INTEGER NOT NULL,
	CONSTRAINT 'PK_vote_story' PRIMARY KEY ('story','user'),
	CONSTRAINT 'FK_vote_story' FOREIGN KEY ('story') REFERENCES 'story' ('ID') ON DELETE No Action ON UPDATE No Action,
	CONSTRAINT 'FK_vote_story_user' FOREIGN KEY ('user') REFERENCES 'user' ('ID') ON DELETE No Action ON UPDATE No Action,
	CONSTRAINT 'FK_vote_story_vote_type' FOREIGN KEY ('type') REFERENCES 'vote_type' ('ID') ON DELETE No Action ON UPDATE No Action
)
;

CREATE TABLE 'vote_type'
(
	'ID' INTEGER NOT NULL PRIMARY KEY,
	'type' TEXT NOT NULL,
	'story' INTEGER NOT NULL,
	'user' INTEGER NOT NULL
)
;