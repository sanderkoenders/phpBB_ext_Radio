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
use phpbb\cache\service;
use phpbb\user;
use phpbb\controller\helper;
use phpbb\config\config;

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
	 * @param \phpbb\config\config $config
	 * @param \phpbb\controller\helper $helper
	 * @param \phpbb\user $user
	 * @param \phpbb\cache\service $cache
	 */
	public function __construct(config $config, helper $helper, user $user, service $cache)
	{
		$this->config = $config;
		$this->user = $user;
		$this->cache = $cache;
	}

	/**
	 * @return Response
     */
	public function get()
	{
		$response = $this->initializeResponse();

		$radio = RadioFactory::initRadio(RadioFactory::SHOUTCAST, $this->cache, $this->config, $this->user);

		// Check if the radio information is available in our cache
		$information = $radio->getInformation();

		// Set content for the response
		$response->setContent(json_encode($information));

		// Send the response
		return $response;
	}

	/**
	 * @return Response
	 */
	private function initializeResponse()
	{
		$response = new Response();
		$response->headers->set('Content-Type', 'application/json');

		return $response;
	}
}
