<?php

namespace Demo;


use PWE\Core\PWELogger;
use PWE\Modules\Outputable;
use PWE\Modules\PWEModule;

class RTimeConstant extends PWEModule implements Outputable
{
    public function process()
    {
        $duration = intval($_REQUEST['delay']);
        PWELogger::info("Sleeping for $duration");
        sleep($duration);

        $smarty = $this->PWE->getSmarty();
        $smarty->setTemplateFile(__DIR__ . '/text.tpl');
        $smarty->assign("content", "Simulated response time: " . $duration . "ms");
        $this->PWE->addContent($smarty);
    }
}