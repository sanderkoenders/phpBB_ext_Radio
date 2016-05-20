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
	'STATION'					=> 'Текущая станция',
	'SONG'						=> 'Текущая песня',
	'GENRE'						=> 'Жанр',
	'BITRATE'					=> 'Битрейт',
	
	// Json
	'RADIO_NOT_AVAILABLE' 		=> 'Недоступно',
	
	// ACP languages variables
	'ACP_RADIO_TYPE'			=> 'Radio type [waiting for translation]',
	'ACP_RADIO_GENERAL'			=> 'Общие настройки',
	'ACP_RADIO_TITLE'			=> 'Радио модули',
	'ACP_RADIO'					=> 'Настройки',
	'ACP_RADIO_HOST'			=> 'Radio host [waiting for translation]',
	'ACP_RADIO_PORT'			=> 'Порт',
	'ACP_RADIO_USER'			=> 'Имя пользователя',
	'ACP_RADIO_PASSWD'			=> 'Пароль',
	'ACP_RADIO_SETTING_SAVED'	=> 'Radio Settings Saved [waiting for translation]',
	
	// Links to files for music players
	'ACP_RADIO_MUSIC_PLAYERS'	=> 'Ссылки для музыкальных проигрывателей',
	'ACP_RADIO_WINAMP_URL'		=> 'Ссылка на Winamp',
	'ACP_RADIO_WMP_URL'			=> 'Ссылка на Windows Media Player',
	'ACP_RADIO_REAL_URL'		=> 'Ссылка на RealPlayer',
	'ACP_RADIO_ITUNES_URL'		=> 'Ссылка на Itunes'
));
