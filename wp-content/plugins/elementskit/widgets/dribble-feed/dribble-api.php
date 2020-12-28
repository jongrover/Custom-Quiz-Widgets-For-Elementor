<?php

namespace ElementsKit\Widgets\Dribble_Feed;

defined('ABSPATH') || exit;

use ElementsKit_Lite\Core\Handler_Api;


class Dribble_Api extends Handler_Api {

	private $ok_uuid_storage = 'ekit_dribble_code_storage';
	private $ok_token_storage = 'ekit_dribble_user_data_storage';

	public function __construct() {

		parent::__construct();

	}

	public function config() {
		$this->prefix = 'dribble';
		$this->param  = "";
	}


	public function post_retrieve() {

		$opt = get_option($this->ok_token_storage, []);

		return [
			'success' => true,
			'token' => empty($opt['dribble']) ? '' : $opt['dribble'],
		];
	}

	public function get_initiate() {

		$op_key = $this->ok_uuid_storage;

		$data = $this->request->get_params();

		$state = json_decode($data['state']);

		$opt[$state->uuid]['cl']    = $data['client_id'];
		$opt[$state->uuid]['cs']    = $data['cs'];
		$opt[$state->uuid]['state'] = $data['state'];
		$opt[$state->uuid]['redir'] = $data['redirect_uri'];

		$auth = 'https://dribbble.com/oauth/authorize';
		$args = '?client_id='.$data['client_id'].'&redirect_uri='.$data['redirect_uri'].'&scope=public&state='.$data['state'];

		update_option($op_key, $opt);

		wp_redirect($auth . $args);
		exit;
	}

	public function get_redirect_uri() {

		$data = $this->request->get_params();

		if(!empty($data['code'])) {

			$url = get_rest_url() . 'elementskit/v1/dribble/access_token';
			$args = '?token='.$data['code'].'&state='.$data['state'];

			wp_redirect($url.$args);
			exit;
		}

		echo 'Invalid request!';
		exit;
	}


	public function get_access_token() {

		$data   = $this->request->get_params();
		$op_key = $this->ok_uuid_storage;
		$state  = $this->make_state_array($data['state']);
		$uuid   = $state['uuid'];
		$optn   = get_option($op_key, []);


		$redir    = $optn[$uuid]['redir'];
		$url_tok  = 'https://dribbble.com/oauth/token';
		$tok_args = '?client_id=' . $optn[$uuid]['cl'] . '&client_secret=' . $optn[$uuid]['cs'] . '&redirect_uri=' . $redir . '&code=' . $data['token'];


		try {

			$request = wp_remote_post($url_tok . $tok_args);
			$body    = wp_remote_retrieve_body($request);
			$dt      = json_decode($body);

		} catch(\Exception $ex) {

			echo 'Error - '. $ex->getMessage();

			die;
		}


		if(empty($dt->access_token)) {

			print_r($dt);

			die;
		}

		echo 'Please copy the access code and close the window.'.PHP_EOL;

		echo 'Token : '. $dt->access_token;

		$opt = get_option($this->ok_token_storage, []);

		$opt['dribble'] = $dt->access_token;

		update_option($this->ok_token_storage, $opt);

		wp_redirect(home_url('/fb-redirect?close=' . $uuid));
		exit;
	}


	/**
	 *
	 *
	 * @param $str
	 *
	 * @return array
	 */
	private function make_state_array($str) {

		$state = explode(',', $str);
		$s_arr = [];

		foreach($state as $item) {
			$tmp            = explode(':', $item);
			$s_arr[$tmp[0]] = $tmp[1];
		}

		return $s_arr;
	}
}

