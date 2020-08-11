<?php 
require_once('Facebook/autoload.php');
class Facebook {
	protected $CI;
	public function __construct(){
		$this->CI =& get_instance();
        $this->CI->load->library('session');
		$config = $this->CI->Autoload_Model->_get_where(array(
			'select' => 'appId, secret',
			'table' => 'customer_config',
			'where' => array('id' => 1)
		));
        $this->fb = new Facebook\Facebook([
	        'app_id' => $config['appId'], // Replace {app-id} with your app id
	        'app_secret' => $config['secret'],
	        'default_graph_version' => 'v2.2',
	    ]);
	}

	public function get_loginfb_url(){
		$helper = $this->fb->getRedirectLoginHelper();
	    $permissions = ['email']; // Optional permissions
	    $loginUrl = $helper->getLoginUrl(base_url('login-fbcallback.html'), $permissions);
		return  $loginUrl;
	}
	public function validate(){
		
  		$helper = $this->fb->getRedirectLoginHelper();
  		$_SESSION['FBRLH_state']=$_GET['state'];
  		try {
			$accessToken = $helper->getAccessToken();
  		} catch(Facebook\Exceptions\FacebookResponseException $e) {
    		// When Graph returns an error
    		echo 'Graph returned an error: ' . $e->getMessage();
    		exit;
  		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		    // When validation fails or other local issues
		    echo 'Facebook SDK returned an error: ' . $e->getMessage();
		    exit;
  		}
  		try {
		    // Get the Facebook\GraphNodes\GraphUser object for the current user.
		    // If you provided a 'default_access_token', the '{access-token}' is optional.
    		$response = $this->fb->get('/me?fields=id,name,email,picture', $accessToken);
  			//  print_r($response);
  		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		    // When Graph returns an error
		    echo 'ERROR: Graph ' . $e->getMessage();
		    exit;
  		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		    // When validation fails or other local issues
		    echo 'ERROR: validation fails ' . $e->getMessage();
		    exit;
  		}
  		$me = $response->getGraphUser();
  		$user['facebook_id'] = $me->getProperty('id');
  		$user['fullname'] = $me->getProperty('name');
  		$user['email'] = (($me->getProperty('email') != '') ? $me->getProperty('email') : '');
  		$user['avatar'] = 'https://graph.facebook.com/'.$me->getProperty('id').'/picture?type=large';
  		return  $user;
	}
}