<?php
/**
*
* @package phpBB Extension - Archcry Radio
* @copyright (c) 2013 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace archcry\radio\controller;
use archcry\radio\library\RadioFactory;
use Symfony\Component\HttpFoundation\Response;

class main
{
	/* @var \phpbb\config\config */
	protected $config;

	/* @var \phpbb\controller\helper */
	protected $helper;

	/* @var \phpbb\user */
	protected $user;
	
	/* @var \phpbb\cache\service */
	protected $cache;

	/**
	* Constructor
	*
	* @param \phpbb\config\config		$config
	* @param \phpbb\controller\helper	$helper
	* @param \phpbb\user				$user
	*/
	public function __construct(\phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\user $user, \phpbb\cache\service $cache)
	{
		$this->config = $config;
		$this->user = $user;
		$this->helper = $helper;
		$this->cache = $cache;
	}

	/**
	 * @return Response
     */
	public function get()
	{
		$response = new Response();
		$response->headers->set('Content-Type', 'application/json');

		$radio = RadioFactory::initRadio(RadioFactory::SHOUTCAST, $this->cache, $this->config, $this->user);

		// Check if the radio information is available in our cache
		$information = $radio->checkCache();

		// Set content for the response
		$response->setContent(json_encode($information));

		// Send the response
		return $response;
	}
}
