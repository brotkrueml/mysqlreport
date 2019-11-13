<?php
namespace StefanFroemken\Mysqlreport\Controller;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
use StefanFroemken\Mysqlreport\Domain\Repository\DatabaseRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * @package mysqlreport
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class QueryController extends ActionController
{
    /**
     * @var DatabaseRepository
     */
    protected $databaseRepository;

    /**
     * inject databaseRepository
     *
     * @param DatabaseRepository $databaseRepository
     * @return void
     */
    public function injectDatabaseRepository(DatabaseRepository $databaseRepository)
    {
        $this->databaseRepository = $databaseRepository;
    }

    /**
     * filesort action
     *
     * @return void
     */
    public function filesortAction()
    {
        $this->view->assign('queries', $this->databaseRepository->findQueriesWithFilesort());
    }

    /**
     * using full table scan action
     *
     * @return void
     */
    public function fullTableScanAction()
    {
        $this->view->assign('queries', $this->databaseRepository->findQueriesWithFullTableScan());
    }

}