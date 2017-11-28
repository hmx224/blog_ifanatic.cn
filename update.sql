-- -----------
-- 2017-11-28
-- -----------
ALTER TABLE `users` ADD `source` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '注册来源' AFTER `remember_token`;

ALTER TABLE `users` ADD `wx` varchar(50) DEFAULT '' COMMENT '微信号' AFTER `remember_token`;
ALTER TABLE `users` ADD `qq` varchar(20) DEFAULT '' COMMENT 'qq号' AFTER `remember_token`;
ALTER TABLE `users` ADD `wx_token` text  COMMENT '微信校验' AFTER `remember_token`;
ALTER TABLE `users` ADD `wb_token` text  COMMENT '微博校验' AFTER `remember_token`;
ALTER TABLE `users` ADD `qq_token` text  COMMENT 'QQ校验' AFTER `remember_token`;