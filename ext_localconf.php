<?php
if (!defined('TYPO3')) {
    die ('Access denied.');
}

// Add Debug Logger to Doctrine via first Hook in TYPO3
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['GLOBAL']['extTablesInclusion-PostProcessing'][]
    = \StefanFroemken\Mysqlreport\Hook\RegisterDatabaseLoggerHook::class;

// TRUNCATE table tx_mysqlreport_domain_model_profile on clear cache action
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearCachePostProc'][]
    = \StefanFroemken\Mysqlreport\EventListener\CacheAction::class . '->clearProfiles';
