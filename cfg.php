<?php
require_once __DIR__ . '/vendor/autoload.php';

// local debugging settings
$level = \PWE\Core\PWELogger::DEBUG;
$tempdir = sys_get_temp_dir();
$logfile = "/tmp/demo-pwe.".posix_geteuid().".log";

\PWE\Core\PWELogger::setStdErr($logfile);
\PWE\Core\PWELogger::setStdOut($logfile);
\PWE\Core\PWELogger::setLevel($level);


/** @var $PWECore PWE\Core\PWECore */
$PWECore->setRootDirectory(__DIR__);
$PWECore->setXMLDirectory($PWECore->getDataDirectory());
$PWECore->setTempDirectory($tempdir);

if (!is_dir("/home/gettauru")) {
    $fname=$tempdir.'/taurus.xml';
    if (!is_file($fname)) {
      file_put_contents($fname, "<registry/>");
    }

    $PWECore->getModulesManager()->setRegistryFile($fname);
}

require_once __DIR__."/updates.php";
require_once __DIR__."/Taurus/TaurusWikiSyntax.php";
require_once __DIR__."/Taurus/DoubleCode.php";