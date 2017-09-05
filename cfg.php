<?php
require_once __DIR__ . '/vendor/autoload.php';

// local debugging settings
$level = \PWE\Core\PWELogger::WARNING;
$tempdir = sys_get_temp_dir();

\PWE\Core\PWELogger::setLevel($level);


/** @var $PWECore PWE\Core\PWECore */
$PWECore->setRootDirectory(__DIR__);
$PWECore->setXMLDirectory($PWECore->getDataDirectory());
$PWECore->setTempDirectory($tempdir);

$fname = $PWECore->getTempDirectory() . '/demo.xml';
if (!is_file($fname)) {
    file_put_contents($fname, "<registry/>");
}
$PWECore->getModulesManager()->setRegistryFile($fname);
