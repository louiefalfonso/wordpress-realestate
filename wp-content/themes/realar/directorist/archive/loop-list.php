<?php
/**
 * @author  wpWax
 * @since   6.6
 * @version 6.7
 */
use \Directorist\Helper;

if ( ! defined( 'ABSPATH' ) ) exit;
$id = get_the_ID();

$loop_fields = $listings->loop['list_fields']['template_data']['list_view_with_thumbnail'];

if( class_exists('ReduxFramework') ) {
    $realar_listing_archive     =  realar_opt('realar_listing_archive');
} else {
    $realar_listing_archive     = '0';
}





if( $realar_listing_archive == 'default' ){
?>

	<div class="directorist-listing-single directorist-listing-list directorist-listing-has-thumb <?php echo esc_attr( $listings->loop_wrapper_class() ); ?>">

		<figure class="directorist-listing-single__thumb">
			<?php $listings->loop_thumb_card_template(); ?>
			<div class="directorist-thumb-top-right"><?php $listings->render_loop_fields($loop_fields['thumbnail']['top_right']); ?></div>
		</figure>

		<div class="directorist-listing-single__content">

			<div class="directorist-listing-single__info">
				<div class="directorist-listing-single__info--top"><?php $listings->render_loop_fields($loop_fields['body']['top']); ?></div>
				<div class="directorist-listing-single__info--list"><ul><?php $listings->render_loop_fields($loop_fields['body']['bottom'], '<li>', '</li>'); ?></ul></div>
				<div class="directorist-listing-single__info--excerpt"><?php $listings->render_loop_fields($loop_fields['body']['excerpt']); ?></div>
				<div class="directorist-listing-single__info--right"><?php $listings->render_loop_fields($loop_fields['body']['right']); ?></div>
			</div>

			<div class="directorist-listing-single__meta">
				<div class="directorist-listing-single__meta--left"><?php $listings->render_loop_fields($loop_fields['footer']['left']); ?></div>
				<div class="directorist-listing-single__meta--right"><?php $listings->render_loop_fields($loop_fields['footer']['right']); ?></div>
			</div>

		</div>

	</div>
	<?php
}else{
	$bed =  realar_meta('realar_bed_count') ? realar_meta('realar_bed_count') : ' --';
	$bed_label = realar_opt('realar_listing_bed_text') ? realar_opt('realar_listing_bed_text') : 'Bed ';

	$bath =  realar_meta('realar_bath_count') ? realar_meta('realar_bath_count') : ' --';
	$bath_label = realar_opt('realar_listing_bath_text') ? realar_opt('realar_listing_bath_text') : 'Bath ';

	$sqft =  realar_meta('realar_room_size') ? realar_meta('realar_room_size') : ' --';
	$sqft_label =  realar_meta('realar_listing_sqft_text') ? realar_meta('realar_listing_sqft_text') : ' sqft';



	$short_desc =  realar_meta('realar_short_description');
	$button_text = realar_opt('realar_listing_readmore') ? realar_opt('realar_listing_readmore') : 'Details';
	?>
	<div class="property-card-wrap style-dark">

       <?php $listings->loop_thumb_card_template(); ?>

        <div class="property-card style-dark">
            <div class="property-card-number"><?php echo esc_html( 'ID'.'-' ).get_the_id(); ?></div>
            <div class="property-card-details">
            	<?php if ( ! empty( $listings->loop['cats'] ) ) {
					$term_icon  = get_term_meta( $listings->loop['cats'][0]->term_id, 'category_icon', true );
					$term_icon  = $term_icon ? $term_icon : '';
					$term_link  = esc_url( get_term_link( $listings->loop['cats'][0]->term_id, ATBDP_CATEGORY ) );
					$term_label = $listings->loop['cats'][0]->name;
					?>
					<a href="<?php echo esc_url( $term_link ); ?>" class="property-card-subtitle"><?php directorist_icon( $term_icon );?><?php echo esc_html( $term_label ); ?></a>
					<?php
					$totalTerm = count($listings->loop['cats']);
					if ( $totalTerm > 1 ) { $totalTerm = $totalTerm - 1; ?>
						<div class="directorist-listing-category__popup">
							<span class="directorist-listing-category__extran-count">+<?php echo esc_html( $totalTerm ); ?></span>
							<div class="directorist-listing-category__popup__content"><span class="property-card-subtitle">
								<?php
								foreach (array_slice($listings->loop['cats'], 1) as $cat) {
									$term_icon  = get_term_meta( $cat->term_id, 'category_icon', true );
									$term_icon  = $term_icon ? $term_icon : '';
									$term_link  = esc_url( ATBDP_Permalink::atbdp_get_category_page( $cat ) );
									$term_link  = esc_url( get_term_link( $cat->term_id, ATBDP_CATEGORY ) );
									$term_label = $cat->name;
									?>

									<a href="<?php echo esc_url( $term_link );?>" class="property-card-subtitle"><?php directorist_icon( $term_icon );?> <?php echo esc_html( $term_label ); ?></a>

									<?php
								}
								?>
							</span></div>

						</div>
						<?php
					}
				}else { ?>
					<span class="property-card-subtitle"><?php esc_html_e('Uncategorized', 'realar'); ?></span>
					
				<?php } ?>
				

                <h4 class="property-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <?php 

                	if( !empty( $short_desc ) ){
                		echo '<p class="property-card-text">'.esc_html( $short_desc ).'</p>';
                	}

                ?>
                
                <div class="property-card-price-meta">
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
                    <div class="property-ratting-wrap">
                        <div class="star-ratting">
                            <?php echo wp_kses_post( $listings->loop['review']['review_stars'] ); ?>
                            <?php echo esc_html( $listings->loop['review']['average_reviews'] ); ?>
                        </div>
                    </div>
                </div>
                <div class="property-card-meta">
                    
                	<?php
                	echo '<span>';
                    	if(!empty(realar_opt('realar_listing_bed_icon', 'url' ) )){
	                    	echo '<img src="'.esc_url( realar_opt('realar_listing_bed_icon', 'url' ) ).'" alt="'.esc_attr__('image', 'realar').'">';
	                    }
	                    echo esc_html( $bed_label.$bed );
                	echo '</span>';

                    

                    echo '<span>';
                    	if(!empty(realar_opt('realar_listing_bath_icon', 'url' ) )){
	                    	echo '<img src="'.esc_url( realar_opt('realar_listing_bath_icon', 'url' ) ).'" alt="'.esc_attr__('image', 'realar').'">';
	                    }
	                    echo esc_html( $bath_label.$bath );
                	echo '</span>';

                	

                    echo '<span>';
                    	if(!empty(realar_opt('realar_listing_sqft_icon', 'url' ) )){
	                    	echo '<img src="'.esc_url( realar_opt('realar_listing_sqft_icon', 'url' ) ).'" alt="'.esc_attr__('image', 'realar').'">';
	                    }
	                    echo esc_html( $sqft.$sqft_label );
                	echo '</span>'; ?>


                    
                </div>
                <div class="property-btn-wrap">
                    <div class="property-author-wrap">
                        <?php if ($listings->loop['u_pro_pic']) { ?>
							<img src="<?php echo esc_url($listings->loop['u_pro_pic'][0]); ?>" alt="<?php esc_attr_e( 'Author Image', 'realar' );?>">
							<?php
						}
						else {
							echo wp_kses_post( $listings->loop['avatar_img'] );
						}?>
                        <a href="<?php echo esc_url( $listings->loop['author_link'] ); ?>"><?php echo esc_html($listings->loop['author_full_name'] ); ?></a>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="th-btn style-border2 th-btn-icon"><?php echo esc_html( $button_text ) ?></a>
                </div>
            </div>
        </div>
    </div>
    <?php
}