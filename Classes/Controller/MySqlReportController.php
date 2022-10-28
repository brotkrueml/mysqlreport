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
use TYPO3\CMS\Core\Http\HtmlResponse;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Controller to show a basic analysis of MySQL variables and status
 */
class MySqlReportController extends AbstractController
{
    public function overviewAction(): ResponseInterface
    {
        $statusRepository = GeneralUtility::makeInstance(StatusRepository::class);
        $this->view->assign('status', $statusRepository->findAll());

        return new HtmlResponse($this->view->render());
    }

    public function informationAction(): ResponseInterface
    {
        $page = $this->pageFinder->getPageByIdentifier('information');
        if ($page instanceof Page) {
            $this->view->assign('renderedInfoBoxes', $page->getRenderedInfoBoxes());
        }

        return new HtmlResponse($this->view->render());
    }

    public function innoDbAction(): ResponseInterface
    {
        $page = $this->pageFinder->getPageByIdentifier('innoDb');
        if ($page instanceof Page) {
            $this->view->assign('renderedInfoBoxes', $page->getRenderedInfoBoxes());
        }

        return new HtmlResponse($this->view->render());
    }

    public function threadCacheAction(): ResponseInterface
    {
        $page = $this->pageFinder->getPageByIdentifier('threadCache');
        if ($page instanceof Page) {
            $this->view->assign('renderedInfoBoxes', $page->getRenderedInfoBoxes());
        }

        return new HtmlResponse($this->view->render());
    }

    public function tableCacheAction(): ResponseInterface
    {
        $page = $this->pageFinder->getPageByIdentifier('tableCache');
        if ($page instanceof Page) {
            $this->view->assign('renderedInfoBoxes', $page->getRenderedInfoBoxes());
        }

        return new HtmlResponse($this->view->render());
    }

    public function queryCacheAction(): ResponseInterface
    {
        $page = $this->pageFinder->getPageByIdentifier('queryCache');
        if ($page instanceof Page) {
            $this->view->assign('renderedInfoBoxes', $page->getRenderedInfoBoxes());
        }

        return new HtmlResponse($this->view->render());
    }

    public function miscAction(): ResponseInterface
    {
        $page = $this->pageFinder->getPageByIdentifier('misc');
        if ($page instanceof Page) {
            $this->view->assign('renderedInfoBoxes', $page->getRenderedInfoBoxes());
        }

        return new HtmlResponse($this->view->render());
    }
}
