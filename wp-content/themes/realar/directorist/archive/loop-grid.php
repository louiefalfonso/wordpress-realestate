<?php
/**
 * @author  wpWax
 * @since   6.6
 * @version 6.7
 */
use \Directorist\Helper;

if ( ! defined( 'ABSPATH' ) ) exit;

$id = get_the_ID();

$loop_fields = $listings->loop['card_fields']['template_data']['grid_view_with_thumbnail'];

if( class_exists('ReduxFramework') ) {
    $realar_listing_archive     =  realar_opt('realar_listing_archive');
} else {
    $realar_listing_archive     = '0';
}





if( $realar_listing_archive == 'default' ){
?>

	<div class="directorist-listing-single directorist-listing-card directorist-listing-has-thumb <?php echo esc_attr( $listings->loop_wrapper_class() ); ?>">

		<figure class="directorist-listing-single__thumb">

			<?php
			$listings->loop_thumb_card_template();
			$listings->render_loop_fields($loop_fields['thumbnail']['avatar']);
			?>

			<div class="directorist-thumb-top-left"><?php $listings->render_loop_fields($loop_fields['thumbnail']['top_left']); ?></div>
			<div class="directorist-thumb-top-right"><?php $listings->render_loop_fields($loop_fields['thumbnail']['top_right']); ?></div>
			<div class="directorist-thumb-bottom-left"><?php $listings->render_loop_fields($loop_fields['thumbnail']['bottom_left']); ?></div>
			<div class="directorist-thumb-bottom-right"><?php $listings->render_loop_fields($loop_fields['thumbnail']['bottom_right']); ?></div>
			
		</figure>

		<div class="directorist-listing-single__content">

			<div class="directorist-listing-single__info">
				<div class="directorist-listing-single__info--top"><?php $listings->render_loop_fields($loop_fields['body']['top']); ?></div>
				<div class="directorist-listing-single__info--list"><ul><?php $listings->render_loop_fields($loop_fields['body']['bottom'], '<li>', '</li>'); ?></ul></div>
				<div class="directorist-listing-single__info--excerpt"><?php $listings->render_loop_fields($loop_fields['body']['excerpt']); ?></div>
			</div>

			<div class="directorist-listing-single__meta">
				<div class="directorist-listing-single__meta--left"><?php $listings->render_loop_fields($loop_fields['footer']['left']); ?></div>
				<div class="directorist-listing-single__meta--right"><?php $listings->render_loop_fields($loop_fields['footer']['right']); ?></div>
			</div>

		</div>

	</div><?php
}else{ ?>
	<div class="property-card-thumb img-shine">
        <?php $listings->loop_thumb_card_template(); ?>
    </div>
    <div class="property-card-details">
        <div class="media-left">
            <h4 class="property-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

            <h5 class="property-card-price">
				<?php
				if ( 'range' === Helper::pricing_type( $id ) ) {
					Helper::price_range_template( $id );
				}
				elseif ( !$listings->is_disable_price ) {
					Helper::price_template( $id );
				}
				?>
			</h5>
            <?php
            if( !empty( realar_meta('realar_address') ) ){
            	echo '<p class="property-card-location">'.esc_html( realar_meta('realar_address') ).'</p>';
            }else{ ?>
            	<p class="property-card-location"><?php directorist_the_locations(); ?></p>
            	<?php

            } ?>
        </div>
        <div class="btn-wrap">
        	<?php $button_text = realar_opt('realar_listing_readmore') ? realar_opt('realar_listing_readmore') : 'Details'; ?>
            <a href="<?php the_permalink(); ?>" class="th-btn style-border2 th-btn-icon"><?php echo esc_html( $button_text ) ?></a>
        </div>
    </div>
    <?php
}