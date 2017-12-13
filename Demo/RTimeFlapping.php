<?php

namespace Demo;


use PWE\Core\PWELogger;

class RTimeFlapping extends AbstractTextOutput
{

    protected function getTextOutput()
    {
        $relaxed = max(intval($_REQUEST['relaxed']), 1);
        $stuck = max(intval($_REQUEST['stuck']), 1);
        if ((time() % ($relaxed + $stuck)) > $relaxed) {
            $duration = intval($_REQUEST['delay_stuck']);
        } else {
            $duration = intval($_REQUEST['delay_relaxed']);
        }


        PWELogger::info("Sleeping for $duration");
        usleep($duration * 1000);
        return "Simulated response time: " . $duration . "ms";
    }
}