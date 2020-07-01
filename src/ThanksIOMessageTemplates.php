<?php


namespace ThanksIO;

use Http\Client\Exception;
use stdClass;

class ThanksIOMessageTemplates extends ThanksIOResource
{

    /**
     * List message templates
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#747b17f0-64a7-4200-ba8f-953ed8778fc0
     * @param array $options
     * @return stdClass
     */

    public function list(array $options = [])
    {
        return $this->client->get('message-templates', $options);
    }
}
