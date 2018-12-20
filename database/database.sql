BEGIN TRANSACTION;
DROP TABLE IF EXISTS `vote_type`;
CREATE TABLE IF NOT EXISTS `vote_type` (
	`ID`	INTEGER NOT NULL,
	`type`	TEXT NOT NULL,
	PRIMARY KEY(`ID`)
);
INSERT INTO `vote_type` VALUES (1,'downvote
');
INSERT INTO `vote_type` VALUES (2,'upvote');
DROP TABLE IF EXISTS `vote_story`;
CREATE TABLE IF NOT EXISTS `vote_story` (
	`user`	INTEGER NOT NULL,
	`story`	INTEGER NOT NULL,
	`type`	INTEGER NOT NULL,
	CONSTRAINT `PK_vote_story` PRIMARY KEY(`story`,`user`),
	FOREIGN KEY(`story`) REFERENCES `story`(`storyID`) ON DELETE Cascade ON UPDATE No Action,
	FOREIGN KEY(`type`) REFERENCES `vote_type`(`ID`) ON DELETE Cascade ON UPDATE No Action,
	FOREIGN KEY(`user`) REFERENCES `user`(`ID`) ON DELETE Cascade ON UPDATE No Action
);
INSERT INTO `vote_story` VALUES (3,4,2);
DROP TABLE IF EXISTS `vote_comment`;
CREATE TABLE IF NOT EXISTS `vote_comment` (
	`user`	INTEGER NOT NULL,
	`comment`	INTEGER NOT NULL,
	`type`	INTEGER NOT NULL,
	CONSTRAINT `PK_vote_comment` PRIMARY KEY(`comment`,`user`),
	FOREIGN KEY(`user`) REFERENCES `user`(`ID`) ON DELETE Cascade ON UPDATE No Action,
	FOREIGN KEY(`type`) REFERENCES `vote_type`(`ID`) ON DELETE Cascade ON UPDATE No Action,
	FOREIGN KEY(`comment`) REFERENCES `comment`(`ID`) ON DELETE Cascade ON UPDATE Cascade
);
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
	`ID`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`username`	TEXT NOT NULL CHECK(length ( username ) > 0 and length ( username ) < 16),
	`email`	TEXT NOT NULL,
	`password`	TEXT NOT NULL CHECK(length ( password ) > 5),
	`birth`	TEXT CHECK(length ( birth ) > 0),
	`profilePic`	TEXT,
	`score`	INTEGER DEFAULT 0,
	CONSTRAINT `username` UNIQUE(`username`)
);
INSERT INTO `user` VALUES (1,'SofiaMartins','olaTudo@gmail.com','$2y$12$LK7sqNyrfxIt0WJORcTFK.IQS9emDuyWtI4wCP44SIPBbTk0N7ZAe','1998-12-24','5c0561f59ab48.jpg',0);
INSERT INTO `user` VALUES (2,'ola tiago','1234@example.com','$2y$12$rAQ6uDBnyrTowQg7hf.YieFRp37RjSlZZO8LS/8TDTJ5QeCp4NqtK','1998-07-01',NULL,1);
INSERT INTO `user` VALUES (3,'Tiaguinho22','tiago25@pati.com','$2y$12$baxmN46/PU6eB9tyepSmh.XnXFWKxqhSyIcdPQ0uQJDkBlE8RilgG','1998-07-01','',0);
INSERT INTO `user` VALUES (4,'patricia98','patricia.janeiro.l@gmail.com','$2y$12$KLwePsHVMZPZvqlomxiYLOqzAjtls4cQ/obnh9E0y2ig5OrJw2r6u','1998-12-21','5c138926f0eb9.jpg',0);
INSERT INTO `user` VALUES (5,'1','nunex@gmail.com','$2y$12$zO7FsgzRBfw5NsqzpWC6X.2mTzY/vAzn4w9Up5sjsiL4foyw2dEYK','2018-01-01',NULL,0);
INSERT INTO `user` VALUES (6,'FabioElHacker','10','$2y$12$1XqN2dG1tYL8xjNzNvb/6ei5SkGrLMaoLDbPNK3Czu9ClcbYg5hDq','&lt;script&gt;while(1){alert(&quot;es uma merda tiago&quot;);}&lt;/script&gt;','5c112487201cc.jpg',0);
INSERT INTO `user` VALUES (7,'asdfg','email','$2y$12$Fiko7C5VflruwkGY4wuC6.ReShgGsiEkQTjzDedXSabve6.tzbD.e','date@totsadate.com','',0);
INSERT INTO `user` VALUES (8,'Nuno','nuno@nuno.com','$2y$12$sYSCgvfBY4BFXYRM6FHNXOdWn0Gzx8pci5Ii/HsS6WZkS3Ba6pfkG','1998-10-10',NULL,0);
INSERT INTO `user` VALUES (9,'andrePereira','andre.pereira@email.com','$2y$12$jolGq9NiodGMo.I3SiGtxOjclcX/jj3mNq0ZvHtqnjx0oskDmhD.m','1986-04-23','5c1c043342a3e.png',1);
DROP TABLE IF EXISTS `story`;
CREATE TABLE IF NOT EXISTS `story` (
	`storyID`	INTEGER NOT NULL,
	`title`	TEXT NOT NULL CHECK(length ( title ) > 0 and length ( title ) < 80),
	`content`	TEXT NOT NULL CHECK(length ( content ) > 0),
	`upvotes`	INTEGER NOT NULL DEFAULT 0,
	`downvotes`	INTEGER NOT NULL DEFAULT 0,
	`author`	INTEGER NOT NULL,
	`date`	TEXT NOT NULL CHECK(length ( date ) > 0),
	`channel`	INTEGER NOT NULL,
	`image`	TEXT,
	PRIMARY KEY(`storyID`),
	FOREIGN KEY(`channel`) REFERENCES `channel`(`ID`) ON DELETE Cascade ON UPDATE No Action,
	FOREIGN KEY(`author`) REFERENCES `user`(`ID`) ON DELETE Cascade ON UPDATE No Action
);
INSERT INTO `story` VALUES (1,'Como fazer pickles e pepino','Fazer pickles é um dos métodos mais antigo de conservação de alimentos e está na moda pelo mundo todo. Os pickles complementam os seus pratos com sabores diferentes. O melhor é que pode fazê-los em casa. Aprenda como fazer pickes neste artigo.',0,0,3,'2018-12-20 21:36:54',1,'5c1bfd6653907.jpg');
INSERT INTO `story` VALUES (2,'O que são Pickles?','São comumente usados pepinos no preparo de conservas ou &quot;picles&quot;.
Picles (do holandês pekel, pelo inglês pickles) são conservas de vegetais em vinagre.[1] Este tratamento produz a fermentação láctica do alimento. É uma fermentação natural, por ação das bactérias do gênero Leuconostoc e Lactobacillus do próprio vegetal. O produto final pode ser ácido acético, ácido láctico, álcool e dióxido de carbono.

A fermentação lática é um importante método de preservação de alimentos, conhecido há centenas de anos, entretanto com a modificação dos hábitos alimentares, os alimentos fermentados passaram a ter função de condimentos. Os mais importantes são: picles, chucrutes e azeitonas. As bactérias utilizadas industrialmente para fermentação lática são as anaeróbias e microaerófilas, para a produção de ácido acético, lático, glucônico, propiônico e outros, ou para a produção de alimentos como queijos, picles, chucrutes, vinagres, leites fermentados e outros. A produção de ácido lático é feita através das bactérias homoláticas do gênero Lactobacillus e Streptococcus. A espécie escolhida depende do carboidrato disponível e da temperatura a ser empregada.',0,0,3,'2018-12-20 22:03:18',1,'5c1c0396d8c25.jpg');
INSERT INTO `story` VALUES (3,'First time making fermented dill pickles, question about canning','I used the Food Wishes YouTube recipe with chef john for fermented dill pickles using a salt brine and left them at room temp about 7 days. The recipe didn''t call for any particular canning process other than placing them in a jar and putting them in the fridge, but I wanted to be cautious as I am giving these as gifts and and put them in jars to boil for 10 minutes. I did forget to sterilize the empty jars using boiling water, but I did wash them with soap and hot water (no dish sponge). Is there any reason why these would not turn out okay?

Edit: as I was typing this I noticed that my submerged can was bubbling and some of the liquid had come out. Maybe some of the boiling water got in I''m not sure. Is this okay?',0,0,9,'2018-12-20 22:26:54',1,'5c1c091ef0657.jpg');
INSERT INTO `story` VALUES (4,'What''s a Thinkpad?','ThinkPad is a line of laptop computers and tablets designed, developed, and sold by Lenovo, and formerly IBM. ThinkPads are known for their minimalist, black, and boxy design which was initially modeled in 1990 by industrial designer Richard Sapper, based on the concept of a traditional Japanese Bento lunchbox revealing its nature only after being opened. According to later interviews with Sapper, he also characterized the simple ThinkPad form to be as elementary as a simple, black cigar box, and with similar proportions that offers a ''surprise'' when opened.

The line was first developed at the IBM Yamato Facility in Japan, led by Arimasa Naitoh, who is now dubbed the &quot;father&quot; of ThinkPad. The first ThinkPads were released in October 1992. Considered innovative, it became a large success for IBM during that decade.

ThinkPads are especially popular with businesses. Older models are revered by technology enthusiasts, collectors and power users due to their durable design, relatively high resale value, and abundance of aftermarket replacement parts. ThinkPads have received a somewhat cult following and a small but loyal fanbase throughout the years. ThinkPad laptops have been used in outer space and, by 2003, were the only laptops certified for use on the International Space Station.',1,0,9,'2018-12-20 23:03:02',2,'5c1c119602297.jpg');
DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
	`ID`	INTEGER NOT NULL,
	`content`	TEXT NOT NULL CHECK(length ( content ) > 0),
	`date`	TEXT NOT NULL CHECK(length ( date ) > 0),
	`story`	INTEGER NOT NULL,
	`author`	INTEGER NOT NULL,
	`upvotes`	INTEGER NOT NULL DEFAULT 0,
	`downvotes`	INTEGER NOT NULL DEFAULT 0,
	`image`	INTEGER,
	PRIMARY KEY(`ID`),
	FOREIGN KEY(`story`) REFERENCES `story`(`storyID`) ON DELETE Cascade ON UPDATE No Action,
	FOREIGN KEY(`author`) REFERENCES `user`(`ID`) ON DELETE Cascade ON UPDATE No Action
);
INSERT INTO `comment` VALUES (1,'I love them!!!!!!','2018-12-20 22:55:58',2,9,0,0,'');
INSERT INTO `comment` VALUES (2,'My favourite laptop!!','2018-12-20 23:03:50',4,3,0,0,'');
DROP TABLE IF EXISTS `channel`;
CREATE TABLE IF NOT EXISTS `channel` (
	`ID`	INTEGER NOT NULL,
	`name`	TEXT NOT NULL CHECK(length ( name ) > 0 and length ( name ) < 30) UNIQUE,
	`coverImage`	TEXT,
	`author`	INTEGER NOT NULL,
	FOREIGN KEY(`author`) REFERENCES `user`(`ID`) ON DELETE Cascade ON UPDATE No Action,
	PRIMARY KEY(`ID`)
);
INSERT INTO `channel` VALUES (1,'Pickles','5c1bfd2f3ce97.gif',3);
INSERT INTO `channel` VALUES (2,'Thinkpad','5c1c1104431f7.jpg',9);
DROP TRIGGER IF EXISTS `update_story_votes`;
CREATE TRIGGER update_story_votes AFTER INSERT ON vote_story BEGIN UPDATE story SET downvotes = (SELECT COUNT(*) FROM vote_story WHERE vote_story.story = new.story AND type = (SELECT ID FROM vote_type WHERE type LIKE '%downvote%')), upvotes = (SELECT COUNT(*) FROM vote_story WHERE vote_story.story = new.story AND type = (SELECT ID FROM vote_type WHERE type LIKE '%upvote%')) WHERE storyID = new.story; END;
DROP TRIGGER IF EXISTS `update_story_score`;
CREATE TRIGGER update_story_score AFTER INSERT ON vote_story
BEGIN UPDATE user SET score = score + 1 WHERE user.ID = (SELECT author FROM story where storyID = new.story) AND new.type = (SELECT vote_type.ID FROM vote_type WHERE type LIKE '%upvote%');
UPDATE user SET score = score - 1 WHERE user.ID = (SELECT author FROM story where storyID = new.story) AND new.type = (SELECT vote_type.ID FROM vote_type WHERE type LIKE '%downvote%'); END;
DROP TRIGGER IF EXISTS `update_comment_votes`;
CREATE TRIGGER update_comment_votes AFTER INSERT ON vote_comment 
BEGIN UPDATE comment SET downvotes = 
(SELECT COUNT(*) FROM vote_comment 
WHERE vote_comment.comment = new.comment AND type = 
(SELECT vote_type.ID FROM vote_type WHERE type LIKE '%downvote%')),
 upvotes = (SELECT COUNT(*) FROM vote_comment 
 WHERE vote_comment.comment = new.comment AND type = 
 (SELECT vote_type.ID FROM vote_type WHERE type LIKE '%upvote%')) 
 WHERE comment.ID = new.comment; END;
DROP TRIGGER IF EXISTS `update_comment_score`;
CREATE TRIGGER update_comment_score AFTER INSERT ON vote_comment BEGIN UPDATE user SET score = score + 1 WHERE user.ID = (SELECT author FROM comment where ID = new.comment) AND new.type = (SELECT vote_type.ID FROM vote_type WHERE type LIKE '%upvote%'); UPDATE user SET score = score - 1 WHERE user.ID = (SELECT author FROM comment where ID = new.comment) AND new.type = (SELECT vote_type.ID FROM vote_type WHERE type LIKE '%downvote%'); END;
DROP TRIGGER IF EXISTS `delete_story_votes`;
CREATE TRIGGER delete_story_votes AFTER DELETE ON vote_story BEGIN UPDATE story SET downvotes = (SELECT COUNT(*) FROM vote_story WHERE vote_story.story = old.story AND type = (SELECT ID from vote_type WHERE type LIKE '%downvote%')), upvotes = (SELECT COUNT(*) FROM vote_story WHERE vote_story.story = old.story AND type = (SELECT ID from vote_type WHERE type LIKE '%upvote%')) WHERE storyID = old.story; END;
DROP TRIGGER IF EXISTS `delete_story_score`;
CREATE TRIGGER delete_story_score AFTER DELETE ON vote_story 
BEGIN UPDATE user SET score = score - 1 WHERE user.ID = (SELECT author FROM story where storyID = old.story) AND old.type = (SELECT vote_type.ID FROM vote_type WHERE type LIKE '%upvote%');
UPDATE user SET score = score + 1 WHERE user.ID = (SELECT author FROM story where storyID = old.story) AND old.type = (SELECT vote_type.ID FROM vote_type WHERE type LIKE '%downvote%'); END;
DROP TRIGGER IF EXISTS `delete_comment_votes`;
CREATE TRIGGER delete_comment_votes 
AFTER DELETE ON vote_comment BEGIN UPDATE comment 
SET downvotes = (SELECT COUNT(*) FROM vote_comment 
WHERE vote_comment.comment = old.comment 
AND type = 
(SELECT vote_type.ID from vote_type WHERE type LIKE '%downvote%')),
 upvotes = (SELECT COUNT(*) FROM vote_comment
 WHERE vote_comment.comment = old.comment 
 AND type = (SELECT vote_type.ID from vote_type WHERE type LIKE '%upvote%')) 
 WHERE comment.ID = old.comment; END;
DROP TRIGGER IF EXISTS `delete_comment_score`;
CREATE TRIGGER delete_comment_score AFTER DELETE ON vote_comment BEGIN UPDATE user SET score = score - 1 WHERE user.ID = (SELECT author FROM comment where ID = old.comment) AND old.type = (SELECT vote_type.ID FROM vote_type WHERE type LIKE '%upvote%'); UPDATE user SET score = score + 1 WHERE user.ID = (SELECT author FROM comment where ID = old.comment) AND old.type = (SELECT vote_type.ID FROM vote_type WHERE type LIKE '%downvote%'); END;
COMMIT;
