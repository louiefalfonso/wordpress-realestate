<?php
/**
 * @author  wpWax
 * @since   6.6
 * @version 6.7
 */

use \Directorist\Directorist_Single_Listing;

use \Directorist\Helper;

$listing = Directorist_Single_Listing::instance();

if ( ! defined( 'ABSPATH' ) ) exit;

get_header( 'directorist' );



?>

<div class="directorist-single space-top space-extra-bottom arrow-wrap <?php Helper::directorist_container(); ?>">
	<?php Helper::get_template( 'single-contents' ); 
	if( class_exists('ReduxFramework') ) {
		$realar_listing_archive     =  realar_opt('realar_listing_archive');

		if( $realar_listing_archive == 'own' ){
			the_content( ); 

			echo '<div class="row gx-30">';
				echo '<div class="col-xxl-8 col-lg-7">';
					echo '<h3 class="page-title mt-20 mb-30">'.esc_html__('Property Review','realar').'</h3>';
					comments_template();
				echo '</div>';
			echo '</div>';
		}else{

			$listing->header_template();
			

			foreach ( $listing->content_data as $section ) {
				$listing->section_template( $section );
			}
		}
	}
	?>
</div>

<?php
get_footer( 'directorist' );