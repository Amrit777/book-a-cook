--
-- Table structure for table `user`
--
DROP table if exists `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `profile_image` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `access_token` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_client` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oauth_client_user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `about_me` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `logged_at` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT '0',
  `role_id` int(11) NOT NULL DEFAULT '0',
  `type_id` int(11) DEFAULT '0',
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

drop table if exists `tbl_category`;
create table `tbl_category`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `state_id` int(11)  DEFAULT '1',
  `type_id` int(11)  DEFAULT '0',
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (create_user_id) REFERENCES tbl_user(id),
  CONSTRAINT `fk_category_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

drop table if exists `tbl_book_menu`;
create table `tbl_book_menu`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `booking_date` date DEFAULT NULL,
  `booking_time` time DEFAULT NULL,
  `number_of_person` int(11) DEFAULT '0',
  `updated_on` datetime DEFAULT NULL,
  `state_id` int(11)  DEFAULT '1',
  `type_id` int(11)  DEFAULT '0',
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (create_user_id) REFERENCES tbl_user(id),
  CONSTRAINT `fk_book_menu_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- menu create --

DROP table if exists `tbl_menu`;
create table `tbl_menu`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) NOT NULL,
  `category_id` int(11) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT '0',
  `time_to_prepare` int(11) DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `state_id` int(11)  DEFAULT '1',
  `type_id` int(11)  DEFAULT '0',
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (create_user_id) REFERENCES tbl_user(id),
  FOREIGN KEY (category_id) REFERENCES tbl_category(id),
  CONSTRAINT `fk_menu_category` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`),
  CONSTRAINT `fk_menu_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

