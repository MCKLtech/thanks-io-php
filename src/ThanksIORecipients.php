<?php


namespace ThanksIO;

use Http\Client\Exception;
use stdClass;

class ThanksIORecipients extends ThanksIOResource
{

    /**
     * Show a specific recipient
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#531c9124-66a9-459a-95c7-fb3d11aec6f8
     * @param int $id
     * @return stdClass
     */

    public function get(int $id)
    {
        return $this->client->get('recipients/'.$id);
    }

    /**
     * Create a recipient
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#531c9124-66a9-459a-95c7-fb3d11aec6f8
     * @param $options
     * @return stdClass
     */

    public function create($options)
    {
        return $this->client->post('recipients', $options);
    }

    /**
     * Update details of a specific recipient by ID.
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#531c9124-66a9-459a-95c7-fb3d11aec6f8
     * @param int $id
     * @param $options
     * @return stdClass
     */

    public function update($id, $options)
    {
        return $this->client->put('recipients/'.$id, $options);
    }

    /**
     * Delete a recipient
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#531c9124-66a9-459a-95c7-fb3d11aec6f8
     * @param int $id
     * @return stdClass
     */

    public function delete(int $id)
    {
        return $this->client->delete('sub-accounts/'.$id);
    }
}
