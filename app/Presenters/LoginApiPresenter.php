<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Contributte\ApiRouter\ApiRoute;
use App\Model\PostFacade;
use Nette\Utils\Json;

final class LoginApiPresenter extends Nette\Application\UI\Presenter
{
	private PostFacade $facade;

	public function __construct(PostFacade $facade)
	{
		$this->facade = $facade;
	}

	public function actionCreate()
	{
		$httpRequest = $this->getHttpRequest();
		$postData = $httpRequest->getRawBody();
		$data = Json::decode($postData);
		if (!isset($data->username)) {
		    $this->sendJson('Missing username');
		} else if (!isset($data->password)) {
		    $this->sendJson('Missing password');
		} else {
		    try {
			    $this->getUser()->login($data->username, $data->password);
			    $this->sendJson('OK');

		    } catch (Nette\Security\AuthenticationException $e) {
			    $this->sendJson('Nesprávné přihlašovací jméno nebo heslo.');
		    }
		}
	}

	public function actionRead()
	{
	    $this->getUser()->logout();
	    $this->sendJson('Logged out');
	}
}
