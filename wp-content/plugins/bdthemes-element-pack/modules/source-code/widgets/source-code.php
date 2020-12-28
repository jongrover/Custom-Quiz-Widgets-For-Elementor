<?php
    
    namespace ElementPack\Modules\SourceCode\Widgets;
    
    use Elementor\Widget_Base;
    use Elementor\Controls_Manager;
    use Elementor\Group_Control_Border;
    
    if ( !defined( 'ABSPATH' ) ) {
        exit;
    } // Exit if accessed directly
    
    class Source_Code extends Widget_Base {
        
        public function get_name() {
            return 'bdt-source-code';
        }
        
        public function get_title() {
            return BDTEP . esc_html__( 'Source Code', 'bdthemes-element-pack' );
        }
        
        public function get_icon() {
            return 'bdt-wi-source-code';
        }
        
        public function get_categories() {
            return ['element-pack'];
        }
        
        public function get_style_depends() {
            return ['ep-source-code'];
        }
        
        public function get_script_depends() {
            return ['prism', 'clipboard', 'ep-source-code'];
        }
        
        public function get_keywords() {
            return ['source', 'code', 'preformatted', 'pre'];
        }
        
        public function get_custom_help_url() {
            return 'https://youtu.be/vnqpD9aAmzg';
        }
        
        protected function _register_controls() {
            
            $this->start_controls_section(
                'source_code_section_content', [
                    'label' => esc_html__( 'Source Code Content', 'bdthemes-element-pack' ),
                ]
            );
            
            $this->add_control(
                'theme', [
                    'label'   => __( 'Select Style', 'bdthemes-element-pack' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'default',
                    'options' => [
                        'default'   => __( 'Default', 'bdthemes-element-pack' ),
                        'dark'      => __( 'Dark', 'bdthemes-element-pack' ),
                        'coy'       => __( 'Coy', 'bdthemes-element-pack' ),
                        'funky'     => __( 'Funky', 'bdthemes-element-pack' ),
                        'okaidia'   => __( 'Okaidia', 'bdthemes-element-pack' ),
                        'solarized' => __( 'Solarized Light', 'bdthemes-element-pack' ),
                        'tomorrow'  => __( 'Tomorrow Night', 'bdthemes-element-pack' ),
                        'twilight'  => __( 'Twilight', 'bdthemes-element-pack' ),
                    ],
                ]
            );
            
            $this->add_control(
                'source_code_copy_button',
                [
                    'label'        => esc_html__( 'Copy Button', 'bdthemes-element-pack' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'true',
                ]
            );
            
            $this->add_control(
                'source_code_language_selector', [
                    'label'   => __( 'Select Language', 'bdthemes-element-pack' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'language-markup',
                    'options' => [
                        'language-markup'            => __( 'HTML markup', 'bdthemes-element-pack' ),
                        'language-clike'             => __( 'C-like', 'bdthemes-element-pack' ),
                        'language-css'               => __( 'CSS', 'bdthemes-element-pack' ),
                        'language-sass'              => __( 'Sass', 'bdthemes-element-pack' ),
                        'language-scss'              => __( 'Scss', 'bdthemes-element-pack' ),
                        'language-less'              => __( 'Less', 'bdthemes-element-pack' ),
                        'language-javascript'        => __( 'Javascript', 'bdthemes-element-pack' ),
                        'language-php'               => __( 'PHP', 'bdthemes-element-pack' ),
                        'language-phpdoc'            => __( 'PHP DOC', 'bdthemes-element-pack' ),
                        'language-py'                => __( 'Python', 'bdthemes-element-pack' ),
                        'language-c'                 => __( 'C ', 'bdthemes-element-pack' ),
                        'language-cpp'               => __( 'C++ ', 'bdthemes-element-pack' ),
                        'language-csharp'            => __( 'C# ', 'bdthemes-element-pack' ),
                        'language-aspnet'            => __( 'Asp.net (C#) ', 'bdthemes-element-pack' ),
                        'language-django'            => __( 'Django ', 'bdthemes-element-pack' ),
                        'language-git'               => __( 'Git ', 'bdthemes-element-pack' ),
                        'language-gml'               => __( 'GameMaker language ', 'bdthemes-element-pack' ),
                        'language-go'                => __( 'Go ', 'bdthemes-element-pack' ),
                        'language-java'              => __( 'Java ', 'bdthemes-element-pack' ),
                        'language-javadoc'           => __( 'Java Doc', 'bdthemes-element-pack' ),
                        'language-json'              => __( 'JSON', 'bdthemes-element-pack' ),
                        'language-jsonp'             => __( 'JSONP', 'bdthemes-element-pack' ),
                        'language-kotlin'            => __( 'Kotlin', 'bdthemes-element-pack' ),
                        'language-markup-templating' => __( 'Markup templating', 'bdthemes-element-pack' ),
                        'language-nginx'             => __( 'nginx', 'bdthemes-element-pack' ),
                        'language-perl'              => __( 'Perl', 'bdthemes-element-pack' ),
                        'language-jsx'               => __( 'React JSX', 'bdthemes-element-pack' ),
                        'language-rb'                => __( 'Ruby', 'bdthemes-element-pack' ),
                        'language-sql'               => __( 'SQL', 'bdthemes-element-pack' ),
                        'language-swift'             => __( 'Swift', 'bdthemes-element-pack' ),
                        'language-vbnet'             => __( 'VB.Net', 'bdthemes-element-pack' ),
                        'language-vb'                => __( 'Visual Basic', 'bdthemes-element-pack' ),
                    ]
                ]
            );
            
            
            $this->add_control(
                'source_code_content', [
                    'label'       => __( 'Source Code', 'bdthemes-element-pack' ),
                    'type'        => Controls_Manager::TEXTAREA,
                    'rows'        => 10,
                    'default'     => "
&lt;!DOCTYPE html&gt;
&lt;html lang=\"en\"&gt;
	&lt;head&gt;
		&lt;meta charset=\"UTF-8\"&gt;
		&lt;title&gt;Document&lt;/title&gt;
	&lt;/head&gt;
	&lt;body&gt;
		&lt;h1&gt;Hello World!&lt;/h1&gt;
		&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. &lt;/p&gt;
	&lt;/body&gt;
&lt;/html&gt;",
                    'placeholder' => __( 'Type your code here', 'bdthemes-element-pack' ),
                    'dynamic'     => [
                        'active' => true,
                    ],
                ]
            );
            
            
            $this->end_controls_section();
            
            $this->start_controls_section(
                'section_style', [
                    'label' => __( 'Items', 'bdthemes-element-pack' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ]
            );
            
            $this->add_responsive_control(
                'source_code_preview_height', [
                    'label'     => __( 'Height', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SLIDER,
                    'default'   => [
                        'size' => 500,
                        'unit' => 'px',
                    ],
                    'range'     => [
                        'px' => [
                            'min' => 10,
                            'max' => 2000,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-source-code pre' => 'max-height: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Border::get_type(), [
                    'name'     => 'source_code_preview_border',
                    'label'    => esc_html__( 'Border', 'bdthemes-element-pack' ),
                    'selector' => '{{WRAPPER}} .bdt-source-code pre',
                ]
            );
            
            
            $this->add_control(
                'source_code_preview_border_radius', [
                    'label'      => __( 'Border Radius', 'bdthemes-element-pack' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .bdt-source-code pre' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'source_code_preview_padding', [
                    'label'      => __( 'Padding', 'bdthemes-element-pack' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors'  => [
                        '{{WRAPPER}} .bdt-source-code pre' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'source_code_preview_margin', [
                    'label'      => __( 'Margin', 'bdthemes-element-pack' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors'  => [
                        '{{WRAPPER}} .bdt-source-code pre' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );
            
            
            $this->end_controls_section();
        }
        
        protected function render() {
            $settings = $this->get_settings_for_display();
            
            $this->add_render_attribute( 'source-code', 'class', 'bdt-source-code' );
            $theme = ( $settings['theme'] ) ? $settings['theme'] : 'default';
            $this->add_render_attribute( 'source-code', 'class', 'prism-' . $theme );
            ?>


          <div <?php
              $this->print_render_attribute_string( 'source-code' ); ?>>
              
              <?php
                  if ( 'yes' == $settings['source_code_copy_button'] ): ?>
                    <button class="bdt-copy-button"><?php
                            echo esc_html__( 'Copy', 'bdthemes-element-pack' ) ?></button>
                  <?php
                  endif; ?>
<pre class="<?php echo esc_html( $settings['source_code_language_selector'] ); ?>">
<code><?php echo esc_html( $settings['source_code_content'] ); ?></code>
</pre>

          </div>
            <?php
            
        }
        
    }