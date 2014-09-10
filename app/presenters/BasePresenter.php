<?php

//namespace App\Presenters;
/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

	protected $fileModel;
	protected $userModel;
	protected $versionModel;
	protected $articleModel;
	protected $commentsModel;

	public function injectBase(Models\File $file, Models\Article $article, Models\Version $version, Models\User $user, Models\Comments $comments)
	{
		$this->fileModel = $file;
		$this->userModel = $user;
		$this->articleModel = $article;
		$this->versionModel = $version;
		$this->commentsModel = $comments;
	}
}