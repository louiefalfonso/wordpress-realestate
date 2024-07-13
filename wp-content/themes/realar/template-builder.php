<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( );
}
/**
 * @Packge    : Realar
 * @version   : 1.0
 * @Author    : Themeholy
 * @Author URI: https://themeforest.net/user/themeholy
 * Template Name: Template Builder
 */

//Header
get_header();

// Container or wrapper div
$realar_layout = realar_meta( 'custom_page_layout' );

if( $realar_layout == '1' ){ ?>
	<div class="realar-main-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
<?php }elseif( $realar_layout == '2' ){ ?>
    <div class="realar-main-wrapper">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
<?php }else{ ?>
	<div class="realar-fluid">
<?php } ?>
	<div class="builder-page-wrapper">
	<?php 
	// Query
	if( have_posts() ){
		while( have_posts() ){
			the_post();
			the_content();
		}
        wp_reset_postdata();
	} ?>

	</div>
<?php if( $realar_layout == '1' ){ ?>
				</div>
			</div>
		</div>
	</div>
<?php }elseif( $realar_layout == '2' ){ ?>
				</div>
			</div>
		</div>
	</div>
<?php }else{ ?>
	</div>
<?php }

//footer
get_footer();