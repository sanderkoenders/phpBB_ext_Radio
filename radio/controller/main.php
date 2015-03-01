<?php
/**
*
* @package phpBB Extension - Archcry Radio
* @copyright (c) 2013 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace archcry\radio\controller;
use Symfony\Component\HttpFoundation\Response;

class main
{
	/* @var \phpbb\config\config */
	protected $config;

	/* @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\template\template */
	protected $template;

	/* @var \phpbb\user */
	protected $user;
	
	/* @var \phpbb\cache\driver */
	protected $cache;

	private $scuseragent;
	private $schost;
	private $scport;
	private $scuser;
	private $scpass;
	private $scsid;

	/**
	* Constructor
	*
	* @param \phpbb\config\config		$config
	* @param \phpbb\controller\helper	$helper
	* @param \phpbb\template\template	$template
	* @param \phpbb\user				$user
	*/
	public function __construct(\phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\user $user, \phpbb\cache\service $cache)
	{
		$this->config = $config;
		$this->helper = $helper;
		$this->template = $template;
		$this->user = $user;
		$this->cache = $cache;
		
		// Radio Configuration
		$this->scuseragent	= ''; 
		$this->schost		= ''; 
		$this->scport		= ''; 
		$this->scuser		= ''; 
		$this->scpass		= ''; 
		$this->scsid		= ''; 
	}

	/**
	* Demo controller for route /demo/{name}
	*
	* @param string		$name
	* @return \Symfony\Component\HttpFoundation\Response A Symfony Response object
	*/
	public function get()
	{
		$response = new Response();
		$response->headers->set('Content-Type', 'application/json');

		// Check if the radio information is available in our cache
		if (($radio = $this->cache->get('_radio')) === false) {
			// Get radio information
			$radio = $this::getRadioInformation();

			// Save this to the cache to improve performance
			$this->cache->put('_radio', $radio, 30);
		}
		
		// Set content for the response
		$response->setContent(json_encode($radio));
		
		// Send the response
		return $response;
	}
	
	private function getRadioInformation() {
		//init curl connection 
		$ch = curl_init($this->schost . '/admin.cgi?mode=viewxml&sid=' . $this->scsid); 
		
		// set curl connection parameter 
		curl_setopt($ch, CURLOPT_PORT, $this->scport);
		curl_setopt($ch, CURLOPT_USERAGENT, $this->scuseragent);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, $this->scuser . ':' . $this->scpass); 
		
		// connect to shoutcastserver 
		$curl = curl_exec($ch); 
	
		// now get the xml data 
		if ($curl) 
		{ 
	   		$xml = @simplexml_load_string($curl); 

	    	$dnas_data = array ( 
		        'currentListeners'	=> (string) $xml->CURRENTLISTENERS, 
		        'peakListeners'		=> (string) $xml->PEAKLISTENERS, 
		        'maxListeners'		=> (string) $xml->MAXLISTENERS, 
		        'reportedListeners'	=> (string) $xml->REPORTEDLISTENERS, 
		        'avarageTime'		=> (string) $xml->AVERAGETIME, 
		        'serverGenre'		=> (string) $xml->SERVERGENRE, 
		        'serverUrl'			=> (string) $xml->SERVERURL, 
		        'serverTitle'		=> (string) $xml->SERVERTITLE, 
		        'songTitle'			=> (string) $xml->SONGTITLE, 
		        'nextTitle'			=> (string) $xml->NEXTTITLE, 
		        'songUrl'			=> (string) $xml->SONGURL, 
		        'irc'				=> (string) $xml->IRC, 
		        'icq'				=> (string) $xml->ICQ, 
		        'aim'				=> (string) $xml->AIM, 
		        'streamHits'        => (string) $xml->STREAMHITS, 
		        'streamStatus'		=> (string) $xml->STREAMSTATUS, 
		        'bitrate'			=> (string) $xml->BITRATE, 
		        'content'			=> (string) $xml->CONTENT, 
		        'version'			=> (string) $xml->VERSION, 
		    ); 
		
		    // Get Listeners and Songhistory 
		    if ($xml->STREAMSTATUS == 1) 
		    {
		        // store listener in array 
		        foreach ($xml->LISTENERS->LISTENER as $listener) 
		        { 
		            $dnas_data['listeners'][] = array( 
		                'ip' 			=> (string) $listener->HOSTNAME, 
		                'useragent' 	=> (string) $listener->USERAGENT, 
		                'connectTime' 	=> (string) $listener->CONNECTTIME, 
		                'pointer' 		=> (string) $listener->POINTER, 
		                'uid' 			=> (string) $listener->UID, 
		            ); 
		        } 
		
		        // store songhistory in array 
		        foreach ($xml->SONGHISTORY->SONG as $song) 
		        { 
		            $dnas_data['songHistory'][] = array( 
		                'playeDat' 	=> (string) $song->PLAYEDAT, 
		                'title' 	=> (string) $song->TITLE, 
		            ); 
		        } 
		    }
		} 
		else 
		{ 
		    $dnas_data = array('error' => 'connection error'); 
		} 
		
		return $dnas_data;		
	}
}
