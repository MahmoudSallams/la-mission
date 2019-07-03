<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

include_once 'holmes-twitter-helper.php';

/**
 * Class HolmesTwitterApi
 */
class HolmesTwitterApi {
	/**
	 * @var instance of current class
	 */
	private static $instance;
	/**
	 * Key that was provided by Twitter when application was created
	 * @var string
	 */
	private $consumerKey;
	/**
	 * Secret code for application that was generated by Twitter
	 * @var string
	 */
	private $consumerSecret;
	/**
	 *
	 * URL where user will be redirected once he authorizes access to our application
	 * @var string
	 */
	private $redirectURI;
	/**
	 * URL from which we can obtain request token that will be used to get access token
	 * @var string
	 */
	private $requestTokenURL;
	/**
	 * URL where user can authorize our application
	 * @var string
	 */
	private $authorizeURL;
	
	/**
	 * URL from which we can obtain access token
	 * @var
	 */
	private $accessTokenUrl;
	/**
	 * Signature hashin method that is used by Twitter OAuth
	 * @var string
	 */
	private $signatureMethod;
	/**
	 * OAuth version that is used by Twitter
	 * @var string
	 */
	private $oauthVersion;
	
	private $helper;
	
	const REQUEST_TOKEN_FIELD = 'holmes_twitter_request_token';
	const REQUEST_TOKEN_SECRET_FIELD = 'holmes_twitter_request_token_secret';
	const ACCESS_TOKEN_FIELD = 'holmes_twitter_access_token';
	const ACCESS_TOKEN_SECRET_FIELD = 'holmes_twitter_access_token_secret';
	const AUTHORIZE_TOKEN_FIELD = 'holmes_twitter_authorize_token';
	const AUTHORIZE_VERIFIER_FIELD = 'holmes_twitter_authorize_verifier';
	const USER_ID_FIELD = 'holmes_twitter_user_id';
	const USER_SCREEN_NAME_FIELD = 'holmes_twitter_screen_name';
	
	/**
	 * Private constructor because of singletone pattern. It sets all necessary properties
	 */
	public function __construct() {
		$this->consumerKey     = 'e6U1XvODMPeDipvmaMa9jJaTA';
		$this->consumerSecret  = '30LY2v71h5fSWnRADAHQitmSUTq4iSMe4LVBpIVOIS7a2EuuLm';
		$this->redirectURI     = 'http://demo.mikado-themes.com/twitter-app/twitter-redirect.php';
		$this->signatureMethod = 'HMAC-SHA1';
		$this->oauthVersion    = '1.0';
		$this->requestTokenURL = 'https://api.twitter.com/oauth/request_token';
		$this->authorizeURL    = 'https://api.twitter.com/oauth/authorize';
		$this->accessTokenUrl  = 'https://api.twitter.com/oauth/access_token';
		$this->helper          = new HolmesTwitterHelper();
	}
	
	/**
	 * Must override magic method because of singletone
	 */
	private function __clone() {
	}
	
	/**
	 * Must override magic method because of singletone
	 */
	private function __wakeup() {
	}
	
	/**
	 * @return HolmesTwitterApi
	 */
	public static function getInstance() {
		if ( self::$instance === null ) {
			return new self();
		}
		
		return self::$instance;
	}
	
	/**
	 * @return HolmesTwitterHelper
	 */
	public function getHelper() {
		return $this->helper;
	}
	
	/**
	 * Generates signature base that will be used to generate request signature.
	 * Signature is used by Twitter to check authorization of request
	 *
	 * @param string $requestUrl URL that we are requesting
	 * @param strinh $method HTTP method. Can be GET or POST
	 * @param array  $params array of parameters from which to generate signature base
	 *
	 * @return string generated signature base
	 */
	private function generateSignatureBase( $requestUrl, $method, $params ) {
		$encodedParams       = array();
		$encodedParamsString = '';
		$method              = strtoupper( $method );
		
		$base = $method . '&' . rawurlencode( $requestUrl ) . '&';
		
		if ( is_array( $params ) && count( $params ) ) {
			foreach ( $params as $key => $value ) {
				$encodedParams[ rawurlencode( $key ) ] = rawurlencode( $value );
			}
			
			ksort( $encodedParams );
			
			foreach ( $encodedParams as $key => $value ) {
				$encodedParamsString .= $key . '=' . $value . '&';
			}
			
			$encodedParamsString = rtrim( $encodedParamsString, '&' );
		}
		
		$base .= rawurlencode( $encodedParamsString );
		
		return $base;
	}
	
