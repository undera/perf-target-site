<?php

namespace Demo;


use PWE\Core\PWELogger;
use PWE\Modules\Outputable;
use PWE\Modules\PWEModule;

class RTimeFlapping extends PWEModule implements Outputable
{
    public function process()
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

        $smarty = $this->PWE->getSmarty();
        $smarty->setTemplateFile(__DIR__ . '/text.tpl');
        $smarty->assign("content", "Simulated response time: " . $duration . "ms");
        $this->PWE->addContent($smarty);
    }
}