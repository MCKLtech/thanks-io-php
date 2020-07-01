<?php


namespace ThanksIO;

use Http\Client\Exception;
use stdClass;

class ThanksIOEnvelopes extends ThanksIOResource
{
    /**
     * Show all available envelopes.
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#3142074c-77f1-414d-84d9-d7dd55a69999
     * @param array $options
     * @return stdClass
     */

    public function list(array $options = [])
    {
        return $this->client->get('letters/envelopes', $options);
    }

    /**
     * Show details of specific envelope
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#3142074c-77f1-414d-84d9-d7dd55a69999
     * @param int $id
     * @return stdClass
     */

    public function get(int $id)
    {
        return $this->client->get('letters/envelopes/'.$id);
    }
}