	/**
	 * Generates signature. Uses consumer secret as hashing key and uses sha1 as hashing algorithm
	 *
	 * @param string $requestUrl URL that we are requesting
	 * @param string $method HTTP method. Can be GET of POST
	 * @param array  $params array of parameters from which to generate signature
	 * @param string $tokenSecret
	 *
	 * @return string generated signature
	 *
	 * @see HolmesTwitterApi::generateSignatureBase()
	 */
	private function generateSignature( $requestUrl, $method, $params, $tokenSecret = '' ) {
		$base = $this->generateSignatureBase( $requestUrl, $method, $params );
		
		$signatureKey = rawurlencode( $this->consumerSecret ) . '&';
		
		if ( $tokenSecret !== '' ) {
			$signatureKey .= rawurlencode( $tokenSecret );
		}
		
		return base64_encode( hash_hmac( 'sha1', $base, $signatureKey, true ) );
	}
	
	/**
	 * Generates OAuth authorization header base on provided request params
	 *
	 * @param array $requestParams
	 *
	 * @return string
	 */
	private function generateOAuthHeader( $requestParams ) {
		$header = array();
		if ( is_array( $requestParams ) && count( $requestParams ) ) {
			foreach ( $requestParams as $key => $value ) {
				$header[] = rawurlencode( $key ) . '="' . rawurlencode( $value ) . '"';
			}
		}
		
		return 'OAuth ' . implode( ', ', $header );
	}
	
	/**
	 * Generates hashed random number sequence that is used on each request
	 * @return string
	 */
	private function generateNonce() {
		return md5( mt_rand() );
	}
	
	/**
	 * Returns current UNIX time
	 * @return int
	 */
	private function generateTimestamp() {
		return time();
	}
	
	/**
	 * Sends request to Twitter in order to obtain request token.
	 * When Twitter returns request token it is saved in database along with request token secret.
	 * It builds response object that is returned to client and which has status, message and redirectURL (authorize URL) properties
	 */
	public function obtainRequestToken() {
		$responseObj    = new stdClass();
		$currentPageUrl = ! empty( $_POST['currentPageUrl'] ) ? $_POST['currentPageUrl'] : $this->buildCurrentPageURI();
		
		$requestParams = array(
			'oauth_callback'         => $this->buildRedirectURL( $currentPageUrl ),
			'oauth_consumer_key'     => $this->consumerKey,
			'oauth_nonce'            => $this->generateNonce(),
			'oauth_signature_method' => $this->signatureMethod,
			'oauth_timestamp'        => $this->generateTimestamp(),
			'oauth_version'          => $this->oauthVersion
		);
		
		$requestParams['oauth_signature'] = $this->generateSignature( $this->requestTokenURL, 'POST', $requestParams );
		$OAuthHeader                      = $this->generateOAuthHeader( $requestParams );
		$requestTokenData                 = array(
			'method'   => 'POST',
			'blocking' => true,
			'headers'  => array(
				'Authorization' => $OAuthHeader,
				'Content-Type'  => 'application/x-www-form-urlencoded;charset=UTF-8'
			)
		);
		
		$response = wp_remote_post( $this->requestTokenURL, $requestTokenData );
		
		if ( is_wp_error( $response ) ) {
			$responseObj->status  = false;
			$responseObj->message = esc_html__( 'Internal WP error', 'holmes-twitter-feed' );
		} else {
			$responseBody = wp_remote_retrieve_body( $response );
			
			if ( ! empty( $responseBody ) ) {
				parse_str( $responseBody, $responseParsed );
				
				if ( ( is_array( $responseParsed ) && count( $responseParsed ) ) &&
				     ! empty( $responseParsed['oauth_token'] ) && ! empty( $responseParsed['oauth_token_secret'] ) ) {
					
					update_option( self::REQUEST_TOKEN_FIELD, $responseParsed['oauth_token'] );
					update_option( self::REQUEST_TOKEN_SECRET_FIELD, $responseParsed['oauth_token_secret'] );
					
					$responseObj->redirectURL = $this->buildAuthorizeURL();
					if ( ! empty( $responseObj->redirectUrl ) ) {
						$responseObj->status  = false;
						$responseObj->message = esc_html__( 'Redirect URL couldn\t not be generated', 'holmes-twitter-feed' );
					} else {
						$responseObj->status  = true;
						$responseObj->message = 'Ok';
					}
				} else {
					$responseObj->status  = false;
					$responseObj->message = esc_html__( 'Couldn\'t connect with Twitter API', 'holmes-twitter-feed' );
				}
			}
		}
		
		echo json_encode( $responseObj );
		exit;
	}
	
