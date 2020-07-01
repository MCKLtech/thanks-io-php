<?php


namespace ThanksIO;

use Http\Client\Exception;
use stdClass;

class ThanksIOMailingLists extends ThanksIOResource
{
    /**
     * List mailing lists
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#a610523d-f604-4aa2-abbf-59622b907fb1
     * @param array $options
     * @return stdClass
     */

    public function list(array $options = [])
    {
        return $this->client->get('mailing-lists', $options);
    }

    /**
     * Show recipients of a given mailing list
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#a610523d-f604-4aa2-abbf-59622b907fb1
     * @param int $id
     * @param array $options
     * @return stdClass
     */

    public function get(int $id, array $options = [])
    {
        return $this->client->get('mailing-lists/'.$id.'/recipients', $options);
    }
}
