<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Contributte\ApiRouter\ApiRoute;
use App\Model\PostFacade;
use Nette\Utils\Json;

final class CreateApiPresenter extends Nette\Application\UI\Presenter
{
	private PostFacade $facade;

	public function __construct(PostFacade $facade)
	{
		$this->facade = $facade;
	}

	public function actionCreate()
	{
		if (!$this->getUser()->isLoggedIn()) {
		    $this->sendJson('Not logged in');
		}
		$httpRequest = $this->getHttpRequest();
		$postData = $httpRequest->getRawBody();
		$data = Json::decode($postData);
		if (!isset($data->title)) {
		    $this->sendJson('Missing title');
		} else if (!isset($data->content)) {
		    $this->sendJson('Missing content');
		} else {
		    $dataArray = Json::decode($postData, Json::FORCE_ARRAY);
		    $this->facade->createArticle($dataArray);
		    $this->sendJson('OK');
		}
	}
}