	/**
	 * @return stdClass
	 */
	public function obtainAccessToken() {
		$responseObj       = new stdClass();
		$authorizeVerifier = get_option( self::AUTHORIZE_VERIFIER_FIELD );
		$authorizeToken    = get_option( self::AUTHORIZE_TOKEN_FIELD );
		
		if ( ! empty( $authorizeVerifier ) && ! empty( $authorizeToken ) ) {
			$requestParams = array(
				'oauth_consumer_key'     => $this->consumerKey,
				'oauth_nonce'            => $this->generateNonce(),
				'oauth_signature_method' => $this->signatureMethod,
				'oauth_timestamp'        => $this->generateTimestamp(),
				'oauth_version'          => $this->oauthVersion
			);
			
			$requestParams['oauth_signature'] = $this->generateSignature( $this->accessTokenUrl, 'POST', $requestParams );
			
			$requestData = array(
				'method'  => 'POST',
				'headers' => array(
					'Authorization' => $this->generateOAuthHeader( $requestParams ),
					'Content-Type'  => 'application/x-www-form-urlencoded;charset=UTF-8'
				),
				'body'    => array(
					'oauth_verifier' => rawurlencode( $authorizeVerifier ),
					'oauth_token'    => rawurlencode( $authorizeToken )
				)
			);
			
			$response = wp_remote_post( $this->accessTokenUrl, $requestData );
			
			if ( is_wp_error( $response ) ) {
				$responseObj->status  = false;
				$responseObj->message = esc_html__( 'Internal WP error', 'holmes-twitter-feed' );
			} else {
				$responseBody = wp_remote_retrieve_body( $response );
				parse_str( $responseBody, $responseParsed );
				if ( is_array( $responseParsed ) && count( $responseParsed )
				     && ! empty( $responseParsed['oauth_token'] ) && ! empty( $responseParsed['oauth_token_secret'] ) && ! empty( $responseParsed['user_id'] ) && ! empty( $responseParsed['screen_name'] ) ) {
					update_option( self::ACCESS_TOKEN_FIELD, $responseParsed['oauth_token'] );
					update_option( self::ACCESS_TOKEN_SECRET_FIELD, $responseParsed['oauth_token_secret'] );
					update_option( self::USER_ID_FIELD, $responseParsed['user_id'] );
					update_option( self::USER_SCREEN_NAME_FIELD, $responseParsed['screen_name'] );
					
					$responseObj->status  = true;
					$responseObj->message = esc_html__( 'Access token obtained', 'holmes-twitter-feed' );
				}
			}
		} else {
			$responseObj->status  = false;
			$responseObj->message = esc_html__( 'Authorize token and it\'s secret were not obtainer', 'holmes-twitter-feed' );
		}
		
		return $responseObj;
	}
	
