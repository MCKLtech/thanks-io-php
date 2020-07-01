<?php


namespace ThanksIO;

abstract class ThanksIOResource
{
    /**
     * @var ThanksIOClient
     */
    protected $client;

    /**
     * ThanksIOResource constructor.
     *
     * @param ThanksIOClient $client
     */
    public function __construct(ThanksIOClient $client)
    {
        $this->client = $client;
    }
}
