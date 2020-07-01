<?php


namespace ThanksIO;

use Http\Client\Exception;
use stdClass;

class ThanksIOHandWritingStyles extends ThanksIOResource
{

    /**
     * List Handwriting Styles
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#5d354708-3e64-4468-93f6-3b0d081c0f2a
     * @param array $options
     * @return stdClass
     */

    public function list(array $options = [])
    {
        return $this->client->get('handwriting-styles', $options);
    }
}
