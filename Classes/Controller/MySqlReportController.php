<?php

declare(strict_types=1);

/*
 * This file is part of the package stefanfroemken/mysqlreport.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace StefanFroemken\Mysqlreport\Controller;

use Psr\Http\Message\ResponseInterface;
use StefanFroemken\Mysqlreport\Domain\Repository\StatusRepository;
use StefanFroemken\Mysqlreport\Menu\Page;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Controller to show a basic analysis of MySQL variables and status
 */
class MySqlReportController extends AbstractController
{
    public function overviewAction(): ResponseInterface
    {
        $statusRepository = GeneralUtility::makeInstance(StatusRepository::class);

        $moduleTemplate = $this->getView();
        $moduleTemplate->assign('status', $statusRepository->findAll());

        return $moduleTemplate->renderResponse('Overview');
    }

    public function informationAction(): ResponseInterface
    {
        $moduleTemplate = $this->getView();

        $page = $this->pageFinder->getPageByIdentifier('information');
        if ($page instanceof Page) {
            $moduleTemplate->assign('renderedInfoBoxes', $page->getRenderedInfoBoxes());
        }

        return $moduleTemplate->renderResponse('Information');
    }

    public function innoDbAction(): ResponseInterface
    {
        $moduleTemplate = $this->getView();

        $page = $this->pageFinder->getPageByIdentifier('innoDb');
        if ($page instanceof Page) {
            $moduleTemplate->assign('renderedInfoBoxes', $page->getRenderedInfoBoxes());
        }

        return $moduleTemplate->renderResponse('InnoDb');
    }

    public function threadCacheAction(): ResponseInterface
    {
        $moduleTemplate = $this->getView();

        $page = $this->pageFinder->getPageByIdentifier('threadCache');
        if ($page instanceof Page) {
            $moduleTemplate->assign('renderedInfoBoxes', $page->getRenderedInfoBoxes());
        }

        return $moduleTemplate->renderResponse('ThreadCache');
    }

    public function tableCacheAction(): ResponseInterface
    {
        $moduleTemplate = $this->getView();

        $page = $this->pageFinder->getPageByIdentifier('tableCache');
        if ($page instanceof Page) {
            $moduleTemplate->assign('renderedInfoBoxes', $page->getRenderedInfoBoxes());
        }

        return $moduleTemplate->renderResponse('TableCache');
    }

    public function queryCacheAction(): ResponseInterface
    {
        $moduleTemplate = $this->getView();

        $page = $this->pageFinder->getPageByIdentifier('queryCache');
        if ($page instanceof Page) {
            $moduleTemplate->assign('renderedInfoBoxes', $page->getRenderedInfoBoxes());
        }

        return $moduleTemplate->renderResponse('QueryCache');
    }

    public function miscAction(): ResponseInterface
    {
        $moduleTemplate = $this->getView();

        $page = $this->pageFinder->getPageByIdentifier('misc');
        if ($page instanceof Page) {
            $moduleTemplate->assign('renderedInfoBoxes', $page->getRenderedInfoBoxes());
        }

        return $moduleTemplate->renderResponse('Misc');
    }
}
