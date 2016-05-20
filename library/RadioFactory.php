<?php

namespace archcry\radio\library;

class RadioFactory
{
    const SHOUTCAST = 'shoutcast';

    static public function initRadio($radioType, $cache, $config, $user) {
        switch($radioType) {
            case self::SHOUTCAST:
                return new Shoutcast($cache, $config, $user);
            break;
        }
    }
}