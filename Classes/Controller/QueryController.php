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
use StefanFroemken\Mysqlreport\Configuration\ExtConf;
use StefanFroemken\Mysqlreport\Domain\Repository\ProfileRepository;

/**
 * Controller to show results of FTS and filesort
 */
class QueryController extends AbstractController
{
    protected ProfileRepository $profileRepository;

    protected ExtConf $extConf;

    public function injectProfileRepository(ProfileRepository $profileRepository): void
    {
        $this->profileRepository = $profileRepository;
    }

    public function injectExtConf(ExtConf $extConf): void
    {
        $this->extConf = $extConf;
    }

    public function filesortAction(): ResponseInterface
    {
        $moduleTemplate = $this->getView();
        $moduleTemplate->assign('profileRecords', $this->profileRepository->findProfileRecordsWithFilesort());

        return $moduleTemplate->renderResponse('Filesort');
    }

    public function fullTableScanAction(): ResponseInterface
    {
        $moduleTemplate = $this->getView();
        $moduleTemplate->assign('profileRecords', $this->profileRepository->findProfileRecordsWithFullTableScan());

        return $moduleTemplate->renderResponse('FullTableScan');
    }

    public function slowQueryAction(): ResponseInterface
    {
        $moduleTemplate = $this->getView();
        $moduleTemplate->assign('profileRecords', $this->profileRepository->findProfileRecordsWithSlowQueries());
        $moduleTemplate->assign('slowQueryTime', $this->extConf->getSlowQueryTime());

        return $moduleTemplate->renderResponse('SlowQuery');
    }

    public function profileInfoAction(int $uid): ResponseInterface
    {
        $moduleTemplate = $this->getView();

        $profileRecord = $this->profileRepository->getProfileRecordByUid($uid);
        $profileRecord['profile'] = unserialize($profileRecord['profile'], ['allowed_classes' => false]);
        $profileRecord['explain'] = unserialize($profileRecord['explain_query'], ['allowed_classes' => false]);

        $moduleTemplate->assign('profileRecord', $profileRecord);

        return $moduleTemplate->renderResponse('ProfileInfo');
    }
}
