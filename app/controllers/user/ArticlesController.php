<?php namespace App\Controllers\User;

use App\Models\Article;
use Input, Notification, Redirect, Sentry, Str, Validator;

class ArticlesController extends \BaseController {

	public function index()
	{
		return \View::make('user.articles.index')->with('articles', Article::orderBy('created_at', 'desc')->get());
	}

	public function show($id)
	{
		return \View::make('user.articles.show')->with('article', Article::find($id));
	}

	public function create()
	{
		return \View::make('user.articles.create');
	}

	public function store()
	{
		$data = Input::all();
		$rules = array(
			'title' => 'required',
			'body' => 'required',
			);
		$messages = array(
			'title.required' => 'Tytuł jest niezbędny.',
			'body.required' => 'Treść jest konieczna.'
			);

		$validator = Validator::make($data, $rules, $messages);

		if ($validator->passes())
		{
			$article = new Article;
			$article->title   = Input::get('title');
			$article->slug    = Str::slug(Input::get('title'));
			$article->body    = Input::get('body');
			$article->user_id = Sentry::getUser()->id;
			$article->save();

			Notification::success('Artykuł został utworzony.');

			return Redirect::route('użytkownik.teksty.index');
		}

		return Redirect::back()->withInput()->withErrors($validator);
	}

	public function edit($id)
	{
		return \View::make('user.articles.edit')->with('article', Article::find($id));
	}

	public function update($id)
	{
		$data = Input::all();
		$rules = array(
			'title' => 'required',
			'body' => 'required',
			);
		$messages = array(
			'title.required' => 'Tytuł jest niezbędny.',
			'body.required' => 'Treść jest konieczna.'
			);

		$validator = Validator::make($data, $rules, $messages);

		if ($validator->passes())
		{
			$article = Article::find($id);
			$article->title   = Input::get('title');
			$article->slug    = Str::slug(Input::get('title'));
			$article->body    = Input::get('body');
			$article->user_id = Sentry::getUser()->id;
			$article->save();

			return Redirect::route('użytkownik.teksty.index');
		}

		return Redirect::back()->withInput()->withErrors($validator);
	}

	public function destroy($id)
	{
		$article = Article::find($id);
		$article->delete();

		Notification::success('Artykuł został usunięty.');

		return Redirect::route('użytkownik.teksty.index');
	}

}

