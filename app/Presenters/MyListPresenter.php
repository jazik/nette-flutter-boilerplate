<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use Contributte\ApiRouter\ApiRoute;
use App\Model\PostFacade;

final class MyListPresenter extends Nette\Application\UI\Presenter
{
	private PostFacade $facade;

	public function __construct(PostFacade $facade)
	{
		$this->facade = $facade;
	}

	public function actionRead($id = NULL)
	{
		if ($id) {
		    $post = $this->facade
			    ->getArticle($id);
		    $results = [
			'id' => $post->id,
			'title' => $post->title,
			'content' => $post->content,
		    ];
		} else {
		    $posts = $this->facade
			    ->getPublicArticles()
			    ->limit(5);
		    $results = [];
		    foreach($posts as $post) {
			$results[] = [
			    'id' => $post->id,
			    'title' => $post->title,
			    'content' => $post->content,
			];
		    }
		}
		$this->sendJson($results);
	}
}

