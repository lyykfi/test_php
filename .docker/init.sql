-- create the databases
CREATE DATABASE IF NOT EXISTS task;

GRANT ALL ON `task`.* TO 'user'@'%';

FLUSH PRIVILEGES;

CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL auto_increment,   
  `title` varchar(250)  NOT NULL default '',
  `author`  varchar(250) NOT NULL default '',     
  `status` varchar(250)  NOT NULL default 0,    
  `description` TEXT NOT NULL default '',
  `data` TIMESTAMP NOT NULL,
   PRIMARY KEY  (`id`)
);
ALTER TABLE task CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;