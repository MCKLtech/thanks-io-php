<?php


namespace ThanksIO;

use Http\Client\Exception;
use stdClass;

class ThanksIOOrders extends ThanksIOResource
{

    /**
     * Track an order by ID
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#acf0561c-30ce-4698-a7c7-bfc127d72136
     * @param array $options
     * @return stdClass
     */

    public function track(string $id)
    {
        return $this->client->get('orders/'.$id.'/track');
    }

    /**
     * Return summary of stats for orders
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#acf0561c-30ce-4698-a7c7-bfc127d72136
     * @param int $id
     * @return stdClass
     */

    public function stats(array $options = [])
    {
        return $this->client->get('orders/stats', $options);
    }
}
