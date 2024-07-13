<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
/**
 *
 * Blog Post Widget .
 *
 */
class realar_Blog extends Widget_Base {

	public function get_name() {
		return 'realarblog';
	}
	public function get_title() {
		return __( 'Blog Post', 'realar' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'realar' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'blog_post_section',
			[
				'label' => __( 'Blog Post', 'realar' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
        );

        realar_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three' ] );

        $this->add_control(
			'blog_post_count',
			[
				'label' 	=> __( 'No of Post to show', 'realar' ),
                'type' 		=> Controls_Manager::NUMBER,
                'min'       => 1,
                'max'       => count( get_posts( array('post_type' => 'post', 'post_status' => 'publish', 'fields' => 'ids', 'posts_per_page' => '-1') ) ),
                'default'  	=> __( '4', 'realar' )
			]
        );

        realar_general_fields( $this, 'title_count', 'Title Length', 'TEXT2', '6');
        realar_general_fields( $this, 'excerpt_count', 'Excerpt Length', 'TEXT', '14', ['1']);
        realar_general_fields( $this, 'read_text', 'Reading Text', 'TEXT', ' min read', ['2','3']);

        $this->add_control(
			'blog_post_order',
			[
				'label' 	=> __( 'Order', 'realar' ),
                'type' 		=> Controls_Manager::SELECT,
                'options'   => [
                    'ASC'   	=> __('ASC','realar'),
                    'DESC'   	=> __('DESC','realar'),
                ],
                'default'  	=> 'DESC'
			]
        );
        $this->add_control(
			'blog_post_order_by',
			[
				'label' 	=> __( 'Order By', 'realar' ),
                'type' 		=> Controls_Manager::SELECT,
                'options'   => [
                    'ID'    	=> __( 'ID', 'realar' ),
                    'author'    => __( 'Author', 'realar' ),
                    'title'    	=> __( 'Title', 'realar' ),
                    'date'    	=> __( 'Date', 'realar' ),
                    'rand'    	=> __( 'Random', 'realar' ),
                ],
                'default'  	=> 'ID'
			]
        );
        $this->add_control(
			'exclude_cats',
			[
				'label' 		=> __( 'Exclude Categories', 'realar' ),
                'type' 			=> Controls_Manager::SELECT2,
                'multiple' 		=> true,
				'options' 		=> $this->realar_get_categories(),
			]
        );
        $this->add_control(
			'exclude_tags',
			[
				'label' 		=> __( 'Exclude Tags', 'realar' ),
                'type' 			=> Controls_Manager::SELECT2,
                'multiple' 		=> true,
				'options' 		=> $this->realar_get_tags(),
			]
        );
        $this->add_control(
			'exclude_post_id',
			[
				'label'         => __( 'Exclude Post', 'realar' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
				'options'       => $this->realar_post_id(),
			]
        );

        realar_general_fields( $this, 'button_text', 'Read More Text', 'TEXTAREA2', 'Read More' );

        $this->end_controls_section();

		//---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Title Style-------
		realar_common2_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .box-title', '', 'color', '--theme-color' );

        $this->start_controls_section(
			'general_styling',
			[
				'label'     => __( 'Button', 'realar' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		realar_color_fields( $this, 'color', 'Color', '--theme-color', '{{WRAPPER}} .line-btn', ['1', '2'] );  
		realar_color_fields( $this, 'color2', 'Hover Color', '--title-color', '{{WRAPPER}} .line-btn:hover', ['1', '2']  );
		realar_color_fields( $this, 'color3', 'Color', '--body-color', '{{WRAPPER}} .line-btn', ['3'] );  
		realar_color_fields( $this, 'color4', 'Hover Color', '--theme-color', '{{WRAPPER}} .line-btn:hover', ['3']  );  

		$this->end_controls_section();

    }

    public function realar_get_categories() {
        $cats = get_terms(array(
            'taxonomy' => 'category',
            'hide_empty' => true,
        ));

        $cat = [];

        foreach( $cats as $singlecat ) {
            $cat[$singlecat->term_id] = __($singlecat->name,'realar');
        }

        return $cat;
    }

    public function realar_get_tags() {
        $tags = get_terms(array(
            'taxonomy' => 'post_tag',
            'hide_empty' => true,
        ));

        $tag = [];

        foreach( $tags as $singletag ) {
            $tag[$singletag->term_id] = __($singletag->name,'realar');
        }

        return $tag;
    }

    // Get Specific Post
    public function realar_post_id(){
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => -1,
        );

        $realar_post = new WP_Query( $args );

        $postarray = [];

        while( $realar_post->have_posts() ){
            $realar_post->the_post();
            $postarray[get_the_Id()] = get_the_title();
        }
        wp_reset_postdata();
        return $postarray;
    }

	protected function render() {

        $settings = $this->get_settings_for_display();
        $exclude_post = $settings['exclude_post_id'];

        if( !empty( $settings['exclude_cats'] ) && empty( $settings['exclude_tags'] ) && empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'category__not_in'      => $settings['exclude_cats']
            );
        } elseif( !empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'category__not_in'      => $settings['exclude_cats'],
                'tag__not_in'           => $settings['exclude_tags']
            );
        }elseif( !empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'category__not_in'      => $settings['exclude_cats'],
                'tag__not_in'           => $settings['exclude_tags'],
                'post__not_in'          => $exclude_post
            );
        } elseif( !empty( $settings['exclude_cats'] ) && empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'category__not_in'      => $settings['exclude_cats'],
                'post__not_in'          => $exclude_post
            );
        } elseif( empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'tag__not_in'           => $settings['exclude_tags'],
                'post__not_in'          => $exclude_post
            );
        } elseif( empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'tag__not_in'           => $settings['exclude_tags'],
            );
        } elseif( empty( $settings['exclude_cats'] ) && empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'post__not_in'          => $exclude_post
            );
        } else {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true
            );
        }

    $blogpost = new WP_Query( $args );

		if( $settings['layout_style'] == '1' ){

            while( $blogpost->have_posts() ){
                $blogpost->the_post(); 
                $categories = get_the_category();
                echo '<div class="blog-grid">';
                    echo '<div class="blog-img img-shine" data-mask-src="'.REALAR_PLUGDIRURI . 'assets/img/blog-card1-img-mask.png">';
                        the_post_thumbnail( 'realar_636X440' );
                    echo '</div>';
                    echo '<div class="blog-content">';
                        if ($categories) {
                            $first_category = $categories[0];
                            echo '<span class="subtitle">' . esc_html($first_category->name) . '</span>';
                        }
                        echo '<h3 class="box-title"><a href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count'], '' ) ).'</a></h3>';
                        echo '<p class="blog-text">'.esc_html( wp_trim_words( get_the_content(), $settings['excerpt_count'], '' ) ).'</p>';
                        echo '<div class="blog-bottom-wrap">';
                            echo '<div class="blog-author-wrap">';
                                echo '<div class="avatar">';
                                    echo realar_img_tag( array(
                                        "url"       => esc_url( get_avatar_url( get_the_author_meta('ID'), array() ) ),
                                        "width"     => 30,
                                        "height"    => 30,
                                    ) );
                                echo '</div>';
                                echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'">'.esc_html__('By ', 'realar') . esc_html( ucwords( get_the_author() ) ).'</a>';
                            echo '</div>';
                            echo '<div class="blog-date">'.esc_html( get_the_date( 'M d, Y' ) ).'</div>';
                            if(!empty($settings['button_text'])){
                                echo '<a href="'.esc_url( get_permalink() ).'" class="th-btn btn-mask2 th-btn-icon">'.esc_html($settings['button_text']).'</a>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            }
            wp_reset_postdata();
		}elseif( $settings['layout_style'] == '2' ){
            echo '<div class="slider-area blog-slider2">';
                echo '<div class="swiper th-slider" id="blogSlider2" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"2"}}}\'>';
                    echo '<div class="swiper-wrapper">';

                        while( $blogpost->have_posts() ){
                            $blogpost->the_post(); 
                            $categories = get_the_category();
                            $content = get_the_content();
                            $read_time = realar_calculate_read_time($content);
                        
                            echo '<div class="swiper-slide">';
                                echo '<div class="blog-card style2">';
                                    echo '<div class="blog-img">';
                                        the_post_thumbnail( 'realar_636X300' );
                                    echo '</div>';
                                    echo '<div class="blog-content">';
                                        echo '<div class="blog-meta">';
                                            echo '<a href="'.esc_url( realar_blog_date_permalink() ).'">'.esc_html( get_the_date( 'M d, Y' ) ).'</a>';
                                            echo '<a href="'.esc_url( get_permalink() ).'">'.esc_html($read_time).esc_html( $settings['read_text'] ).'</a>';
                                        echo '</div>';
                                        echo '<h3 class="box-title"><a href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count'], '' ) ).'</a></h3>';
                                        echo '<a href="'.esc_url( get_permalink() ).'" class="th-btn style-border th-btn-icon">'.esc_html($settings['button_text']).'</a>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                        wp_reset_postdata();
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }elseif( $settings['layout_style'] == '3' ){
            echo '<div class="slider-area">';
                echo '<div class="swiper th-slider has-shadow slider-drag-wrap" id="blogSlider3" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"},"1500":{"slidesPerView":"4"}},"autoHeight":true}\'>';
                    echo '<div class="swiper-wrapper">';


                        
                        while( $blogpost->have_posts() ){
                            $blogpost->the_post(); 
                            $categories = get_the_category();
                            $content = get_the_content();
                            $read_time = realar_calculate_read_time($content);
                        
                            echo '<div class="swiper-slide">';
                                echo '<div class="blog-card style3">';
                                    echo '<div class="blog-img">';
                                        the_post_thumbnail( 'realar_636X300' );
                                    echo '</div>';
                                    echo '<div class="blog-content">';
                                        echo '<div class="blog-meta">';
                                            echo '<a href="'.esc_url( realar_blog_date_permalink() ).'">'.esc_html( get_the_date( 'M d, Y' ) ).'</a>';
                                            echo '<a href="'.esc_url( get_permalink() ).'">'.esc_html($read_time).esc_html( $settings['read_text'] ).'</a>';
                                        echo '</div>';
                                        echo '<h3 class="box-title"><a href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count'], '' ) ).'</a></h3>';
                                        echo '<a href="'.esc_url( get_permalink() ).'" class="th-btn style-border2 th-btn-icon">'.esc_html($settings['button_text']).'</a>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        }
                        wp_reset_postdata();

                       

                    echo '</div>';
                echo '</div>';
            echo '</div>';

        }
	
      
	}
}