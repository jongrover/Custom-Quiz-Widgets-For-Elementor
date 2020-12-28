<?php
namespace Oxaim\Libs;

defined( 'ABSPATH' ) || exit;

if(!class_exists('\Oxaim\Libs\Notice')):
class Notice{

    /**
     * Unique ID to identify each notice
     *
     * @var string
     */
    protected $notice_id;

    /**
     * Plugin text-domain
     *
     * @var string
     */
    protected $text_domain;

    
    /**
     * Unique ID
     *
     * @var string
     */
    protected $unique_id;

    
    /**
     * Notice div container's class
     *
     * @var string
     */
    protected $class;

    
    /**
     * Single button's data
     *
     * @var array
     */
    protected $button;

    
    /**
     * Size class
     *
     * @var array
     */
    protected $size;

    
    /**
     * List of all buttons with it's config data
     *
     * @var array
     */
    protected $buttons;

    /**
     * Notice title
     *
     * @var string
     */
    protected $title;

    
    /**
     * Notice message
     *
     * @var string
     */
    protected $message;

    /**
     * Left logo
     *
     * @var string
     */
    protected $logo;
    /**
     * Container gutter
     *
     * @var string
     */
    protected $gutter;

    /**
     * Left logo style
     *
     * @var string
     */
    protected $logo_style;


    /**
     * Left logo style
     *
     * @var string
     */
    protected $dismissible;

    protected $expired_time;


    
    /**
     * html markup for notice
     *
     * @var string
     */
    protected $html;

    // config
    
    /**
     * Configures all setter variables
     *
     * @param  string $prefix
     * @return void
     */
    public function config(string $text_domain = '', string $unique_id = ''){
        $this->text_domain = $text_domain;

        $this->unique_id = $unique_id;

        $this->notice_id = $text_domain . '-' . $unique_id;

        $this->dismissible = false; // false, user, global

        $this->expired_time = 1;

        $this->html = '';

        $this->title = '';
        
        $this->message = '';
        
        $this->class = '';

        $this->gutter = true;

        $this->logo = '';

        $this->logo_style = '';

        $this->size = [ ];

        $this->button = [
            'default_class' => 'button',
            'class' => 'button-secondary ', // button-primary button-secondary button-small button-large button-link
            'text' => 'Button',
            'url' => '#',
            'icon' => ''
        ];

        $this->buttons = [];

        return $this;
    }

    // setters begin
    
    /**
     * Adds classes to the container
     *
     * @param  string $classname
     * @return void
     */
    public function set_class(string $classname = ''){
        $this->class .= $classname;

        return $this;
    }
    
    public function set_type(string $type = ''){
        $this->class .= ' notice-' . $type;

        return $this;
    }

    public function set_button(array $button = []){
        $button = array_merge($this->button, $button);
        $this->buttons[] = $button;

        return $this;
    }

    public function set_id($id){
        $this->notice_id = $id;
        return $this;
    }

    public function set_title(string $title = ''){
        $this->title .= $title;

        return $this;
    }

    public function set_message(string $message = ''){
        $this->message .= $message;

        return $this;
    }

    public function set_gutter(bool $gutter = true){
        $this->gutter .= $gutter;
        $this->class  .= ($gutter === true ? '' : ' no-gutter');

        return $this;
    }

    public function set_logo(string $logo = '', string $logo_style = ""){
        $this->logo = $logo;

        $this->logo_style = $logo_style;

        return $this;
    }

    public function set_html(string $html = ''){
        $this->html .= $html;

        return $this;
    }

    // setters ends


    // group getter
    public function get_data(){
        return [
            'message' => $this->message,
            'title' => $this->title,
            'buttons' => $this->buttons,
            'class' => $this->class,
            'html' => $this->html,
        ];
    }




    public function call(){
        add_action( 'admin_notices', [$this, 'get_notice'] );
    }
    
    public function get_notice(){
        // dismissible conditions
		if ( 'user' === $this->dismissible) {
			$expired = get_user_meta( get_current_user_id(), $this->notice_id, true );
		} elseif ( 'global' === $this->dismissible ) {
			$expired = get_transient( $this->notice_id );
        }else{
            $expired = '';
        }
        // echo $expired; exit;

		// notice visible after transient expire.
		if ( false === $this->notice_id ) {
            $this->generate_html();
        }else{
            // is transient expired?
            if ( false === $expired || empty( $expired ) ) {
                $this->generate_html();
            }
        }

    }

    public function set_dismiss($scope = 'global', $time = (3600 * 24 * 365)){ // global/ user
        $this->dismissible = $scope;
        $this->expired_time = $time;
        
        return $this;
    }

