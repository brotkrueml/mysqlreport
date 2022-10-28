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
use StefanFroemken\Mysqlreport\Domain\Repository\ProfileRepository;

/**
 * Controller to show and analyze all queries of a request
 */
class ProfileController extends AbstractController
{
    /**
     * @var ProfileRepository
     */
    protected ProfileRepository $profileRepository;

    public function injectProfileRepository(ProfileRepository $profileRepository): void
    {
        $this->profileRepository = $profileRepository;
    }

    public function listAction(): ResponseInterface
    {
        $moduleTemplate = $this->getView();
        $moduleTemplate->assign('profileRecords', $this->profileRepository->findProfileRecordsForCall());

        return $moduleTemplate->renderResponse('List');
    }

    public function showAction(string $uniqueIdentifier): ResponseInterface
    {
        $moduleTemplate = $this->getView();
        $moduleTemplate->assign('profileTypes', $this->profileRepository->getProfileRecordsByUniqueIdentifier($uniqueIdentifier));

        return $moduleTemplate->renderResponse('Show');
    }

    public function queryTypeAction(string $uniqueIdentifier, string $queryType): ResponseInterface
    {
        $moduleTemplate = $this->getView();
        $moduleTemplate->assign('uniqueIdentifier', $uniqueIdentifier);
        $moduleTemplate->assign('queryType', $queryType);
        $moduleTemplate->assign('profileRecords', $this->profileRepository->getProfileRecordsByQueryType($uniqueIdentifier, $queryType));

        return $moduleTemplate->renderResponse('QueryType');
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
