<?php
    /**
     * Class For Builder
     */
    class RealarBuilder{

        function __construct(){
            // register admin menus
        	add_action( 'admin_menu', [$this, 'register_settings_menus'] );

            // Custom Footer Builder With Post Type
			add_action( 'init',[ $this,'post_type' ],0 );

 		    add_action( 'elementor/frontend/after_enqueue_scripts', [ $this,'widget_scripts'] );

			add_filter( 'single_template', [ $this, 'load_canvas_template' ] );

            add_action( 'elementor/element/wp-page/document_settings/after_section_end', [ $this,'realar_add_elementor_page_settings_controls' ],10,2 );

		}

		public function widget_scripts( ) {
			wp_enqueue_script( 'realar-core',REALAR_PLUGDIRURI.'assets/js/realar-core.js',array( 'jquery' ),'1.0',true );
		}


        public function realar_add_elementor_page_settings_controls( \Elementor\Core\DocumentTypes\Page $page ){

			$page->start_controls_section(
                'realar_header_option',
                [
                    'label'     => __( 'Header Option', 'realar' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );


            $page->add_control(
                'realar_header_style',
                [
                    'label'     => __( 'Header Option', 'realar' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => [
    					'prebuilt'             => __( 'Pre Built', 'realar' ),
    					'header_builder'       => __( 'Header Builder', 'realar' ),
    				],
                    'default'   => 'prebuilt',
                ]
			);

            $page->add_control(
                'realar_header_builder_option',
                [
                    'label'     => __( 'Header Name', 'realar' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => $this->realar_header_choose_option(),
                    'condition' => [ 'realar_header_style' => 'header_builder'],
                    'default'	=> ''
                ]
            );

            $page->end_controls_section();

            $page->start_controls_section(
                'realar_footer_option',
                [
                    'label'     => __( 'Footer Option', 'realar' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );
            $page->add_control(
    			'realar_footer_choice',
    			[
    				'label'         => __( 'Enable Footer?', 'realar' ),
    				'type'          => \Elementor\Controls_Manager::SWITCHER,
    				'label_on'      => __( 'Yes', 'realar' ),
    				'label_off'     => __( 'No', 'realar' ),
    				'return_value'  => 'yes',
    				'default'       => 'yes',
    			]
    		);
            $page->add_control(
                'realar_footer_style',
                [
                    'label'     => __( 'Footer Style', 'realar' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => [
    					'prebuilt'             => __( 'Pre Built', 'realar' ),
    					'footer_builder'       => __( 'Footer Builder', 'realar' ),
    				],
                    'default'   => 'prebuilt',
                    'condition' => [ 'realar_footer_choice' => 'yes' ],
                ]
            );
            $page->add_control(
                'realar_footer_builder_option',
                [
                    'label'     => __( 'Footer Name', 'realar' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => $this->realar_footer_build_choose_option(),
                    'condition' => [ 'realar_footer_style' => 'footer_builder','realar_footer_choice' => 'yes' ],
                    'default'	=> ''
                ]
            );

			$page->end_controls_section();

        }

		public function register_settings_menus(){
			add_menu_page(
				esc_html__( 'Realar Builder', 'realar' ),
            	esc_html__( 'Realar Builder', 'realar' ),
				'manage_options',
				'realar',
				[$this,'register_settings_contents__settings'],
				'dashicons-admin-site',
				2
			);

			add_submenu_page('realar', esc_html__('Footer Builder', 'realar'), esc_html__('Footer Builder', 'realar'), 'manage_options', 'edit.php?post_type=realar_footerbuild');
			add_submenu_page('realar', esc_html__('Header Builder', 'realar'), esc_html__('Header Builder', 'realar'), 'manage_options', 'edit.php?post_type=realar_header');
			add_submenu_page('realar', esc_html__('Tab Builder', 'realar'), esc_html__('Tab Builder', 'realar'), 'manage_options', 'edit.php?post_type=realar_tab_builder');
		}

		// Callback Function
		public function register_settings_contents__settings(){
            echo '<h2>';
			    echo esc_html__( 'Welcome To Header And Footer Builder Of This Theme','realar' );
            echo '</h2>';
		}

		public function post_type() {

			$labels = array(
				'name'               => __( 'Footer', 'realar' ),
				'singular_name'      => __( 'Footer', 'realar' ),
				'menu_name'          => __( 'Realar Footer Builder', 'realar' ),
				'name_admin_bar'     => __( 'Footer', 'realar' ),
				'add_new'            => __( 'Add New', 'realar' ),
				'add_new_item'       => __( 'Add New Footer', 'realar' ),
				'new_item'           => __( 'New Footer', 'realar' ),
				'edit_item'          => __( 'Edit Footer', 'realar' ),
				'view_item'          => __( 'View Footer', 'realar' ),
				'all_items'          => __( 'All Footer', 'realar' ),
				'search_items'       => __( 'Search Footer', 'realar' ),
				'parent_item_colon'  => __( 'Parent Footer:', 'realar' ),
				'not_found'          => __( 'No Footer found.', 'realar' ),
				'not_found_in_trash' => __( 'No Footer found in Trash.', 'realar' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'realar_footerbuild', $args );

			$labels = array(
				'name'               => __( 'Header', 'realar' ),
				'singular_name'      => __( 'Header', 'realar' ),
				'menu_name'          => __( 'Realar Header Builder', 'realar' ),
				'name_admin_bar'     => __( 'Header', 'realar' ),
				'add_new'            => __( 'Add New', 'realar' ),
				'add_new_item'       => __( 'Add New Header', 'realar' ),
				'new_item'           => __( 'New Header', 'realar' ),
				'edit_item'          => __( 'Edit Header', 'realar' ),
				'view_item'          => __( 'View Header', 'realar' ),
				'all_items'          => __( 'All Header', 'realar' ),
				'search_items'       => __( 'Search Header', 'realar' ),
				'parent_item_colon'  => __( 'Parent Header:', 'realar' ),
				'not_found'          => __( 'No Header found.', 'realar' ),
				'not_found_in_trash' => __( 'No Header found in Trash.', 'realar' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'realar_header', $args );

			$labels = array(
				'name'               => __( 'Tab Builder', 'realar' ),
				'singular_name'      => __( 'Tab Builder', 'realar' ),
				'menu_name'          => __( 'Gesund Tab Builder', 'realar' ),
				'name_admin_bar'     => __( 'Tab Builder', 'realar' ),
				'add_new'            => __( 'Add New', 'realar' ),
				'add_new_item'       => __( 'Add New Tab Builder', 'realar' ),
				'new_item'           => __( 'New Tab Builder', 'realar' ),
				'edit_item'          => __( 'Edit Tab Builder', 'realar' ),
				'view_item'          => __( 'View Tab Builder', 'realar' ),
				'all_items'          => __( 'All Tab Builder', 'realar' ),
				'search_items'       => __( 'Search Tab Builder', 'realar' ),
				'parent_item_colon'  => __( 'Parent Tab Builder:', 'realar' ),
				'not_found'          => __( 'No Tab Builder found.', 'realar' ),
				'not_found_in_trash' => __( 'No Tab Builder found in Trash.', 'realar' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'realar_tab_builder', $args );
		}

		function load_canvas_template( $single_template ) {

			global $post;

			if ( 'realar_footerbuild' == $post->post_type || 'realar_header' == $post->post_type || 'realar_tab_build' == $post->post_type ) {

				$elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

				if ( file_exists( $elementor_2_0_canvas ) ) {
					return $elementor_2_0_canvas;
				} else {
					return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
				}
			}

			return $single_template;
		}

        public function realar_footer_build_choose_option(){

			$realar_post_query = new WP_Query( array(
				'post_type'			=> 'realar_footerbuild',
				'posts_per_page'	    => -1,
			) );

			$realar_builder_post_title = array();
			$realar_builder_post_title[''] = __('Select a Footer','realar');

			while( $realar_post_query->have_posts() ) {
				$realar_post_query->the_post();
				$realar_builder_post_title[ get_the_ID() ] =  get_the_title();
			}
			wp_reset_postdata();

			return $realar_builder_post_title;

		}

		public function realar_header_choose_option(){

			$realar_post_query = new WP_Query( array(
				'post_type'			=> 'realar_header',
				'posts_per_page'	    => -1,
			) );

			$realar_builder_post_title = array();
			$realar_builder_post_title[''] = __('Select a Header','realar');

			while( $realar_post_query->have_posts() ) {
				$realar_post_query->the_post();
				$realar_builder_post_title[ get_the_ID() ] =  get_the_title();
			}
			wp_reset_postdata();

			return $realar_builder_post_title;

        }

    }

    $builder_execute = new RealarBuilder();