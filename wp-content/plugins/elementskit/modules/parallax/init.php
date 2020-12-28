<?php
namespace ElementsKit\Modules\Parallax;

defined( 'ABSPATH' ) || exit;

class Init{
    private $dir;
    private $url;

    public function __construct(){

        // get current directory path
        $this->dir = dirname(__FILE__) . '/';

        // get current module's url
		$this->url = \ElementsKit::plugin_url() . 'modules/parallax/';
		
		// enqueue scripts
		add_action('wp_head', [$this, 'inline_script']);
		add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
		add_action('elementor/frontend/before_enqueue_scripts', [$this, 'editor_scripts'], 99);

		// include all necessary files
		$this->include_files();

		// calling the section parallax class
		new \Elementor\ElementsKit_Section_Effect_Controls();
		new \Elementor\ElementsKit_Widget_Effect_Controls();
        
	}
	
	public function include_files(){
		include $this->dir . 'section-controls.php';
		include $this->dir . 'widget-controls.php';
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'elementskit-parallax-style', $this->url . 'assets/css/style.css' , null, \ElementsKit::version() );
		wp_enqueue_script( 'jarallax', $this->url . 'assets/js/jarallax.js', array('jquery'), \ElementsKit::version(), false );
		wp_enqueue_script( 'tweenmax', $this->url . 'assets/js/TweenMax.min.js', array('jquery'), \ElementsKit::version(), true );
		wp_enqueue_script( 'jquery-easing', $this->url . 'assets/js/jquery.easing.1.3.js', array('jquery'), \ElementsKit::version(), true );
		wp_enqueue_script( 'tilt', $this->url . 'assets/js/tilt.jquery.min.js', array('jquery'), \ElementsKit::version(), true );
	
		wp_enqueue_script( 'animejs', $this->url . 'assets/js/anime.js', array('jquery'), \ElementsKit::version(), true );
		wp_enqueue_script( 'magicianjs', $this->url . 'assets/js/magician.js', array('jquery'), \ElementsKit::version(), true );
	}

	public function editor_scripts(){
		wp_enqueue_script( 'elementskit-parallax-widget-init', $this->url . 'assets/js/widget-init.js', array( 'jquery', 'elementor-frontend' ), \ElementsKit::version(), true );
		wp_enqueue_script( 'elementskit-parallax-section-init', $this->url . 'assets/js/section-init.js', array( 'jquery', 'elementor-frontend' ), \ElementsKit::version(), true );
	}

	public function inline_script(){
		echo '
			<script type="text/javascript">
				var elementskit_module_parallax_url = "'.$this->url.'"
			</script>
		';
	}
}