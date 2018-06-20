<?php

namespace Jikan\Parser;

class AnimeCharacters extends \Skraypar\Skraypar
{
	public $model;

	public function __construct(&$model) {
		$this->model = &$model;
	}

	public function loadRules() {
		$this->addRule('link_canonical', '~<meta property="og:url" content="(.*?)">~', function() {
			$this->model->set('Anime', 'link_canonical', $this->matches[1]);

            preg_match('~myanimelist.net/(.+)/(.*)/~', $this->model->get('Anime', 'link_canonical'), $this->matches);
            $this->model->set('Anime', 'mal_id', (int) $this->matches[2]);
		});
	}
}