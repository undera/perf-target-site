<?php

namespace Demo;


use PWE\Auth\PWEUserAuthController;
use PWE\Core\PWECore;
use PWE\Exceptions\HTTP5xxException;
use PWE\Modules\AbstractRESTCall;

class AbstractCollection extends AbstractRESTCall
{
    /**
     * @var \Demo\AuthController
     */
    protected $context;

    public function __construct(PWECore $core)
    {
        parent::__construct($core);
        $this->context = PWEUserAuthController::getAuthControllerInstance($core);
        if (!($this->context instanceof AuthController)) {
            throw new HTTP5xxException("Wrong auth controller");
        }

    }

}