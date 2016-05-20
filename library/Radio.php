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