	/**
	 * Gets tweets from Twitter
	 *
	 * @param string $userId ID of the user for which we want to retreieve tweets
	 * @param string $count number of tweets to return
	 * @param array  $transient
	 *
	 * @return stdClass response object containing status, message and data properties
	 */
	public function fetchTweets( $userId = '', $count = '', $transient = array() ) {
		$responseObj       = new stdClass();
		$userId            = ( $userId !== '' ) ? $userId : get_option( self::USER_SCREEN_NAME_FIELD );
		$count             = ( $count !== '' ) ? $count : 5;
		$accessToken       = get_option( self::ACCESS_TOKEN_FIELD );
		$accessTokenSecret = get_option( self::ACCESS_TOKEN_SECRET_FIELD );
		
		if ( ! $this->transientExists( $transient ) ) {
			if ( $userId && $accessToken ) {
				$requestParams = array(
					'oauth_consumer_key'     => $this->consumerKey,
					'oauth_nonce'            => $this->generateNonce(),
					'oauth_signature_method' => $this->signatureMethod,
					'oauth_timestamp'        => $this->generateTimestamp(),
					'oauth_version'          => $this->oauthVersion,
					'oauth_token'            => $accessToken,
					'user_id'                => $userId,
					'count'                  => $count
				);
				
				$requestParams['oauth_signature'] = $this->generateSignature( 'https://api.twitter.com/1.1/statuses/user_timeline.json', 'GET', $requestParams, $accessTokenSecret );
				
				unset( $requestParams['user_id'] );
				unset( $requestParams['count'] );
				
				$response = wp_remote_get( 'https://api.twitter.com/1.1/statuses/user_timeline.json?user_id=' . $userId . '&count=' . $count, array(
					'headers' => array(
						'Authorization' => $this->generateOAuthHeader( $requestParams ),
						'Content-Type'  => 'application/x-www-form-urlencoded;charset=UTF-8'
					)
				) );
				
				if ( is_wp_error( $response ) ) {
					$responseObj->status  = false;
					$responseObj->message = esc_html__( 'Internal WP error', 'holmes-twitter-feed' );
				} else {
					if ( isset( $response['response']['code'] ) && $response['response']['code'] == 200 ) {
						$responseObj->status  = true;
						$responseObj->message = 'Ok';
						$responseObj->data    = json_decode( wp_remote_retrieve_body( $response ), true );
						
						$this->updateTransient( $transient, $responseObj->data );
					} else {
						$responseObj->status  = false;
						$responseObj->message = esc_html__( 'Couldn\'t connect with Twitter', 'holmes-twitter-feed' );
					}
				}
			} else {
				$responseObj->status  = false;
				$responseObj->message = esc_html__( 'It seams like you haven\t connected with your Twitter account', 'holmes-twitter-feed' );
			}
		} else {
			$transientContent = $this->getTransient( $transient );
			if ( ! empty( $transientContent ) ) {
				$responseObj->status  = true;
				$responseObj->message = 'Ok';
				$responseObj->data    = $transientContent;
			} else {
				$responseObj->status  = false;
				$responseObj->message = esc_html__( 'Couldn\'t retreive content from database', 'holmes-twitter-feed' );
			}
		}
		
		return $responseObj;
	}
	
	/**
	 * Generates URL where user will authorize our application. Appends request token parameter to Twitter URL
	 * @return bool|string
	 */
	private function buildAuthorizeURL() {
		$request_token = get_option( self::REQUEST_TOKEN_FIELD );
		
		if ( ! empty( $request_token ) ) {
			return $this->authorizeURL . '?oauth_token=' . $request_token;
		}
		
		return false;
	}
	
	/**
	 * Generates URL where user will be redirected once he authorizes our application
	 *
	 * @param $redirectUrl
	 *
	 * @return string
	 */
	private function buildRedirectURL( $redirectUrl ) {
		return $this->redirectURI . '?redirect_url=' . $redirectUrl;
	}
	
	/**
	 * Returns current page URL
	 * @return string
	 */
	public function buildCurrentPageURI() {
		$protocol = is_ssl() ? 'https' : 'http';
		$site     = $_SERVER['SERVER_NAME'];
		$slug     = $_SERVER['REQUEST_URI'];
		
		return $protocol . '://' . $site . $slug;
	}
	
	/**
	 * Check if user has authorized our application
	 * @return bool
	 */
	public function hasUserConnected() {
		$accessToken = get_option( self::ACCESS_TOKEN_FIELD );
		
		return ! empty( $accessToken );
	}
	
	/**
	 * Checks if provided transient exists in the database
	 *
	 * @param $transientConfig
	 *
	 * @return bool
	 */
	private function transientExists( $transientConfig ) {
		return ! empty( $transientConfig['transient_time'] ) && get_transient( $transientConfig['transient_id'] );
	}
	
	/**
	 * Updates transient with new data if transient time isn't empty. In other case it deletes it
	 *
	 * @param $transientConfig
	 * @param $data
	 */
	private function updateTransient( $transientConfig, $data ) {
		if ( ! empty( $transientConfig['transient_time'] ) && ! empty( $transientConfig['transient_id'] ) ) {
			set_transient( $transientConfig['transient_id'], $data, $transientConfig['transient_time'] );
		} elseif ( empty( $transientConfig['transient_time'] ) && ! empty( $transientConfig['transient_id'] ) ) {
			delete_transient( $transientConfig['transient_id'] );
		}
	}
	
	/**
	 * Returns transient content if it exists
	 *
	 * @param $transient
	 *
	 * @return bool|mixed
	 */
	private function getTransient( $transient ) {
		if ( ! empty( $transient['transient_time'] ) && ! empty( $transient['transient_id'] ) ) {
			return get_transient( $transient['transient_id'] );
		}
		
		return false;
	}
}