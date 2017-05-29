<?php
namespace voidgrid\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * @since 1.0.0
 */

class Void_Post_Grid extends Widget_Base {   //this name is added to plugin.php of the root folder

	public function get_name() {
		return 'void-post-grid';
	}

	public function get_title() {
		return 'Void Post Grid';   // title to show on elementor
	}

	public function get_icon() {
		return 'fa fa-suitcase';    
	}

	public function get_categories() {
		return [ 'void-theme-elements' ];    // category of the widget
	}

	public function is_reload_preview_required() {
		return true;   
	}

	public function get_script_depends() {		//load the dependent scripts defined in the voidgrid-elements.php
		return [ 'void-grid-equal-height-js', 'void-grid-custom-js' ];
	}

	/**
	 * A list of scripts that the widgets is depended in
	 * @since 1.3.0
	 **/
protected function _register_controls() {
		
//start of a control box
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Post Grid Setting', 'voidgrid' ),   //section name for controler view
			]
		);

		$this->add_control(
			'refer_wp_org',
			[
				'raw' => __( 'For more detail about following filters please refer <a href="https://codex.wordpress.org/Template_Tags/get_posts" target="_blank">here</a>', 'voidgrid' ),
				'type' => Controls_Manager::RAW_HTML,
				'classes' => 'elementor-descriptor',
			]
		);

	   $this->add_control(
            'display_type',
            [
                'label' => esc_html__( 'Choose your desired style', 'voidgrid' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Grid Layout', 
                    '2' => 'List Layout', 
                    '3' => '1st Full Post then Grid',
                    '4' => '1st Full Post then List',
                    '5' => 'Minimal Grid'
                ],
                'default' => '1'
            ]
        );

        $this->add_control(
            'posts_per_row',
            [
                'label' => esc_html__( 'Posts Per Row', 'voidgrid' ),
                'type' => Controls_Manager::SELECT,
                'condition' => [
                    'display_type' => ['1','5'],
                ],
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '6' => '6',
                ],
                'default' => '2',
            ]
        );
		$this->add_control(
			'posts',     
			[
				'label' => esc_html__( 'Number of Post', 'voidgrid' ),
				'description' => esc_html__( 'Give -1 for all post', 'voidgrid' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 1,
			]
		);
		
	 	
		$this->add_control(
			'category',
			[
				'label' => __( 'Select Category', 'voidgrid' ),
				'type' => Controls_Manager::SELECT2,
				'options' => void_grid_get_category_post(),
				'multiple' => true,
			]
		);



        $this->add_control(
            'offset',
            [
                'label' => esc_html__( 'Post Offset', 'voidgrid' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '0'
            ]
        );

    	$this->add_control(
            'orderby',
            [
                'label' => esc_html__( 'Order By', 'voidgrid' ),
                'type' => Controls_Manager::SELECT,
                'options' => voidgrid_post_orderby_options(),
                'default' => 'date',

            ]
        );
        $this->add_control(
            'image_style',
            [
                'label' => esc_html__('Choose your desired featured image style', 'voidgrid'),
                'type'  => Controls_Manager::SELECT2,
                'options' => [
                    '1' => 'Standard',
                    '2' => 'left top rounded',
                    '3' => 'left bottom rounded'
                ],
                'default'   => '1',
            ]
        );
        $this->add_control(
            'order',
            [
                'label' => esc_html__( 'Order', 'voidgrid' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending'
                ],
                'default' => 'desc',

            ]
        );

        $this->add_control(
            'sticky_ignore',
            [
                'label' => esc_html__( 'Sticky Condition', 'voidgrid' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => 'Remove Sticky',
                    '0' => 'Keep Sticky'
                ],

                'default' => '1',
            ]
        );

		$this->end_controls_section();
	}


	protected function render() {				//to show on the fontend 
		$settings = $this->get_settings();

		if(!empty($settings['category'])){
				$category = implode (", ", $settings['category']);
		}else{$category='';}
		echo'<div class="elementor-shortcode">';
            echo do_shortcode('[voidgrid_sc_post_grid display_type="'.$settings['display_type'].'" posts="'.$settings['posts'].'" posts_per_row="'.$settings['posts_per_row'].'" image_style="'.$settings['image_style'].'" sticky_ignore="'.$settings['sticky_ignore'].'"  orderby="'.$settings['orderby'].'" order="'.$settings['order'].'" offset="'.$settings['offset'].'"  category="'.$category.'"]');    
		echo'</div>';
	}

	protected function _content_template() {      // to be in live preview edit

	}
}
