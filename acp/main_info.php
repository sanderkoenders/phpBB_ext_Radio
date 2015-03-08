<?php
/**
*
* @package phpBB Extension - Archcry Radio
* @copyright (c) 2013 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace archcry\radio\acp;

class main_info
{
	function module()
	{
		return array(
			'filename'	=> '\archcry\radio\acp\main_module',
			'title'		=> 'ACP_RADIO_TITLE',
			'version'	=> '0.0.1',
			'modes'		=> array(
				'settings'	=> array('title' => 'ACP_RADIO', 'auth' => 'ext_archcry/radio && acl_a_board', 'cat' => array('ACP_RADIO_TITLE')),
			),
		);
	}
}
