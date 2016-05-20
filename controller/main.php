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
use phpbb\config\config;

class main
{
	/* @var \phpbb\config\config */
	protected $config;

	/* @var \phpbb\cache\service */
	protected $cache;

	/* @var \phpbb\user */
	protected $user;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config $config
	 * @param \phpbb\user $user
	 * @param \phpbb\cache\service $cache
	 */
	public function __construct(config $config, service $cache, user $user)
	{
		$this->config = $config;
		$this->cache = $cache;
		$this->user = $user;
	}

	/**
	 * @return Response
     */
	public function get()
	{
		$response = $this->initializeResponse();

		$radio = RadioFactory::initRadio($this->config['archcry_radio_type'], $this->cache, $this->config, $this->user);

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
