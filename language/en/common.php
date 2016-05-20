<?php
/**
*
* @package phpBB Extension - Archcry Radio
* @copyright (c) 2013 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	// Main page
	'STATION'					=> 'Current DJ',
	'SONG'						=> 'Current Song',
	'GENRE'						=> 'Genre',
	'BITRATE'					=> 'Bitrate',
	
	// Json
	'RADIO_NOT_AVAILABLE' 		=> 'Not Available',
	
	// ACP languages variables
	'ACP_RADIO_TYPE'			=> 'Radio type',
	'ACP_RADIO_GENERAL'			=> 'General Settings',
	'ACP_RADIO_TITLE'			=> 'Radio Module',
	'ACP_RADIO'					=> 'Settings',
	'ACP_RADIO_HOST'			=> 'Radio Host',
	'ACP_RADIO_PORT'			=> 'Port',
	'ACP_RADIO_USER'			=> 'Username',
	'ACP_RADIO_PASSWD'			=> 'Password',
	'ACP_RADIO_SETTING_SAVED'	=> 'Radio Settings Saved',
	
	// Links to files for music players
	'ACP_RADIO_MUSIC_PLAYERS'	=> 'Links For Music Players',
	'ACP_RADIO_WINAMP_URL'		=> 'Link To Winamp',
	'ACP_RADIO_WMP_URL'			=> 'Link To Windows Media Player',
	'ACP_RADIO_REAL_URL'		=> 'Link To RealPlayer',
	'ACP_RADIO_ITUNES_URL'		=> 'Link To Itunes'
));
