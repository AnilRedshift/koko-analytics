<?php

defined('ABSPATH') or exit;

global $wpdb;

$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}koko_analytics_site_stats");
$wpdb->query("CREATE TABLE {$wpdb->prefix}koko_analytics_site_stats (
   date DATE PRIMARY KEY NOT NULL,
   visitors INTEGER UNSIGNED NOT NULL,
   pageviews INTEGER UNSIGNED NOT NULL
) ENGINE=INNODB CHARACTER SET={$wpdb->charset} COLLATE={$wpdb->collate}");

$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}koko_analytics_post_stats");
$wpdb->query("CREATE TABLE {$wpdb->prefix}koko_analytics_post_stats (
   date DATE NOT NULL,
   id BIGINT(20) UNSIGNED NOT NULL,
   visitors INTEGER UNSIGNED NOT NULL,
   pageviews INTEGER UNSIGNED NOT NULL,
   PRIMARY KEY (date, id)
) ENGINE=INNODB CHARACTER SET={$wpdb->charset} COLLATE={$wpdb->collate}");

$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}koko_analytics_referrer_stats");
$wpdb->query("CREATE TABLE {$wpdb->prefix}koko_analytics_referrer_stats (
   date DATE NOT NULL,
   id BIGINT(20) UNSIGNED NOT NULL,
   visitors INTEGER UNSIGNED NOT NULL,
   pageviews INTEGER UNSIGNED NOT NULL,
   PRIMARY KEY (date, id)
) ENGINE=INNODB CHARACTER SET={$wpdb->charset} COLLATE={$wpdb->collate}");

$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}koko_analytics_referrer_urls");
$wpdb->query("CREATE TABLE {$wpdb->prefix}koko_analytics_referrer_urls (
   id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   url VARCHAR(255) NOT NULL,
   UNIQUE INDEX (url)
) ENGINE=INNODB CHARACTER SET={$wpdb->charset} COLLATE={$wpdb->collate}");