    public function  generate_html() {

		?>
        <div 
            id="<?php echo esc_attr($this->notice_id); ?>" 
            class="notice wpmet-notice notice-<?php echo esc_attr($this->notice_id . ' ' .$this->class); ?> <?php echo (false === $this->dismissible ? '' : 'is-dismissible') ;?>"

            expired_time="<?php echo ($this->expired_time); ?>"
            dismissible="<?php echo ($this->dismissible); ?>"
        >
            <?php if(!empty($this->logo)):?>
                <div class="notice-left-container alignleft">
                    <p><img style="margin-right:15px; <?php echo esc_attr($this->logo_style); ?>" src="<?php echo esc_url($this->logo);?>" /></p>
                </div>
            <?php endif; ?>

            <div class="notice-right-container">

                <?php if(empty($this->html)): ?>
                    <div class="extension-message">
                        <?php echo (empty($this->title) ? '' : sprintf('<h3>%s</h3>', $this->title)); ?>
                        <?php echo ( $this->message );?>
                    </div>

                    <?php if(!empty($this->buttons)): ?>
                        <div class="submit">
                            <?php foreach($this->buttons as $id => $button): ?>
                                <a id="<?php echo $id; ?>" href="<?php echo esc_url($button['url']); ?>" class="wpmet-notice-buttons <?php echo esc_attr($button['class']); ?>">
                                    <?php if(!empty($button['icon'])) :?>
                                        <i class="notice-icon <?php echo esc_attr($button['icon']); ?>"></i>
                                    <?php endif; ?>
                                    <?php echo esc_html($button['text']);?>
                                </a>
                                &nbsp;
                            <?php endforeach; ?>
                        </div>
                    <?php else:?>
                        <div class="wpmet-notice-pb-10"></div>
                    <?php endif;?>

                <?php else:?>
                    <?php echo $this->html; ?>
                <?php endif;?>

                <?php if(false !== $this->dismissible): ?>
                    <button type="button" class="notice-dismiss">
                        <span class="screen-reader-text">x</span>
                    </button>
                <?php endif;?>

            </div>

            <div style="clear:both"></div>

        </div>
		<?php
	}

    public static function init(){
        add_action( 'wp_ajax_wpmet-notices', [ __CLASS__, 'dismiss_ajax_call' ] );
        add_action( 'admin_head', [ __CLASS__, 'enqueue_scripts' ] );
    }

    public static function dismiss_ajax_call() {
		$notice_id   = ( isset( $_POST['notice_id'] ) ) ? $_POST['notice_id'] : '';
		$dismissible = ( isset( $_POST['dismissible'] ) ) ? $_POST['dismissible'] : 'global';
		$expired_time = ( isset( $_POST['expired_time'] ) ) ? $_POST['expired_time'] : (3600 * 24 * 365);
        // print_r([$notice_id, $dismissible, $expired_time]);

		if ( ! empty( $notice_id ) ) {
			if ( 'user' === $dismissible ) {
				update_user_meta( get_current_user_id(), $notice_id, true );
			} else {
				set_transient( $notice_id, true, $expired_time );
			}

			wp_send_json_success();
		}

		wp_send_json_error();
	}
    
	public static function enqueue_scripts() {
		echo "
			<script>
                jQuery(document).ready(function ($) {
                    $( '.wpmet-notice.is-dismissible' ).on( 'click', '.notice-dismiss', function(e) {

                        _this 		= $( this ).parents('.wpmet-notice').eq(0);
                        var notice_id 	= _this.attr( 'id' ) || '';
                        var expired_time 	= _this.attr( 'expired_time' ) || '';
                        var dismissible 	= _this.attr( 'dismissible' ) || '';
                        var x = $( this ).attr('class');

                        // console.log({
                        //     _this, x, notice_id, expired_time, dismissible
                        // });
                        // return;

                        $.ajax({
                            url: ajaxurl,
                            type: 'POST',
                            data: {
                                action 	: 'wpmet-notices',
                                notice_id 		: notice_id,
                                dismissible 	: dismissible,
                                expired_time 	: expired_time,
                            },
                        });
                        
                        e.preventDefault();
                    });
                });
            </script>
            <style>
                .wpmet-notice .notice-icon{
                    display:inline-block;
                }

                .wpmet-notice .notice-icon:before{
                    vertical-align: middle!important;
                    margin-top: -1px;
                }

                .wpmet-notice-buttons {
                    text-decoration:none;
                }

                .wpmet-notice-buttons > i{
                    margin-right: 3px;
                }

                .wpmet-notice .notice-right-container{
                    padding: 1.5em 0 0;
                    margin: 5px 0 0;
                }
                .wpmet-notice .notice-right-container .submit {
                    padding-top: 8px
                }

                .wpmet-notice img{
                    max-width: 100%!important;
                    max-height: 100%!important;
                }

                .wpmet-notice.no-gutter{
                    padding: 0!important;
                }

                .wpmet-notice.no-gutter .notice-right-container{
                    padding: 0!important;
                    margin: 0!important;
                }
                .wpmet-notice-pb-10{
                    padding-bottom:1.5em;
                    margin-bottom: 5px;
                }
             
            </style>
		";
    }
    

    private static $instance;
	
	/**
	 * init
	 *
	 * @return object|false
	 */
	public static function instance($text_domain = null, $unique_id = null) {
        if($text_domain == null){
            return false;
        }

        self::$instance = new self();

		return self::$instance->config($text_domain, (is_null($unique_id) ? uniqid() : $unique_id));
	}
}

endif;