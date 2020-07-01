<?php


namespace ThanksIO;

use Http\Client\Exception;
use stdClass;

class ThanksIOPreview extends ThanksIOResource
{

    /**
     * Generates a preview. Defaults to postcard.
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#3142074c-77f1-414d-84d9-d7dd55a69999
     * @param string $message
     * @param int $handwriting_style
     * @param string $type
     * @return stdClass
     */

    public function get(string $message, int $handwriting_style, string $type = 'postcard')
    {
        $payload = [
            'message' => $message,
            'handwriting_style' => $handwriting_style,
            'type' => $type
        ];

        return $this->client->post('preview', $payload);
    }
}
