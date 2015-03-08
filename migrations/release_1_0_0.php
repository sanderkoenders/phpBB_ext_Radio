<?php
/**
*
* @package phpBB Extension - Archcry Radio
* @copyright (c) 2013 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace archcry\radio\migrations;

class release_1_0_0 extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['archcry_radio_host']);
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\alpha2');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('archcry_radio_useragent', '')),
			array('config.add', array('archcry_radio_host', '')),
			array('config.add', array('archcry_radio_port', '')),
			array('config.add', array('archcry_radio_passwd', '')),
			array('config.add', array('archcry_radio_user', '')),
			array('config.add', array('archcry_radio_winamp_url', '')),
			array('config.add', array('archcry_radio_wmp_url', '')),
			array('config.add', array('archcry_radio_real_url', '')),
			array('config.add', array('archcry_radio_itunes_url', '')),

			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_RADIO_TITLE'
			)),
			
			array('module.add', array(
				'acp',
				'ACP_RADIO_TITLE',
				array(
					'module_basename'	=> '\archcry\radio\acp\main_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}
}
