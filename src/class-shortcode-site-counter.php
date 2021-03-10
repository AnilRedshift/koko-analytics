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
    $count = get_total_views($args['days']);
    $html = sprintf( PHP_EOL . ' <span class="koko-analytics-post-count">Visitors: %s</span>', $count );
    return $html;
  }

}
