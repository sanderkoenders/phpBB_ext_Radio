<?php

namespace archcry\radio\library;

class ShoutcastAdapter extends Radio
{
    const USER_AGENT = 'Mozilla (DNAS 2 Statuscheck)';

    /**
     * Main function to call in order to receive all information for a broadcasting radio
     *
     * @return array|mixed
     */
    public function getInformation()
    {
        $radioInfo = $this->getInfoFromCache();

        if ($radioInfo === false) {
            $curl = curl_exec($this->initCurl($this->config));

            if ($curl)
            {
                $xml = @simplexml_load_string($curl);

                $radioInfo = $this->formatData($xml);
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
        $ch = curl_init($config['archcry_radio_host'] . '/admin.cgi?mode=viewxml&sid=1');

        // set curl connection parameter
        curl_setopt($ch, CURLOPT_PORT, $config['archcry_radio_port']);
        curl_setopt($ch, CURLOPT_USERAGENT, self::USER_AGENT);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $config['archcry_radio_user'] . ':' . $config['archcry_radio_passwd']);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);

        return $ch;
    }

    /**
     * Function to format information received from the broadcast server
     *
     * @param $xml
     * @return array
     */
    protected function formatData($xml)
    {
        $data = array(
            'currentListeners' => (string)(!empty($xml->CURRENTLISTENERS) ? $xml->CURRENTLISTENERS : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'peakListeners' => (string)(!empty($xml->PEAKLISTENERS) ? $xml->PEAKLISTENERS : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'maxListeners' => (string)(!empty($xml->MAXLISTENERS) ? $xml->MAXLISTENERS : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'reportedListeners' => (string)(!empty($xml->REPORTEDLISTENERS) ? $xml->REPORTEDLISTENERS : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'avarageTime' => (string)(!empty($xml->AVERAGETIME) ? $xml->AVERAGETIME : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'serverGenre' => (string)(!empty($xml->SERVERGENRE) ? $xml->SERVERGENRE : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'serverUrl' => (string)(!empty($xml->SERVERURL) ? $xml->SERVERURL : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'serverTitle' => (string)(!empty($xml->SERVERTITLE) ? $xml->SERVERTITLE : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'songTitle' => (string)(!empty($xml->SONGTITLE) ? $xml->SONGTITLE : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'nextTitle' => (string)(!empty($xml->NEXTTITLE) ? $xml->NEXTTITLE : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'songUrl' => (string)(!empty($xml->SONGURL) ? $xml->SONGURL : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'irc' => (string)(!empty($xml->IRC) ? $xml->IRC : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'icq' => (string)(!empty($xml->ICQ) ? $xml->ICQ : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'aim' => (string)(!empty($xml->AIM) ? $xml->AIM : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'streamStatus' => (string)(!empty($xml->STREAMSTATUS) ? $xml->STREAMSTATUS : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'bitrate' => (string)(!empty($xml->BITRATE) ? $xml->BITRATE : $this->user->lang('RADIO_NOT_AVAILABLE')),
            'content' => (string)(!empty($xml->CONTENT) ? $xml->CONTENT : $this->user->lang('RADIO_NOT_AVAILABLE'))
        );

        return array_merge($data, $this->baseData);
    }
}