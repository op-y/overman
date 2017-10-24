CREATE DATABASE IF NOT EXISTS sre;

USE sre;

DROP TABLE IF EXISTS `duty`;
CREATE TABLE `duty` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `team` varchar(256) NOT NULL DEFAULT 'sre',
  `duty_date` date NOT NULL DEFAULT '2017-05-01',
  `op` varchar(256) NOT NULL DEFAULT 'op',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Duty';

DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(1024) NOT NULL,
  `url` varchar(1024) NOT NULL DEFAULT 'https://yoursite.com/',
  `class` varchar(32) NOT NULL DEFAULT 'event-info',
  `start` varchar(16) NOT NULL DEFAULT '1493863200000',
  `end` varchar(16) NOT NULL DEFAULT '1493866800000',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Event';

DROP TABLE IF EXISTS `host`;
CREATE TABLE `host` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `hostname` varchar(256) NOT NULL,
  `ip` varchar(64) NOT NULL DEFAULT '127.0.0.1',
  `idc` bigint(20) NOT NULL,
  `cpu` varchar(512) NOT NULL DEFAULT '',
  `memory` varchar(512) NOT NULL DEFAULT '',
  `disk` varchar(512) NOT NULL DEFAULT '',
  `ssd` varchar(512) NOT NULL DEFAULT '',
  `raid` varchar(512) NOT NULL DEFAULT '',
  `nic` varchar(512) NOT NULL DEFAULT '',
  `os` varchar(512) DEFAULT 'CentOS Linux release 7.1',
  `kernel` varchar(64) DEFAULT '3.10.0',
  `rack` varchar(64) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Host';

DROP TABLE IF EXISTS `idc`;
CREATE TABLE `idc` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `code` varchar(256) NOT NULL DEFAULT 'bj',
  `address` varchar(256) NOT NULL DEFAULT '',
  `administrator` varchar(256) NOT NULL DEFAULT '',
  `tel` varchar(256) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='IDC';

DROP TABLE IF EXISTS `privilege`;
CREATE TABLE `privilege` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(256) NOT NULL,
  `name` varchar(256) DEFAULT '',
  `description` varchar(1024) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Privilege';

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(256) NOT NULL,
  `description` varchar(1024) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Role';

DROP TABLE IF EXISTS `role_privilege`;
CREATE TABLE `role_privilege` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) NOT NULL,
  `privilege_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Privileges of Role';

DROP TABLE IF EXISTS `service`;
CREATE TABLE `service` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pid` bigint(20) NOT NULL DEFAULT '0',
  `name` varchar(512) NOT NULL,
  `kind` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Service';

DROP TABLE IF EXISTS `service_deployment`;
CREATE TABLE `service_deployment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `service_id` bigint(20) NOT NULL,
  `namespace` varchar(256) NOT NULL DEFAULT 'www',
  `idc` varchar(256) NOT NULL DEFAULT 'bj',
  `jenkins_job_name` varchar(256) NOT NULL,
  `jenkins_repo_url` varchar(1024) NOT NULL,
  `jenkins_repo_branch` varchar(256) NOT NULL DEFAULT 'master',
  `jenkins_maven_param` varchar(1024) NOT NULL DEFAULT '',
  `jenkins_jar_path` varchar(1024) NOT NULL,
  `jenkins_run_param` varchar(1024) NOT NULL,
  `k8s_service_name` varchar(256) NOT NULL,
  `k8s_service_port` int(11) NOT NULL DEFAULT '80',
  `status` varchar(64) NOT NULL DEFAULT 'NEW',
  `image_repo_url` varchar(1024) NOT NULL DEFAULT 'repo.com',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='servcie deploy template';

DROP TABLE IF EXISTS `service_deployment_log`;
CREATE TABLE `service_deployment_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `service_id` bigint(20) NOT NULL,
  `version` varchar(256) NOT NULL,
  `duration` int(11) NOT NULL DEFAULT '60',
  `status` varchar(64) NOT NULL DEFAULT 'SUCC',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='deployment logs';

DROP TABLE IF EXISTS `service_logmon`;
CREATE TABLE `service_logmon` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `service_id` bigint(20) NOT NULL,
  `name` varchar(512) NOT NULL,
  `logfile` varchar(1024) NOT NULL,
  `expression` varchar(1024) NOT NULL,
  `case_sensitive` tinyint(4) NOT NULL DEFAULT '0',
  `method` varchar(64) NOT NULL DEFAULT 'COUNT',
  `period` smallint(6) NOT NULL DEFAULT '60',
  `status` varchar(64) NOT NULL DEFAULT 'NEW',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='logmon rules';

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) NOT NULL,
  `tel` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(256) NOT NULL DEFAULT '',
  `status` varchar(32) DEFAULT 'USING',
  `avatar` varchar(1024) DEFAULT '',
  `password` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='User';

DROP TABLE IF EXISTS `user_service_role`;
CREATE TABLE `user_service_role` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `service_id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='Role of User in certain Service';
