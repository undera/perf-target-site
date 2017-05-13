<?php

namespace Demo;

use PWE\Exceptions\HTTP2xxException;
use PWE\Modules\Outputable;
use PWE\Modules\PWEModule;

class HTTPCodes extends PWEModule implements Outputable
{
    public static $status_codes = array(
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => 'Switch Proxy',
        307 => 'Temporary Redirect',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        424 => 'Failed Dependency',
        425 => 'Unordered Collection',
        426 => 'Upgrade Required',
        449 => 'Retry With',
        450 => 'Blocked by Windows Parental Controls',
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        509 => 'Bandwidth Limit Exceeded',
        510 => 'Not Extended'
    );


    public function process()
    {
        $params = $this->PWE->getURL()->getParamsAsArray();
        if ($params[0] == 'random') {
            $code = array_rand(self::$status_codes);
        } elseif (!$params) {
            $code = false;
        } else {
            $code = intval($params[0]);
        }

        // TODO: special handling for 3xx
        if ($code == 302) {
            $this->PWE->sendHTTPHeader("Location: ./301");
        } elseif ($code == 301) {
            $this->PWE->sendHTTPHeader("Location: ./202");
        } elseif ($code == 204) {
            throw new HTTP2xxException("", HTTP2xxException::NO_CONTENT);
        }

        // TODO: special handling for 2xx

        $this->PWE->sendHTTPStatusCode($code);
        $smarty = $this->PWE->getSmarty();
        $smarty->setTemplateFile('dat/httpcodes.tpl');
        $smarty->assign("codes", self::$status_codes);
        $smarty->assign("code", $code);
        $this->PWE->addContent($smarty);
    }
}