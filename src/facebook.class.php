<?php
/**
 * @package: FreeValuatorApi
 * @link: https://github.com/FreeValuator/FreeValuatorAPI
 * @developer: Free Valuator
 * @email: info@feltkamp.tv
 * @tel: +31 (0) 20 785 4487
 * @website: http://www.freevaluator.com
 * @author: Pim Feltkamp
 * @copyright 2016 Pim Feltkamp
 * @license: http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @note: This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
**/

class FreeValuator{

    protected $username = false;
    protected $api_key = false;

    public function __construct($username, $api_key){
        $this->username = $username;
        $this->api_key = $api_key;
		$this->error = false;
		$this->error_curl = false;
		$this->httpcode = false;
		$this->retry = false;
		$this->api_url = 'https://api.freevaluator.com/?format=json&username='.$this->username.'&api_key='.$this->api_key;
    }// end function
	
	/** 
	* DOMAIN APPRAISAL
	*
	* This function will call the domain appraisal API. 
	*
	* @param string $domain
	*
	* @return: array $appraisal
	**/
	public function domainAppraisal($domain){
		$url = $this->getUrl('valuator', $domain);
		$data = $this->call($url);
		$data = $this->parseJson($data);
		return $data;
	}// end function
	
	/** 
	* WHOIS
	*
	* This function will call the whois API. 
	*
	* @param string $domain
	*
	* @return: array $data
	**/
	public function whois($domain){
		$url = $this->getUrl('whois', $domain);
		$data = $this->call($url);
		$data = $this->parseJson($data);
		return $data;
	}// end function
	
	/** 
	* REVERSE IP
	*
	* This function will call the reverse IP API. 
	*
	* @param string $domain
	*
	* @return: array $data
	**/
	public function reverseIP($domain){
		$url = $this->getUrl('reverseip', $domain);
		$data = $this->call($url);
		$data = $this->parseJson($data);
		return $data;
	}// end function
	
	/** 
	* FACEBOOK PAGE WORTH
	*
	* This function will call the Facebook page worth API. 
	*
	* @param string $facebook
	*
	* @return: array $data
	**/
	public function facebookPageWorth($facebook){
		$url = $this->getUrl('facebookworth', $facebook);
		$data = $this->call($url);
		$data = $this->parseJson($data);
		return $data;
	}// end function
	
	/** 
	* TWITTER USERNAME WORTH
	*
	* This function will call the Twitter username worth IP API. 
	*
	* @param string $twitter
	*
	* @return: array $data
	**/
	public function twitterUsernameWorth($twitter){
		$url = $this->getUrl('twitterworth', $twitter);
		$data = $this->call($url);
		$data = $this->parseJson($data);
		return $data;
	}// end function
	
	/** 
	* GET URL
	*
	* This function will return the correct url to call.
	*
	* @param string $todo
	* @param string $data
	*
	* @return: string $url
	**/
	public function getUrl($todo, $data){
		$url = $this->api_url.'&todo='.$todo.'&';
		switch($todo){
			case 'valuator':
			case 'reverseip':
			case 'whois':
				$url .= 'domain='.$data;
				break;
			case 'facebookworth':
				$url .= 'facebook='.$data;
				break;
			case 'twitterworth':
				$url .= 'twitter='.$data;
				break;
		}// switch		
		return $url;
	}// end function
	
	/** 
	* PARSE JSON
	*
	* This function will parse a JSON result. 
	*
	* @param string $json
	*
	* @return: array $data
	**/
	public function parseJson($json){
		$data = json_decode($json, true);
		return $data;
	}// end function
	
	/** 
	* CALL
	*
	* This function will perform the SOAP API call with Curl.
	*
	* @param string $action, array $params, string $request (optional)
	* 
	* @return: string $response
	**/
	public function call($url){
		$this->error = false;
		$this->error_curl = false;
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 20);
		
		$response = curl_exec($ch);
		if(!$response){
			$this->error_curl = curl_error($ch);
		}// no response
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if($http_code == 200){
			$this->retry = false;
			return $response;
		}elseif(empty($http_code) && !$this->retry){
			$this->retry = true;
			sleep(500000);
			return $this->call($url);
		}else{
			$this->retry = false;
			$this->httpcode = $http_code;
			$this->error = $response;
			return false;
		}// httpcode
	}// end function
	
	/** 
	* GET ERROR
	*
	* This function will return the error output.
	*
	* @return: string
	**/
	public function getError(){
		return $this->error;
	}// end function
}// end class
