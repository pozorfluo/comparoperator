<?php

declare(strict_types=1);

namespace Controllers;

use Models\Model;

/**
 * RESTish API
 * 
 * Mapping between query parameters as dissected by the Dispatcher and this
 * RESTish API :
 * 
 *     Controller       -> API
 *     Action           -> endpoint
 *     Sub              -> sub-resource
 *     Request Method   -> mode of operation
 *     Other Parameters -> query parameters
 * 
 * Use the request method to define the mode of operation for this endpoint.
 *   
 *     Mode of operation
 *       GET    -> fetch
 *       POST   -> add
 *       PUT    -> update/edit
 *       DELETE -> remove
 * 
 * Prepend names of method available for each resource with 'rest' to make it 
 * clear what is meant to be a callable action and thwart some malicious 
 * requests.
 * 
 * @example
 *
 *         restGET()
 *         restPOSTEndpointSubresource()
 *         restPUTEndpoint()
 *         restDELETE()
 * 
 * @todo
 *   - [ ] Implement API rate limiting
 *     + [ ] See https://www.yiiframework.com/doc/guide/2.0/en/rest-rate-limiting
 */
abstract class API extends Controller
{
    /**
     * Associate a status string to a status code integer.
     *
     *   1xx Informational
     *   2xx Success
     *   3xx Redirection 
     *   4xx Client Error
     *   5xx Server Error
     * 
     * @see [MDN HTTP response status codes](https://developer.mozilla.org/en-US/docs/Web/HTTP/Status)
     * 
     * @var array [int => string]
     */
    const STATUS = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Time-out',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Large',
        415 => 'Unsupported Media Type',
        416 => 'Requested range not satisfiable',
        417 => 'Expectation Failed',
        421 => 'Misdirected Request',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Too Early',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        451 => 'Unavailable For Legal Reasons',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Time-out',
        505 => 'HTTP Version not supported'
    ];


    public function __construct(array $args = [])
    {
        parent::__construct($args);

        /**
         * @todo
         *   - [ ] Allow and handle CORS
         *     + [ ] See https://stackoverflow.com/questions/8719276/cross-origin-request-headerscors-with-php-headers
         *     + [ ] Implement some kind of API key checking
         *   - [ ] Implement Auth
         */
        // header('Access-Control-Allow-Origin: *');
        // header('Access-Control-Allow-Methods: *');

        // header('Content-Type: application/json');
    }

    /**
     * Return the status string for a given status code
     */
    public static function status(int $code): string
    {
        return self::STATUS[$code] ?? self::STATUS[500];
    }

    /**
     * 
     */
    protected function emit(?array $data, int $status_code): self
    {
        header('Content-Type: application/json');

        $status = self::status($status_code);
        header("HTTP/1.1 {$status_code} {$status}");

        /* keep it around for optional caching */
        $this->rendered_page = json_encode($data);
        echo $this->rendered_page;

        return $this;
    }

    public function call(): self
    {
        /**
         * note
         *   'escaping' and providing default action
         *   Endpoint may access multiple sub-ressources with different methods
         */
        $this->args['method'] =
            'rest'
            . ($this->args['method'] ?? 'GET')
            . ($this->args['endpoint'] ?? '')
            . ($this->args['sub'] ?? '');

        // echo $this->args['method'];
        // exit();
        
        if (method_exists($this, $this->args['method'])) {
            /* requested mode of operation exists, run it */
            $this->emit(
                $this->{$this->args['method']}(),
                $this->args['status_code']
            );
        } else {
            /* mode of operation does NOT exist on this endpoint */
            $this->emit(['no can do'], 405);
        }

        return $this;
    }
    /**
     * @note
     *   Overriding Controller->cache()
     * 
     *   This controller emits json content and need to set an appropriate 
     *   header before serving.
     * 
     *   The html cache behaviour is not suitable for calls to this RESTish
     *   API controller
     * 
     *   As a hacky workaround, this turns cache() into a NOP
     * 
     * @todo
     *   - [ ] Handle Dispatcher-level cache for json emission more gracefully
     * 
     */
    public function cache(): Controller
    {
        return $this;
    }

    /**
     * @note
     *   Prepend all model mode of operation meant to be callable by a request
     *   with 'op'
     */
    abstract public function runDefault(array $args);

    /**
     * 
     */
    private function restGET(): ?array
    {
        /* use existing model or load one */
        // $this->model ?? $this->loadModel();

        $this->args['status_code'] = 405;
        return ['GET : not implemented yet'];
    }

    /**
     * 
     */
    private function restPOST(): ?array
    {
        /* use existing model or load one */
        // $this->model ?? $this->loadModel();

        $this->args['status_code'] = 405;
        return ['POST : not implemented yet'];
    }

    /**
     *
     */
    private function restPUT(): ?array
    {
        /* use existing model or load one */
        // $this->model ?? $this->loadModel();

        $this->args['status_code'] = 405;
        return ['PUT : not implemented yet'];
    }

    /**
     * 
     */
    private function restDELETE(): ?array
    {
        /* use existing model or load one */
        // $this->model ?? $this->loadModel();

        $this->args['status_code'] = 405;
        return ['DELETE : not implemented yet'];
    }
}
