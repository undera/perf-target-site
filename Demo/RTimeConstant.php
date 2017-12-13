<?php

namespace Demo;


use PWE\Core\PWELogger;

class RTimeConstant extends AbstractTextOutput
{

    protected function getTextOutput()
    {
        $duration = intval($_REQUEST['delay']);
        PWELogger::info("Sleeping for $duration");
        usleep($duration * 1000);
        return "Simulated response time: " . $duration . "ms";
    }
}