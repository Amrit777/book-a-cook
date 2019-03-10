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

drop table if exists `tbl_tag`;
create table `tbl_tag`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- post create --

DROP table if exists `tbl_post`;
create table `tbl_post`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) NOT NULL,
  `category_id` int(11) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `meta_tag` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `is_original_content` int(11) DEFAULT '0',
  `tags` varchar(127) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `state_id` int(11)  DEFAULT '1',
  `type_id` int(11)  DEFAULT '0',
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (create_user_id) REFERENCES tbl_user(id),
  FOREIGN KEY (category_id) REFERENCES tbl_category(id),
  CONSTRAINT `fk_post_category` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`),
  CONSTRAINT `fk_post_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- post share ------
-- sharing of posts --
---- ------- ------

DROP table if exists `tbl_post_share`;
create table `tbl_post_share`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `state_id` int(11)  DEFAULT '1',
  `type_id` int(11)  DEFAULT '0',
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (create_user_id) REFERENCES tbl_user(id),
  CONSTRAINT `fk_post_share_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`),
  FOREIGN KEY (post_id) REFERENCES `tbl_post`(id),
  CONSTRAINT `fk_post_share_post_id` FOREIGN KEY (`post_id`) REFERENCES `tbl_post` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- post like --


DROP table if exists `tbl_post_like`;
create table `tbl_post_like`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `state_id` int(11)  DEFAULT '1',
  `type_id` int(11)  DEFAULT '0',
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (create_user_id) REFERENCES tbl_user(id),
  CONSTRAINT `fk_post_like_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`),
  FOREIGN KEY (post_id) REFERENCES `tbl_post`(id),
  CONSTRAINT `fk_post_like_id` FOREIGN KEY (`post_id`) REFERENCES `tbl_post` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- post comment --
DROP table if exists `tbl_post_comment`;
create table `tbl_post_comment`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_content` varchar(255) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `state_id` int(11)  DEFAULT '1',
  `type_id` int(11)  DEFAULT '0',
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (create_user_id) REFERENCES tbl_user(id),
  CONSTRAINT `fk_post_comment_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`),
  FOREIGN KEY (post_id) REFERENCES `tbl_post`(id),
  CONSTRAINT `fk_post_comment_post_id` FOREIGN KEY (`post_id`) REFERENCES `tbl_post` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- follow user --
DROP table if exists `tbl_follow_user`;
create table `tbl_follow_user`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `state_id` int(11)  DEFAULT '0',
  `type_id` int(11)  DEFAULT '0',
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (create_user_id) REFERENCES tbl_user(id),
  FOREIGN KEY (user_id) REFERENCES tbl_user(id),
  CONSTRAINT `fk_follow_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`),
  CONSTRAINT `fk_follow_user_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `tbl_page`;
CREATE TABLE `tbl_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text  DEFAULT NULL,
  `state_id` int(11)  DEFAULT '0',
  `type_id` int(11)  DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (create_user_id) REFERENCES tbl_user(id),
  CONSTRAINT `fk_page_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `keyword`
--

DROP TABLE IF EXISTS `tbl_keyword`;
CREATE TABLE `tbl_keyword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL,
  `model_type` varchar(125)  NOT NULL,
  `state_id` int(11)  DEFAULT '0',
  `type_id` int(11)  DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (create_user_id) REFERENCES tbl_user(id),
  CONSTRAINT `fk_keyword_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `tbl_main_header`
--

DROP TABLE IF EXISTS `tbl_main_header`;
CREATE TABLE `tbl_main_header` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `link_url` varchar(255) NOT NULL DEFAULT '#0' ,
  `state_id` int(11)  DEFAULT '0',
  `type_id` int(11)  DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (create_user_id) REFERENCES tbl_user(id),
  CONSTRAINT `fk_main_header_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Table structure for table `tbl_sub_header`
--
DROP TABLE IF EXISTS `tbl_sub_header`;
CREATE TABLE `tbl_sub_header` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `header_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link_url` varchar(255) NOT NULL DEFAULT '#0' ,
  `state_id` int(11)  DEFAULT '0',
  `type_id` int(11)  DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `create_user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (create_user_id) REFERENCES tbl_user(id),
  FOREIGN KEY (header_id) REFERENCES tbl_main_header(id),
  CONSTRAINT `fk_sub_header_header_id` FOREIGN KEY (`header_id`) REFERENCES `tbl_main_header` (`id`),
  CONSTRAINT `fk_main_header_create_user_id` FOREIGN KEY (`create_user_id`) REFERENCES `tbl_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
