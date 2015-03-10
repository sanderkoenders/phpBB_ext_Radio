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
	'STATION'					=> 'Aktuelle Station',
	'SONG'						=> 'Aktuelles Lied',
	'GENRE'						=> 'Art',
	'BITRATE'					=> 'Bitrate',
	
	// Json
	'RADIO_NOT_AVAILABLE' 		=> 'Nicht verfügbar',
	
	// ACP languages variables
	'ACP_RADIO_GENERAL'			=> 'Allgemeine Einstellungen',
	'ACP_RADIO_TITLE'			=> 'Radio Module',
	'ACP_RADIO'					=> 'Einstellungen',
	'ACP_RADIO_HOST'			=> 'SHOUTcast-Host',
	'ACP_RADIO_USERAGENT'		=> 'Useragent',
	'ACP_RADIO_PORT'			=> 'Port',
	'ACP_RADIO_USER'			=> 'Benutzername',
	'ACP_RADIO_PASSWD'			=> 'Passwort',
	'ACP_RADIO_SETTING_SAVED'	=> 'SHOUTcast-Einstellungen gespeichert',
	
	// Links to files for music players
	'ACP_RADIO_MUSIC_PLAYERS'	=> 'Links zu den Musikplayers',
	'ACP_RADIO_WINAMP_URL'		=> 'Link zu Winamp',
	'ACP_RADIO_WMP_URL'			=> 'Link zu Windows Media Player',
	'ACP_RADIO_REAL_URL'		=> 'Link zu RealPlayer',
	'ACP_RADIO_ITUNES_URL'		=> 'Link zu Itunes'
));
