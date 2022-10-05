<?php

declare(strict_types=1);

namespace App\Model;

use Nette;

final class PostFacade
{
	use Nette\SmartObject;

	private Nette\Database\Explorer $database;

	public function __construct(Nette\Database\Explorer $database)
	{
		$this->database = $database;
	}

	public function getPublicArticles()
	{
		return $this->database
			->table('posts')
			->where('created_at < ', new \DateTime)
			->order('created_at DESC');
	}

	public function getArticle($postId)
	{
		return $this->database
			->table('posts')
			->get($postId);
	}

	public function createArticle($article)
	{
		$this->database
		->table('posts')
		->insert($article);
	}

}

