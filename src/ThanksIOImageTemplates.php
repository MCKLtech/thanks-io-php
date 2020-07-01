<?php


namespace ThanksIO;

use Http\Client\Exception;
use stdClass;

class ThanksIOImageTemplates extends ThanksIOResource
{

    /**
     * List image templates
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#aa9586b6-406c-4d0a-b86b-f64518e02fab
     * @param array $options
     * @return stdClass
     */

    public function list(array $options = [])
    {
        return $this->client->get('image-templates', $options);
    }
}
