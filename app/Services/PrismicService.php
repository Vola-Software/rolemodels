<?php

namespace App\Services;

use Prismic\Api;
use Prismic\LinkResolver;
use Prismic\Predicates;
use Prismic\Dom\RichText;
use App\Services\GeneralLinkResolver;

class PrismicService 
{
	public static function fetchPrismicContentByTags($tagsArr)
	{
		$api = Api::get(config('urls.prismic_api_url'));
        $prismic = $api->query(Predicates::at('document.tags', $tagsArr));

        $linkResolver = new GeneralLinkResolver();

        $pageContent = [
        	'title' => $prismic->results[0]->data->title[0]->text,
        	'content' => RichText::asHtml($prismic->results[0]->data->content, $linkResolver),
        ];

        return $pageContent;
	}
}
