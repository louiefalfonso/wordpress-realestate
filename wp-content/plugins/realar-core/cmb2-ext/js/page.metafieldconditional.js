(function($){
    "use strict";
    
    let $realar_page_breadcrumb_area      = $("#_realar_page_breadcrumb_area");
    let $realar_page_settings             = $("#_realar_page_breadcrumb_settings");
    let $realar_page_breadcrumb_image     = $("#_realar_breadcumb_image");
    let $realar_page_title                = $("#_realar_page_title");
    let $realar_page_title_settings       = $("#_realar_page_title_settings");

    if( $realar_page_breadcrumb_area.val() == '1' ) {
        $(".cmb2-id--realar-page-breadcrumb-settings").show();
        if( $realar_page_settings.val() == 'global' ) {
            $(".cmb2-id--realar-breadcumb-image").hide();
            $(".cmb2-id--realar-page-title").hide();
            $(".cmb2-id--realar-page-title-settings").hide();
            $(".cmb2-id--realar-custom-page-title").hide();
            $(".cmb2-id--realar-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--realar-breadcumb-image").show();
            $(".cmb2-id--realar-page-title").show();
            $(".cmb2-id--realar-page-breadcrumb-trigger").show();
    
            if( $realar_page_title.val() == '1' ) {
                $(".cmb2-id--realar-page-title-settings").show();
                if( $realar_page_title_settings.val() == 'default' ) {
                    $(".cmb2-id--realar-custom-page-title").hide();
                } else {
                    $(".cmb2-id--realar-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--realar-page-title-settings").hide();
                $(".cmb2-id--realar-custom-page-title").hide();
    
            }
        }
    } else {
        $realar_page_breadcrumb_area.parents('.cmb2-id--realar-page-breadcrumb-area').siblings().hide();
    }


    // breadcrumb area
    $realar_page_breadcrumb_area.on("change",function(){
        if( $(this).val() == '1' ) {
            $(".cmb2-id--realar-page-breadcrumb-settings").show();
            if( $realar_page_settings.val() == 'global' ) {
                $(".cmb2-id--realar-breadcumb-image").hide();
                $(".cmb2-id--realar-page-title").hide();
                $(".cmb2-id--realar-page-title-settings").hide();
                $(".cmb2-id--realar-custom-page-title").hide();
                $(".cmb2-id--realar-page-breadcrumb-trigger").hide();
            } else {
                $(".cmb2-id--realar-breadcumb-image").show();
                $(".cmb2-id--realar-page-title").show();
                $(".cmb2-id--realar-page-breadcrumb-trigger").show();
        
                if( $realar_page_title.val() == '1' ) {
                    $(".cmb2-id--realar-page-title-settings").show();
                    if( $realar_page_title_settings.val() == 'default' ) {
                        $(".cmb2-id--realar-custom-page-title").hide();
                    } else {
                        $(".cmb2-id--realar-custom-page-title").show();
                    }
                } else {
                    $(".cmb2-id--realar-page-title-settings").hide();
                    $(".cmb2-id--realar-custom-page-title").hide();
        
                }
            }
        } else {
            $(this).parents('.cmb2-id--realar-page-breadcrumb-area').siblings().hide();
        }
    });

    // page title
    $realar_page_title.on("change",function(){
        if( $(this).val() == '1' ) {
            $(".cmb2-id--realar-page-title-settings").show();
            if( $realar_page_title_settings.val() == 'default' ) {
                $(".cmb2-id--realar-custom-page-title").hide();
            } else {
                $(".cmb2-id--realar-custom-page-title").show();
            }
        } else {
            $(".cmb2-id--realar-page-title-settings").hide();
            $(".cmb2-id--realar-custom-page-title").hide();

        }
    });

    //page settings
    $realar_page_settings.on("change",function(){
        if( $(this).val() == 'global' ) {
            $(".cmb2-id--realar-breadcumb-image").hide();
            $(".cmb2-id--realar-page-title").hide();
            $(".cmb2-id--realar-page-title-settings").hide();
            $(".cmb2-id--realar-custom-page-title").hide();
            $(".cmb2-id--realar-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--realar-breadcumb-image").show();
            $(".cmb2-id--realar-page-title").show();
            $(".cmb2-id--realar-page-breadcrumb-trigger").show();
    
            if( $realar_page_title.val() == '1' ) {
                $(".cmb2-id--realar-page-title-settings").show();
                if( $realar_page_title_settings.val() == 'default' ) {
                    $(".cmb2-id--realar-custom-page-title").hide();
                } else {
                    $(".cmb2-id--realar-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--realar-page-title-settings").hide();
                $(".cmb2-id--realar-custom-page-title").hide();
    
            }
        }
    });

    // page title settings
    $realar_page_title_settings.on("change",function(){
        if( $(this).val() == 'default' ) {
            $(".cmb2-id--realar-custom-page-title").hide();
        } else {
            $(".cmb2-id--realar-custom-page-title").show();
        }
    });
    
})(jQuery);