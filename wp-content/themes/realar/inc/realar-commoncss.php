<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit();
}
/**
 * @Packge     : Realar
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */

// enqueue css
function realar_common_custom_css(){
	wp_enqueue_style( 'realar-color-schemes', get_template_directory_uri().'/assets/css/color.schemes.css' );

    $CustomCssOpt  = realar_opt( 'realar_css_editor' );
	if( $CustomCssOpt ){
		$CustomCssOpt = $CustomCssOpt;
	}else{
		$CustomCssOpt = '';
	}

    $customcss = "";
    
    if( get_header_image() ){
        $realar_header_bg =  get_header_image();
    }else{
        if( realar_meta( 'page_breadcrumb_settings' ) == 'page' ){
            if( ! empty( realar_meta( 'breadcumb_image' ) ) ){
                $realar_header_bg = realar_meta( 'breadcumb_image' );
            }
        }
    }
    
    if( !empty( $realar_header_bg ) ){
        $customcss .= ".breadcumb-wrapper{
            background-image:url('{$realar_header_bg}')!important;
        }";
    }
    
	// Theme color
	$realarthemecolor = realar_opt('realar_theme_color'); 
    if( !empty( $realarthemecolor ) ){
        list($r, $g, $b) = sscanf( $realarthemecolor, "#%02x%02x%02x");

        $realar_real_color = $r.','.$g.','.$b;
        if( !empty( $realarthemecolor ) ) {
            $customcss .= ":root {
            --theme-color: rgb({$realar_real_color});
            }";
        }
    }
    // Heading  color
	$realarheadingcolor = realar_opt('realar_heading_color');
    if( !empty( $realarheadingcolor ) ){
        list($r, $g, $b) = sscanf( $realarheadingcolor, "#%02x%02x%02x");

        $realar_real_color = $r.','.$g.','.$b;
        if( !empty( $realarheadingcolor ) ) {
            $customcss .= ":root {
                --title-color: rgb({$realar_real_color});
            }";
        }
    }
    // Body color
	$realarbodycolor = realar_opt('realar_body_color');
    if( !empty( $realarbodycolor ) ){
        list($r, $g, $b) = sscanf( $realarbodycolor, "#%02x%02x%02x");

        $realar_real_color = $r.','.$g.','.$b;
        if( !empty( $realarbodycolor ) ) {
            $customcss .= ":root {
                --body-color: rgb({$realar_real_color});
            }";
        }
    }

     // Body font
     $realarbodyfont = realar_opt('realar_theme_body_font', 'font-family');
     if( !empty( $realarbodyfont ) ) {
         $customcss .= ":root {
             --body-font: $realarbodyfont ;
         }";
     }
 
     // Heading font
     $realarheadingfont = realar_opt('realar_theme_heading_font', 'font-family');
     if( !empty( $realarheadingfont ) ) {
         $customcss .= ":root {
             --title-font: $realarheadingfont ;
         }";
     }


    if(realar_opt('realar_menu_icon_class')){
        $menu_icon_class = realar_opt( 'realar_menu_icon_class' );
    }else{
        $menu_icon_class = 'e00d';
    }

    if( !empty( $menu_icon_class ) ) {
        $customcss .= ":root {
            .main-menu ul.sub-menu li a:before {
                content: \"\\$menu_icon_class\";
            }
        }";
    }

	if( !empty( $CustomCssOpt ) ){
		$customcss .= $CustomCssOpt;
	}

    wp_add_inline_style( 'realar-color-schemes', $customcss );
}
add_action( 'wp_enqueue_scripts', 'realar_common_custom_css', 100 );