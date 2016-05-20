<?php

namespace archcry\radio\library;

abstract class Radio
{
    const CACHE_TIME = 30;
    const CACHE_ENTRY = '_radio';

    /* @var \phpbb\cache\service */
    protected $cache;

    /* @var \phpbb\user */
    protected $user;

    /* @var \phpbb\config\config */
    protected $config;

    /** Base data for the json api */
    protected $baseData;

    /**
     * Radio constructor.
     *
     * @param $cache
     * @param $config
     * @param $user
     */
    public function __construct($cache, $config, $user)
    {
        $this->cache = $cache;
        $this->config = $config;
        $this->user = $user;

        $this->baseData = array(
            'currentListeners' => $this->user->lang('RADIO_NOT_AVAILABLE'),
            'peakListeners' => $this->user->lang('RADIO_NOT_AVAILABLE'),
            'maxListeners' => $this->user->lang('RADIO_NOT_AVAILABLE'),
            'reportedListeners' => $this->user->lang('RADIO_NOT_AVAILABLE'),
            'avarageTime' => $this->user->lang('RADIO_NOT_AVAILABLE'),
            'serverGenre' => $this->user->lang('RADIO_NOT_AVAILABLE'),
            'serverUrl' => $this->user->lang('RADIO_NOT_AVAILABLE'),
            'serverTitle' => $this->user->lang('RADIO_NOT_AVAILABLE'),
            'songTitle' => $this->user->lang('RADIO_NOT_AVAILABLE'),
            'nextTitle' => $this->user->lang('RADIO_NOT_AVAILABLE'),
            'songUrl' => $this->user->lang('RADIO_NOT_AVAILABLE'),
            'irc' => $this->user->lang('RADIO_NOT_AVAILABLE'),
            'icq' => $this->user->lang('RADIO_NOT_AVAILABLE'),
            'aim' => $this->user->lang('RADIO_NOT_AVAILABLE'),
            'streamStatus' => $this->user->lang('RADIO_NOT_AVAILABLE'),
            'bitrate' => $this->user->lang('RADIO_NOT_AVAILABLE'),
            'content' => $this->user->lang('RADIO_NOT_AVAILABLE')
        );
    }

    /**
     * Main function to call in order to receive all information for a broadcasting radio
     *
     * @return array|mixed
     */
    public abstract function getInformation();

    /**
     * Function to initialize a curl connection to the broadcast server
     *
     * @param $config
     * @return resource
     */
    protected abstract function initCurl($config);

    /**
     * Function to format information received from the broadcast server
     *
     * @param $data
     * @return array
     */
    protected abstract function formatData($data);

    /**
     * Function to save received information to the cache
     *
     * @param $data
     * @return mixed
     */
    protected function saveInfoToCache($data) {
        // Save this to the cache to improve performance
        $this->cache->put(self::CACHE_ENTRY, $data, self::CACHE_TIME);
    }

    /**
     * Function to get radio information from the cache (if available)
     *
     * @return mixed
     */
    protected function getInfoFromCache() {
        return $this->cache->get(self::CACHE_ENTRY);
    }
}