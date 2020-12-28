<?php
    
    namespace ElementPack\Modules\CustomJs;
    
    use Elementor\Controls_Manager;
    use Elementor\Plugin;
    use ElementPack;
    use ElementPack\Base\Element_Pack_Module_Base;
    
    if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    
    class Module extends Element_Pack_Module_Base {
        
        public function __construct() {
            parent::__construct();
            $this->add_actions();
        }
        
        public function get_name() {
            return 'bdt-custom-js';
        }
        
        public function register_controls($section, $section_id) {
            
            static $layout_sections = ['section_page_style'];
            
            if ( !in_array( $section_id, $layout_sections ) ) {
                return;
            }
            
            $section->start_controls_section(
                'element_pack_custom_js_section',
                [
                    'tab'   => Controls_Manager::TAB_ADVANCED,
                    'label' => BDTEP_CP . esc_html__( 'Custom JavaScript', 'visibility-logic-elementor' ),
                ]
            );
            
            $section->add_control(
                'ep_custom_header_script',
                [
                    'label'       => sprintf(__('%1s Header %2s Script', 'bdthemes-element-pack'), '<b>', '</b>'),
                    'description' => sprintf(__('Please write down your custom js script on appropriate field as per your need. Don\'t add script tag here.', 'bdthemes-element-pack'), '<b>', '</b>'),
                    'type'        => Controls_Manager::CODE,
                    //'language'    => 'js',
                    'render_type' => 'ui',
                    'separator'   => 'none',
                ]
            );
            
            $section->add_control(
                'ep_custom_footer_script',
                [
                    'label'       => sprintf(__('%1s Footer %2s Script', 'bdthemes-element-pack'), '<b>', '</b>'),
                    'description' => sprintf(__('Please write down your custom js script on appropriate field as per your need. Don\'t add script tag here.', 'bdthemes-element-pack'), '<b>', '</b>'),
                    'type'        => Controls_Manager::CODE,
                    //'language'    => 'js',
                    'render_type' => 'ui',
                    'separator'   => 'none',
                ]
            );
            
            $section->end_controls_section();
            
        }
        
        public function header_script_render() {
            
            if ( Plugin::instance()->editor->is_edit_mode() || Plugin::instance()->preview->is_preview_mode() ) {
                return;
            }
            
            $document = Plugin::instance()->documents->get( get_the_ID() );
            
            if ( !$document ) {
                return;
            }
            
            $custom_js = $document->get_settings( 'ep_custom_header_script' );
            
            if ( empty( $custom_js ) ) {
                return;
            }
            
            ?>
          <script type="text/javascript">
              <?php echo $custom_js; ?>
          </script>
            <?php
            
        }
        
        public function footer_script_render() {
            
            if ( Plugin::instance()->editor->is_edit_mode() || Plugin::instance()->preview->is_preview_mode() ) {
                return;
            }
            
            $document = Plugin::instance()->documents->get( get_the_ID() );
            
            if ( !$document ) {
                return;
            }
            
            $custom_js = $document->get_settings( 'ep_custom_footer_script' );
            
            if ( empty( $custom_js ) ) {
                return;
            }
            
            ?>
          <script type="text/javascript">
              <?php echo $custom_js; ?>
          </script>
            <?php
            
        }
        
        
        protected function add_actions() {
            
            add_action( 'elementor/element/after_section_end', [$this, 'register_controls'], 10, 2 );
            add_action( 'wp_head', [$this, 'header_script_render'], 999 );
            add_action( 'wp_footer', [$this, 'footer_script_render'], 999 );
            
        }
        
        
    }
