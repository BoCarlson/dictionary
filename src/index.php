<?php
require './vendor/autoload.php';

use App\VinoShipper\Definitions;
use App\VinoShipper\Display;
use App\VinoShipper\Terms;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

$mysqli              = new mysqli("db", "root", "", "dictionary");
$Logger              = new Logger('dictionary-app');
$Definitions         = new Definitions($mysqli, $Logger);
$Display             = new Display();
$Terms               = new Terms($mysqli);

$term                = !empty($_REQUEST['term']) ? ucwords(strtolower($_REQUEST['term'])) : false;
$termDefinitions     = false;
$termSavedOrUpdated  = false;
$termDefinitionSaved = false;

$Logger->pushHandler(new StreamHandler(__DIR__ . '/logs/error.log', Logger::ERROR));

if($term) {
    $termSavedOrUpdated = $Terms->saveOrUpdate($term);

    if(!empty($_POST['definition']) && $termSavedOrUpdated) {
        $termDefinitionSaved = $Definitions->save($term, $_POST['definition']);
    }
}

$termDefinitions = !empty($term) ? $Definitions->lookupByTerm($term) : $termDefinitions;

require_once('./templates/index.php');
