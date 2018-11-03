#
# TABLE STRUCTURE FOR: tbl_divisi
#

DROP TABLE IF EXISTS `tbl_divisi`;

CREATE TABLE `tbl_divisi` (
  `id_divisi` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nm_divisi` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_divisi`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

INSERT INTO `tbl_divisi` (`id_divisi`, `nm_divisi`, `created_at`, `updated_at`) VALUES (00001, 'IT - CEMARA', '2018-11-01 11:19:50', '2018-11-02 00:35:19');
INSERT INTO `tbl_divisi` (`id_divisi`, `nm_divisi`, `created_at`, `updated_at`) VALUES (00003, 'HRD - BINJAI', '2018-11-02 13:33:09', '2018-11-02 20:55:15');
INSERT INTO `tbl_divisi` (`id_divisi`, `nm_divisi`, `created_at`, `updated_at`) VALUES (00035, 'IT - BINJAI', '2018-11-02 13:30:29', '2018-11-02 13:30:29');
INSERT INTO `tbl_divisi` (`id_divisi`, `nm_divisi`, `created_at`, `updated_at`) VALUES (00036, 'CS - CEMARA', '2018-11-02 13:30:34', '2018-11-02 13:30:34');
INSERT INTO `tbl_divisi` (`id_divisi`, `nm_divisi`, `created_at`, `updated_at`) VALUES (00037, 'CS - BINJAI', '2018-11-02 13:30:37', '2018-11-02 13:30:37');
INSERT INTO `tbl_divisi` (`id_divisi`, `nm_divisi`, `created_at`, `updated_at`) VALUES (00039, 'ADM', '2018-11-02 13:32:13', '2018-11-02 13:32:13');
INSERT INTO `tbl_divisi` (`id_divisi`, `nm_divisi`, `created_at`, `updated_at`) VALUES (00040, 'FINANCE', '2018-11-02 13:32:16', '2018-11-02 13:32:16');
INSERT INTO `tbl_divisi` (`id_divisi`, `nm_divisi`, `created_at`, `updated_at`) VALUES (00041, 'HRD - CEMARA', '2018-11-02 13:33:06', '2018-11-02 13:33:06');


#
# TABLE STRUCTURE FOR: tbl_supplier
#

DROP TABLE IF EXISTS `tbl_supplier`;

CREATE TABLE `tbl_supplier` (
  `id_supplier` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nm_supplier` varchar(255) NOT NULL,
  `address` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_supplier`),
  KEY `nm_supplier` (`nm_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO `tbl_supplier` (`id_supplier`, `nm_supplier`, `address`, `created_at`, `updated_at`) VALUES (00001, 'Medan Com', 'JL. PANDU', '2018-11-02 16:18:42', '2018-11-02 20:33:42');
INSERT INTO `tbl_supplier` (`id_supplier`, `nm_supplier`, `address`, `created_at`, `updated_at`) VALUES (00010, 'Benua Panasonic', NULL, '2018-11-02 16:47:06', '2018-11-02 20:33:25');
INSERT INTO `tbl_supplier` (`id_supplier`, `nm_supplier`, `address`, `created_at`, `updated_at`) VALUES (00011, 'SJO Com', NULL, '2018-11-02 16:47:13', '2018-11-02 20:59:40');


#
# TABLE STRUCTURE FOR: tbl_users
#

DROP TABLE IF EXISTS `tbl_users`;

CREATE TABLE `tbl_users` (
  `id_user` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nm_user` varchar(255) NOT NULL,
  `pass_user` varchar(255) NOT NULL,
  `id_divisi` int(6) unsigned zerofill NOT NULL,
  `nav_color` varchar(255) NOT NULL DEFAULT 'chiller-theme',
  `nav_bg` varchar(255) DEFAULT 'bg1',
  `nav_status` varchar(255) DEFAULT 'sidebar-bg',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  KEY `id_divisi` (`id_divisi`),
  CONSTRAINT `fk_user_divisi` FOREIGN KEY (`id_divisi`) REFERENCES `tbl_divisi` (`id_divisi`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

INSERT INTO `tbl_users` (`id_user`, `nm_user`, `pass_user`, `id_divisi`, `nav_color`, `nav_bg`, `nav_status`, `created_at`, `updated_at`) VALUES (00001, 'esj', '604e1aaea3ffbfc063b9e7e44b25e757', 000001, 'chiller-theme', 'bg1', 'sidebar-bg', '2018-11-02 21:38:30', '2018-11-02 21:38:42');
INSERT INTO `tbl_users` (`id_user`, `nm_user`, `pass_user`, `id_divisi`, `nav_color`, `nav_bg`, `nav_status`, `created_at`, `updated_at`) VALUES (00037, 'edward', 'a53f3929621dba1306f8a61588f52f55', 000001, 'chiller-theme', 'bg1', 'sidebar-bg', '2018-11-01 14:25:01', '2018-11-02 13:18:33');
INSERT INTO `tbl_users` (`id_user`, `nm_user`, `pass_user`, `id_divisi`, `nav_color`, `nav_bg`, `nav_status`, `created_at`, `updated_at`) VALUES (00042, 'admin', '21232f297a57a5a743894a0e4a801fc3', 000036, 'chiller-theme', 'bg1', 'sidebar-bg', '2018-11-02 13:32:38', '2018-11-02 13:32:38');
INSERT INTO `tbl_users` (`id_user`, `nm_user`, `pass_user`, `id_divisi`, `nav_color`, `nav_bg`, `nav_status`, `created_at`, `updated_at`) VALUES (00043, 'vinzent', 'aa61ae1f4722e6e1bb9510b8f222693e', 000041, 'chiller-theme', 'bg1', 'sidebar-bg', '2018-11-02 13:33:36', '2018-11-02 13:33:36');
INSERT INTO `tbl_users` (`id_user`, `nm_user`, `pass_user`, `id_divisi`, `nav_color`, `nav_bg`, `nav_status`, `created_at`, `updated_at`) VALUES (00044, 'vina', 'e7bb4f7ed097bd6ccefc46018fda32c8', 000037, 'chiller-theme', 'bg1', 'sidebar-bg', '2018-11-02 13:35:57', '2018-11-02 13:35:57');
INSERT INTO `tbl_users` (`id_user`, `nm_user`, `pass_user`, `id_divisi`, `nav_color`, `nav_bg`, `nav_status`, `created_at`, `updated_at`) VALUES (00045, 'henry', '027e4180beedb29744413a7ea6b84a42', 000003, 'chiller-theme', 'bg1', 'sidebar-bg', '2018-11-02 13:41:13', '2018-11-02 13:41:13');


#
# TABLE STRUCTURE FOR: tbl_warehouse
#

DROP TABLE IF EXISTS `tbl_warehouse`;

CREATE TABLE `tbl_warehouse` (
  `id_warehouse` int(5) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nm_warehouse` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_warehouse`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `tbl_warehouse` (`id_warehouse`, `nm_warehouse`, `created_at`, `updated_at`) VALUES (00001, 'INVENTARIS - CEMARA', '2018-11-02 21:12:08', '2018-11-02 21:12:08');
INSERT INTO `tbl_warehouse` (`id_warehouse`, `nm_warehouse`, `created_at`, `updated_at`) VALUES (00002, 'INVENTARIS - BINJAI', '2018-11-02 21:12:15', '2018-11-02 21:12:15');


