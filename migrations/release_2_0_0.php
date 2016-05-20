<?php

namespace archcry\radio\migrations;

class release_2_0_0 extends \phpbb\db\migration\migration
{
    public function effectively_installed()
    {
        return isset($this->config['archcry_radio_type']);
    }

    static public function depends_on()
    {
        return array('\archcry\radio\migrations\release_1_0_0');
    }

    public function update_data()
    {
        return array(
            array('config.remove', array('archcry_radio_useragent', '')),
            array('config.add', array('archcry_radio_type', ''))
        );
    }
}
