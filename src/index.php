<?php
require __DIR__ . '/vendor/autoload.php';

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use VinoShipper\Definitions;
use VinoShipper\Display;
use VinoShipper\Terms;

$mysqli              = new mysqli("db", "root", "", "dictionary");

$Definitions         = new Definitions($mysqli);
$Display             = new Display();
$Terms               = new Terms($mysqli);

$term                = !empty($_REQUEST['term']) ? ucwords(strtolower($_REQUEST['term'])) : false;
$termDefinitions     = false;
$termSavedOrUpdated  = false;
$termDefinitionSaved = false;

if($term) {
    $Terms->saveOrUpdate($term);

    if(!empty($_POST['definition']) && $termSavedOrUpdated) {
        $termDefinitionSaved = $Definitions->save($term, $_POST['definition']);
    }
}

$termDefinitions = !empty($term) ? $Definitions->lookupByTerm($term) : $termDefinitions;

require_once('./templates/index.php');
