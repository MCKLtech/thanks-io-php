<?php

namespace ThanksIO;

use Http\Client\Common\Plugin\ErrorPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Http\Message\RequestFactory;
use Http\Message\UriFactory;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use stdClass;

class ThanksIOClient
{
    /**
     * @var HttpClient $httpClient
     */
    public $httpClient;

    /**
     * @var RequestFactory $requestFactory
     */
    public $requestFactory;

    /**
     * @var UriFactory $uriFactory
     */
    public $uriFactory;

    /**
     * @var string API Access Token
     */
    public $access_token;

    /**
     * @var string Thanks.io API Version
     */
    private $version;

    /**
     * @var array $extraRequestHeaders
     */
    private $extraRequestHeaders;

    /**
     * @var array $rateLimitDetails
     */
    protected $rateLimitDetails = [];

    /**
     * @var ThanksIOSend $send
     */
    public $send;

    /**
     * @var ThanksIOPreview $preview
     */
    public $preview;

    /**
     * @var ThanksIOEnvelopes $envelopes
     */
    public $envelopes;

    /**
     * @var ThanksIOSubAccounts $subAccounts;
     */
    public $subAccounts;

    /**
     * @var ThanksIOMailingLists $mailingLists;
     */
    public $mailingLists;

    /**
     * @var ThanksIOImageTemplates $imageTemplates
     */
    public $imageTemplates;

    /**
     * @var ThanksIOMessageTemplates $messageTemplates
     */
    public $messageTemplates;

    /**
     * @var ThanksIOHandWritingStyles $handWritingStyles
     */
    public $handWritingStyles;

    /**
     * @var ThanksIORecipients $recipients
     */
    public $recipients;

    /**
     * @var ThanksIOOrders $orders
     */
    public $orders;

    const THANKS_IO_API_URL = 'https://api.thanks.io/api';

    /**
     * ThanksIOClient constructor.
     *
     * @param string $access_token The Thanks.io API access token
     * @param array $extraRequestHeaders Extra request headers to be sent in every api request
     * @param int $version API Version in use
     */
    public function __construct(string $access_token,  array $extraRequestHeaders = [], $version = 2)
    {
        $this->send = new ThanksIOSend($this);
        $this->preview = new ThanksIOPreview($this);
        $this->envelopes = new ThanksIOEnvelopes($this);
        $this->subAccounts = new ThanksIOSubAccounts($this);
        $this->mailingLists = new ThanksIOMailingLists($this);
        $this->imageTemplates = new ThanksIOImageTemplates($this);
        $this->messageTemplates = new ThanksIOMessageTemplates($this);
        $this->handWritingStyles = new ThanksIOHandWritingStyles($this);
        $this->recipients = new ThanksIORecipients($this);
        $this->orders = new ThanksIOOrders($this);

        $this->access_token = $access_token;

        $this->extraRequestHeaders = $extraRequestHeaders;
        $this->version = $version;

        $this->httpClient = $this->getDefaultHttpClient();
        $this->requestFactory = MessageFactoryDiscovery::find();
        $this->uriFactory = UriFactoryDiscovery::find();

    }

    /**
     * Sets the HTTP client.
     *
     * @param HttpClient $httpClient
     */
    public function setHttpClient(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Sets the request factory.
     *
     * @param RequestFactory $requestFactory
     */
    public function setRequestFactory(RequestFactory $requestFactory)
    {
        $this->requestFactory = $requestFactory;
    }

    /**
     * Sets the URI factory.
     *
     * @param UriFactory $uriFactory
     */
    public function setUriFactory(UriFactory $uriFactory)
    {
        $this->uriFactory = $uriFactory;
    }

    /**
     * Sends POST request to Nimble API.
     *
     * @param  string $endpoint
     * @param  array $json
     * @return stdClass
     */
    public function post($endpoint, $json)
    {
        $response = $this->sendRequest('POST', self::THANKS_IO_API_URL."/v$this->version/$endpoint", $json);

        return $this->handleResponse($response);
    }

    /**
     * Sends PUT request to Nimble API.
     *
     * @param  string $endpoint
     * @param  array $json
     * @return stdClass
     */
    public function put($endpoint, $json)
    {
        $response = $this->sendRequest('PUT', self::THANKS_IO_API_URL."/v$this->version/$endpoint", $json);

        return $this->handleResponse($response);
    }

    /**
     * Sends DELETE request to Nimble API.
     *
     * @param  string $endpoint
     * @param  array $json
     * @return stdClass
     */
    public function delete($endpoint, $json = [])
    {
        $response = $this->sendRequest('DELETE', self::THANKS_IO_API_URL."/v$this->version/$endpoint", $json);

        return $this->handleResponse($response);
    }

    /**
     * Sends GET request to Nimble API.
     *
     * @param string $endpoint
     * @param array  $queryParams
     * @return stdClass
     */
    public function get($endpoint, $queryParams = [])
    {

        $uri = $this->uriFactory->createUri(self::THANKS_IO_API_URL."/v$this->version/$endpoint");

        if (!empty($queryParams)) {
            $uri = $uri->withQuery(http_build_query($queryParams));
        }

        $response = $this->sendRequest('GET', $uri);

        return $this->handleResponse($response);
    }

    /**
     * Returns the next page of the result.
     *
     * @param  stdClass $pages URL of next page
     * @return stdClass
     */
    public function nextPage($pages)
    {
        $response = $this->sendRequest('GET', $pages->next);
        return $this->handleResponse($response);
    }

    /**
     * Gets the rate limit details.
     *
     * @return array
     */
    public function getRateLimitDetails()
    {
        return $this->rateLimitDetails;
    }

    /**
     * @return HttpClient
     */
    private function getDefaultHttpClient()
    {
        return new PluginClient(
            HttpClientDiscovery::find(),
            [new ErrorPlugin()]
        );
    }

    /**
     * @return array
     */
    private function getRequestHeaders()
    {
        return array_merge(
            [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            $this->extraRequestHeaders
        );
    }

    /**
     * @return array
     */
    private function getRequestAuthHeaders()
    {
        return  [
            'Authorization' => 'Bearer '.$this->access_token
        ];

    }

    /**
     * @param string              $method
     * @param string|UriInterface $uri
     * @param array|string|null   $body
     *
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     */
    private function sendRequest($method, $uri, $body = null)
    {
        $headers = $this->getRequestHeaders();

        $authHeaders = $this->getRequestAuthHeaders();

        $headers = array_merge($headers, $authHeaders);

        $body = is_array($body) ? json_encode($body) : $body;

        $request = $this->requestFactory->createRequest($method, $uri, $headers, $body);

        return $this->httpClient->sendRequest($request);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return stdClass
     */
    public function handleResponse(ResponseInterface $response)
    {
        $this->setRateLimitDetails($response);

        $stream = $response->getBody()->getContents();

        return json_decode($stream);
    }

    /**
     * @param ResponseInterface $response
     */
    private function setRateLimitDetails(ResponseInterface $response)
    {
        $this->rateLimitDetails = [
            'reset_at' => $response->hasHeader('RateLimit-Reset')
                ? (int)$response->getHeader('RateLimit-Reset')
                : null,
        ];
    }

}
