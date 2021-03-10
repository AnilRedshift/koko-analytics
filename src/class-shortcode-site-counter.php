<?php
/**
 * @package koko-analytics
 * @license GPL-3.0+
 * @author Anil Kulkarni
 */

namespace KokoAnalytics;

 class ShortCode_Site_Counter {
	const SHORTCODE = 'koko_analytics_site_counter';

  public function init() {
		add_shortcode( self::SHORTCODE, array( $this, 'content' ) );
	}

  public function content( $args ) {
    $default_args = array(
      'days' => -1,
    );
    $args = shortcode_atts( $default_args, $args, self::SHORTCODE );
    $count = $this->get_total_views($args['days']);
    $html = sprintf( PHP_EOL . ' <span class="koko-analytics-post-count">Visitors: %s</span>', $count );
    return $html;
  }

  private function get_total_views( $days) {
    global $wpdb;
    if ($days == -1) {
      $sql = "SELECT SUM(visitors) FROM {$wpdb->prefix}koko_analytics_site_stats";
    } else {
      $timezone = get_option( 'timezone_string', 'UTC' );
      $datetime = new \DateTime('now', new \DateTimeZone($timezone));
      $datetime->modify(sprintf( '-%d days', $days));
      $start_date = $datetime->format('Y-m-d');
      $sql = $wpdb->prepare("SELECT SUM(visitors) FROM {$wpdb->prefix}koko_analytics_site_stats s WHERE s.date >= %s", array( $start_date ) );
    }
    return $wpdb->get_var( $sql ) || 0;
  }
}
