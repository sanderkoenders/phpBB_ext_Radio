<?php
/**
*
* @package phpBB Extension - Archcry Radio
* @copyright (c) 2013 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace archcry\radio\acp;

class main_module
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $cache, $request;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		//$user->add_lang_ext('archcry/radio', 'acp/common');
		$this->tpl_name = 'radio_body';
		$this->page_title = $user->lang('ACP_RADIO_TITLE');
		add_form_key('archcry/radio');

		if ($request->is_set_post('submit'))
		{
			if (!check_form_key('archcry/radio'))
			{
				trigger_error('FORM_INVALID');
			}

			$config->set('archcry_radio_host', $request->variable('archcry_radio_host', ''));
			$config->set('archcry_radio_port', $request->variable('archcry_radio_port', ''));
			$config->set('archcry_radio_user', $request->variable('archcry_radio_user', ''));
			$config->set('archcry_radio_passwd', $request->variable('archcry_radio_passwd', ''));
			$config->set('archcry_radio_type', $request->variable('archcry_radio_type', ''));
			
			$config->set('archcry_radio_winamp_url', $request->variable('archcry_radio_winamp_url', ''));
			$config->set('archcry_radio_wmp_url', $request->variable('archcry_radio_wmp_url', ''));
			$config->set('archcry_radio_real_url', $request->variable('archcry_radio_real_url', ''));
			$config->set('archcry_radio_itunes_url', $request->variable('archcry_radio_itunes_url', ''));

			trigger_error($user->lang('ACP_RADIO_SETTING_SAVED') . adm_back_link($this->u_action));
		}

		$template->assign_vars(array(
			'U_ACTION'					=> $this->u_action,

			'ARCHCRY_RADIO_TYPE'		=> $config['archcry_radio_type'],

			'ARCHCRY_RADIO_HOST'		=> $config['archcry_radio_host'],
			'ARCHCRY_RADIO_PORT'		=> $config['archcry_radio_port'],
			'ARCHCRY_RADIO_USER'		=> $config['archcry_radio_user'],
			'ARCHCRY_RADIO_PASSWD'		=> $config['archcry_radio_passwd'],
			
			'ARCHCRY_RADIO_WINAMP_URL'	=> $config['archcry_radio_winamp_url'],
			'ARCHCRY_RADIO_WMP_URL'		=> $config['archcry_radio_wmp_url'],
			'ARCHCRY_RADIO_REAL_URL'	=> $config['archcry_radio_real_url'],
			'ARCHCRY_RADIO_ITUNES_URL'	=> $config['archcry_radio_itunes_url'],
		));
	}
}
