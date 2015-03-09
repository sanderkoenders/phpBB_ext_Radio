<?php
/**
*
* @package phpBB Extension - Archcry Radio
* @copyright (c) 2013 phpBB Group
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* @polish translation by HPK
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
	'STATION'					=> 'Gra',
	'SONG'						=> 'Audycja',
	'GENRE'						=> 'Gatunek',
	'BITRATE'					=> 'Jakość',
	
	// Json
	'RADIO_NOT_AVAILABLE' 		=> 'Niedostępne',
	
	// ACP languages variables
	'ACP_RADIO_GENERAL'			=> 'Główne ustawienia',
	'ACP_RADIO_TITLE'			=> 'Radio Module',
	'ACP_RADIO'					=> 'Ustawienia',
	'ACP_RADIO_HOST'			=> 'SHOUTcast Host',
	'ACP_RADIO_USERAGENT'		=> 'Useragent',
	'ACP_RADIO_PORT'			=> 'Port',
	'ACP_RADIO_USER'			=> 'Użytkownik',
	'ACP_RADIO_PASSWD'			=> 'Hasło',
	'ACP_RADIO_SETTING_SAVED'	=> 'Konfiguracja SHOUTcast zmieniona.',
	
	// Links to files for music players
	'ACP_RADIO_MUSIC_PLAYERS'	=> 'Linki do odtwarzania',
	'ACP_RADIO_WINAMP_URL'		=> 'Link do Winamp',
	'ACP_RADIO_WMP_URL'			=> 'Link do Windows Media Player',
	'ACP_RADIO_REAL_URL'		=> 'Link do RealPlayer',
	'ACP_RADIO_ITUNES_URL'		=> 'Link do Itunes'
));
