<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;
use Nette\Application\Routers\Route;
use Contributte\ApiRouter\ApiRoute;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;

		/**
		 * Simple route with matching (only if methods below exist):
		 * 	GET     => UsersPresenter::actionRead()
		 * 	POST    => UsersPresenter::actionCreate()
		 * 	PUT     => UsersPresenter::actionUpdate()
		 * 	DELETE  => UsersPresenter::actionDelete()
		 */
		$router[] = new ApiRoute('/api/list[/<id>]', 'MyList', [
			'parameters' => [
				'id' => ['requirement' => '\d+']
			],
			'priority' => 1
		]);

		$router[] = new ApiRoute('/api/create', 'CreateApi');

		$router[] = new ApiRoute('/api/login', 'LoginApi');

		$router[] = new Route('<presenter>/<action>[/<id>/]', 'Homepage:default');

		return $router;
	}
}
