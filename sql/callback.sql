DROP TABLE IF EXISTS `alfredo_callback`;
CREATE TABLE `alfredo_callback` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `identifier` char(40) NOT NULL,
    `send` datetime NOT NULL,
    `received` datetime DEFAULT NULL,
    `success` tinyint(1) unsigned NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    UNIQUE KEY `identifier` (`identifier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;