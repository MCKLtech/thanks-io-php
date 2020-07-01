<?php

namespace ThanksIO;

use Http\Client\Exception;
use stdClass;

class ThanksIOSend extends ThanksIOResource
{
    /**
     * Sends a postcard
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#a090f734-a32c-44c3-98f3-cbfbb2284142
     * @param array $options
     * @return stdClass
     */
    public function postcard(array $options)
    {
        return $this->client->post('send/postcard', $options);
    }

    /**
     * Sends a letter
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#2f075fa1-22d6-446d-9ec5-1aa99cb8beac
     * @param array $options
     * @return stdClass
     */
    public function letter(array $options)
    {
        return $this->client->post('send/letter', $options);
    }

    /**
     * Sends/Previews a Postcard with Radius
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#7833ef0c-887e-4229-a598-0f4b729416a8
     * @param array $options
     * @param array $radius
     * @return stdClass
     */
    public function postcard_radius(array $options, array $radius)
    {
        $options = array_merge($options, $radius);

        return $this->client->post('send/postcard', $options);
    }

    /**
     * Sends/Previews a Letter with Radius
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#7833ef0c-887e-4229-a598-0f4b729416a8
     * @param array $options
     * @param array $radius
     * @return stdClass
     */
    public function letter_radius(array $options, array $radius)
    {
        $options = array_merge($options, $radius);

        return $this->client->post('send/letter', $options);
    }

}
