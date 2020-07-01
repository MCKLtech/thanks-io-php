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
     * @param int $image_template
     * @param int $handwriting_style
     * @param string $message
     * @param array $recipients
     * @param array $otherElements
     * @return stdClass
     */
    public function postcard(int $image_template, int $handwriting_style, string $message, array $recipients, array $otherElements = [])
    {
        $payload = [
            'image_template' => $image_template,
            'handwriting_style' => $handwriting_style,
            'message' => $message,
            'recipients' => $recipients
        ];

        $payload = array_merge($payload, $otherElements);

        return $this->client->post('send/postcard', $payload);
    }

    /**
     * Sends a letter
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#2f075fa1-22d6-446d-9ec5-1aa99cb8beac
     * @param string $front_image_url
     * @param int $handwriting_style
     * @param string $message
     * @param array $mailing_lists
     * @param array $otherElements
     * @return stdClass
     */
    public function letter(string $front_image_url, int $handwriting_style, string $message, array $mailing_lists, array $otherElements = [])
    {
        $payload = [
            'front_image_url' => $front_image_url,
            'handwriting_style' => $handwriting_style,
            'message' => $message,
            'mailing_lists' => $mailing_lists
        ];

        $payload = array_merge($payload, $otherElements);

        return $this->client->post('send/letter', $payload);
    }

    /**
     * Sends a 6x9 Postcard with Radius
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#7833ef0c-887e-4229-a598-0f4b729416a8
     * @param int $image_template
     * @param int $handwriting_style
     * @param int $message_template
     * @param string $size
     * @param int $sub_account
     * @param array $radius
     * @return stdClass
     */
    public function postcard_radius(int $image_template, int $handwriting_style, int $message_template, string $size, int $sub_account, array $radius)
    {
        $payload = [
            'image_template' => $image_template,
            'handwriting_style' => $handwriting_style,
            'message_template' => $message_template,
            'size' => $size,
            'sub_account' => $sub_account
        ];

        $payload = array_merge($payload, $radius);

        return $this->client->post('send/postcard', $payload);
    }

    /**
     * Return Order Preview of Radius Search
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#7833ef0c-887e-4229-a598-0f4b729416a8
     * @param int $image_template
     * @param int $handwriting_style
     * @param int $message_template
     * @param string $size
     * @param int $sub_account
     * @param array $radius
     * @return stdClass
     */
    public function letter_radius(int $image_template, int $handwriting_style, int $message_template, string $size, int $sub_account,  array $radius)
    {
        $payload = [
            'image_template' => $image_template,
            'handwriting_style' => $handwriting_style,
            'message_template' => $message_template,
            'size' => $size,
            'sub_account' => $sub_account
        ];

        $payload = array_merge($payload, $radius);

        return $this->client->post('send/letter', $payload);
    }

}
