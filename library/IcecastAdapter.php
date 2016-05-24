<?php

namespace archcry\radio\library;

class IcecastAdapter extends Radio
{
    public function getInformation()
    {
        $radioInfo = $this->getInfoFromCache();

        if ($radioInfo === false)
        {
            $curl = curl_exec($this->initCurl($this->config));

            if ($curl)
            {
                $json = @json_decode($curl);

                $radioInfo = $this->formatData($json->icestats->source);
            }
            else
            {
                $radioInfo = array('error' => $this->user->lang('RADIO_NOT_AVAILABLE'));
            }

            // Save this to the cache to improve performance
            $this->saveInfoToCache($radioInfo);
        }

        return $radioInfo;
    }

    /**
     * Function to initialize a curl connection to the broadcast server
     *
     * @param $config
     * @return resource
     */
    protected function initCurl($config)
    {
        // initialize curl connection
        $ch = curl_init($config['archcry_radio_host'] . ':' . $config['archcry_radio_port'] . '/status-json.xsl');

        // set curl connection parameter
        curl_setopt($ch, CURLOPT_PORT, $config['archcry_radio_port']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);

        return $ch;
    }

    /**
     * Function to format information received from the broadcast server
     *
     * @param $json
     * @return array
     */
    protected function formatData($json)
    {
        $data = array(
            'currentListeners' => (string)(!empty($json->listeners) ? $json->listeners : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'peakListeners' => (string)(!empty($json->listener_peak) ? $json->listener_peak : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'serverGenre' => (string)(!empty($json->genre) ? $json->genre : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'serverUrl' => (string)(!empty($json->listenurl) ? $json->listenurl : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'serverTitle' => (string)(!empty($json->server_name) ? $json->server_name : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'songTitle' => (string)(!empty($json->title) ? $json->title : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'bitrate' => (string)(!empty($json->bitrate) ? $json->bitrate : $this->user->lang('RADIO_NOT_AVAILABLE')),
        );

        return array_merge($this->baseData, $data);
    }
}