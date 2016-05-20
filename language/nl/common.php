<?php

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
	'STATION'					=> 'Huidige DJ',
	'SONG'						=> 'Huidig Nummer',
	'GENRE'						=> 'Genre',
	'BITRATE'					=> 'Bitrate',
	
	// Json
	'RADIO_NOT_AVAILABLE' 		=> 'Niet beschikbaar',
	
	// ACP languages variables
	'ACP_RADIO_GENERAL'			=> 'Algemene Instellingen',
	'ACP_RADIO_TITLE'			=> 'Radio Module',
	'ACP_RADIO'					=> 'Instellingen',
	'ACP_RADIO_HOST'			=> 'Radio Host',
	'ACP_RADIO_PORT'			=> 'Poort',
	'ACP_RADIO_USER'			=> 'Gebruikersnaam',
	'ACP_RADIO_PASSWD'			=> 'Wachtwoord',
	'ACP_RADIO_SETTING_SAVED'	=> 'SHOUTcast Instellingen Opgeslagen',
	
	// Links to files for music players
	'ACP_RADIO_MUSIC_PLAYERS'	=> 'Links Voor Muziek Spelers',
	'ACP_RADIO_WINAMP_URL'		=> 'Link Voor Winamp',
	'ACP_RADIO_WMP_URL'			=> 'Link Voor Windows Media Player',
	'ACP_RADIO_REAL_URL'		=> 'Link Voor RealPlayer',
	'ACP_RADIO_ITUNES_URL'		=> 'Link Voor Itunes'
));
