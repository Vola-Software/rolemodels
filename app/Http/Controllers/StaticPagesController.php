<?php

namespace App\Http\Controllers;

use App\Services\PrismicService;

class StaticPagesController extends Controller
{
	public function forTeachers()
	{
		return self::standard(['for-teachers']);
	}

	public function forRoleModels()
	{
		return self::standard(['for-role-models']);
	}

	public function forCompanies()
	{
		return self::standard(['for-companies']);
	}

	public function forSchools()
	{
		return self::standard(['for-schools']);
	}

	public function aboutUs()
	{
		return self::standard(['about-us']);
	}

	public function storyOfNikoletaHPE()
	{
		return self::standard(['story-of-nikoleta-hpe']);
	}

    private function standard($tags)
	{
		$pageContent = PrismicService::fetchPrismicContentByTags($tags);

		return view('static_pages.standard', [
			'pageContent' => $pageContent
		]);
	}

	
}
