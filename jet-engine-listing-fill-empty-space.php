<?php
/**
 * Plugin Name: JetEngine - fill empty space in the Listing grid
 * Plugin URI:  
 * Description: Adds placeholders for missed items if Listing items to show is less than requested items number
 * Version:     1.0.0
 * Author:      Crocoblock
 * Author URI:  https://crocoblock.com/
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

class Jet_Engine_Listing_Fill_Empty_Space {

	public function __construct() {

		add_action( 'init', array( $this, 'setup' ) );
		add_action( 'jet-engine/listing/after-grid-item', array( $this, 'handle_items' ), 10, 3 );

	}

	/**
	 * These constants could be defined from functions.php file of your active theme
	 * @return [type] [description]
	 */
	public function setup() {

		if ( ! defined( 'JET_ENGINE_FILL_LISTING_FOR_QUERY_ID' ) ) {
			// Set Query ID to fill empty items for
			define( 'JET_ENGINE_FILL_LISTING_FOR_QUERY_ID', 'fill_empty' );
		}
		
		if ( ! defined( 'JET_ENGINE_FILL_LISTING_COLOR' ) ) {
			// color of placeholder. You can use plain color string or Elementor global color name
			define( 'JET_ENGINE_FILL_LISTING_COLOR', '#eee' );
		}

		if ( ! defined( 'JET_ENGINE_FILL_LISTING_PLACEHOLDER_HTML' ) ) {
			// Set html markup for placeholder
			define( 'JET_ENGINE_FILL_LISTING_PLACEHOLDER_HTML', '<div class="jet-engine-fill-box"></div>' );
		}

		if ( ! defined( 'JET_ENGINE_FILL_LISTING_PLACEHOLDER_HEIGHT' ) ) {
			// Set custom height for placeholder
			define( 'JET_ENGINE_FILL_LISTING_PLACEHOLDER_HEIGHT', false );
		}

	}

	public function handle_items( $post, $listing, $index ) {

		if ( empty( $listing->query_vars['request']['query_id'] ) ) {
			return;
		}

		$query = \Jet_Engine\Query_Builder\Manager::instance()->get_query_by_id( $listing->query_vars['request']['query_id'] );

		if ( ! $query ) {
			return;
		}

		if ( ! $query->query_id || JET_ENGINE_FILL_LISTING_FOR_QUERY_ID !== $query->query_id ) {
			return;
		}

		$per_page = $query->get_items_per_page();
		$visible_items = $query->get_items_page_count();

		if ( $visible_items >= $per_page || $visible_items !== $index ) {
			return;
		}

		for ( $i = 0; $i < ( $per_page - $visible_items ); $i++ ) { 
			
			echo '<div class="jet-listing-grid__item jet-engine-fill-wrap fill-query-' . $listing->query_vars['request']['query_id'] . '">';
			echo '<div class="jet-engine-fill-wrap">';
			echo JET_ENGINE_FILL_LISTING_PLACEHOLDER_HTML;
			echo '</div>';
			echo '</div>';

			if ( 0 === $i ) {

				$height = JET_ENGINE_FILL_LISTING_PLACEHOLDER_HEIGHT ? JET_ENGINE_FILL_LISTING_PLACEHOLDER_HEIGHT : '100%';
				$color  = JET_ENGINE_FILL_LISTING_COLOR;

				echo '<style>
				.jet-listing-grid__item.fill-query-' . $listing->query_vars['request']['query_id'] . ' .jet-engine-fill-wrap {
					height: ' . $height . ';
					display: flex;
					flex-direction: column;
					justify-content: flex-start;
				}
				.jet-listing-grid__item.fill-query-' . $listing->query_vars['request']['query_id'] . ' .jet-engine-fill-box {
					background-color: ' . $color . ';
					flex: 1 1 auto;
				}
				
				</style>';
			}

		}

		
	}

}

new Jet_Engine_Listing_Fill_Empty_Space();
