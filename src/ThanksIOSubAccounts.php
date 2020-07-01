<?php


namespace ThanksIO;

use Http\Client\Exception;
use stdClass;

class ThanksIOSubAccounts extends ThanksIOResource
{

    /**
     * List sub-accounts
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#ca2800e6-b7ce-481b-a8dc-741394785917
     * @param array $options
     * @return stdClass
     */

    public function list(array $options = [])
    {
        return $this->client->get('sub-accounts', $options);
    }

    /**
     * Show a specific sub-account
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#ca2800e6-b7ce-481b-a8dc-741394785917
     * @param int $id
     * @return stdClass
     */

    public function get(int $id)
    {
        return $this->client->get('sub-accounts/'.$id);
    }

    /**
     * Create a sub-account
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#ca2800e6-b7ce-481b-a8dc-741394785917
     * @param $options
     * @return stdClass
     */

    public function create($options)
    {
        return $this->client->post('sub-accounts', $options);
    }

    /**
     * Update a sub-account
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#ca2800e6-b7ce-481b-a8dc-741394785917
     * @param int $id
     * @param $options
     * @return stdClass
     */

    public function update($id, $options)
    {
        return $this->client->put('sub-accounts/'.$id, $options);
    }

    /**
     * Delete a sub-account
     *
     * @see    https://documenter.getpostman.com/view/4566474/SzYUagpS?version=latest#ca2800e6-b7ce-481b-a8dc-741394785917
     * @param int $id
     * @return stdClass
     */

    public function delete(int $id)
    {
        return $this->client->delete('sub-accounts/'.$id);
    }
}
