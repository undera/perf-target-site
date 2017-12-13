<?php

namespace Demo;


use PWE\Modules\Outputable;
use PWE\Modules\PWEModule;

abstract class AbstractTextOutput extends PWEModule implements Outputable
{
    public function process()
    {
        $smarty = $this->PWE->getSmarty();
        $smarty->setTemplateFile(__DIR__ . '/text.tpl');
        $smarty->assign("content", $this->getTextOutput());
        $this->PWE->addContent($smarty);

    }

    abstract protected function getTextOutput();
}