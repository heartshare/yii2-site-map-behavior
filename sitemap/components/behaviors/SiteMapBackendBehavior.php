<?php
/**
 * @author Chekal Dmirty <hanterrian@gmail.com>
 */

namespace sitemap\components\behaviors;

use sitemap\models\SiteMap;
use yii\base\Behavior;
use yii\db\ActiveRecord;

/**
 * Class SiteMapBackendBehavior
 * @package siteMap\components
 */
class SiteMapBackendBehavior extends Behavior
{
	public $attribute = '';
	public $route;
	public $params;
	public $freq = SiteMap::CHANGEFREQ_ALWAYS;
	public $priority = 0.5;

	public $multiLanguage = false;
	public $languages = [];
	public $defaultLanguage = '';
	public $languageVar = '';

	public function events()
	{
		return [
			ActiveRecord::EVENT_AFTER_INSERT => 'addItem',
			ActiveRecord::EVENT_AFTER_UPDATE => 'editItem',
			ActiveRecord::EVENT_AFTER_DELETE => 'deleteItem',
		];
	}

	public function addItem()
	{
		/** @var ActiveRecord $owner */
		$owner = $this->owner;

		if ($this->multiLanguage) {
			$map = new SiteMap();

			$map->model_name = $owner::className();
			$map->model_id = $owner->getPrimaryKey();
			$map->lang_id = 0;

			if ($owner->hasAttribute($this->attribute)) {
				$map->label = $owner->getAttribute($this->attribute);
			}

			$map->route = $this->route;
			$map->params = jd($this->params);
			$map->changefreq = $this->freq;
			$map->priority = $this->priority;

			$map->created = $map->updated = time();

			$map->save();
		} else {
			foreach ($this->languages as $language) {
				$map = new SiteMap();

				$map->model_name = $owner::className();
				$map->model_id = $owner->getPrimaryKey();
				$map->lang_id = $language;

				if ($owner->hasAttribute($this->attribute . '_' . $language)) {
					$map->label = $owner->getAttribute($this->attribute . '_' . $language);
				}

				$map->route = $this->route;

				if ($language == $this->defaultLanguage) {
					$map->params = jd($this->params);
				} else {
					$map->params = jd([$this->languageVar => $language], $this->params);
				}

				$map->changefreq = $this->freq;
				$map->priority = $this->priority;

				$map->created = $map->updated = time();

				$map->save();
			}
		}
	}

	public function editItem()
	{
		/** @var ActiveRecord $owner */
		$owner = $this->owner;

		if ($this->multiLanguage) {
			$map = SiteMap::findOne(['model_name' => $owner, 'model_id' => $owner->getPrimaryKey(), 'lang_id' => 0]);

			if (!$map) {
				$map = new SiteMap();
				$map->model_name = $owner::className();
				$map->model_id = $owner->getPrimaryKey();
				$map->lang_id = 0;
			}

			if ($owner->hasAttribute($this->attribute)) {
				$map->label = $owner->getAttribute($this->attribute);
			}

			$map->route = $this->route;
			$map->params = jd($this->params);
			$map->changefreq = $this->freq;
			$map->priority = $this->priority;

			$map->updated = time();

			$map->save();
		} else {
			foreach ($this->languages as $language) {
				$map = SiteMap::findOne([
					'model_name' => $owner,
					'model_id' => $owner->getPrimaryKey(),
					'lang_id' => $language
				]);

				if (!$map) {
					$map = new SiteMap();
					$map->model_name = $owner::className();
					$map->model_id = $owner->getPrimaryKey();
					$map->lang_id = $language;
				}

				if ($owner->hasAttribute($this->attribute . '_' . $language)) {
					$map->label = $owner->getAttribute($this->attribute . '_' . $language);
				}

				$map->route = $this->route;

				if ($language == $this->defaultLanguage) {
					$map->params = jd($this->params);
				} else {
					$map->params = jd([$this->languageVar => $language], $this->params);
				}

				$map->changefreq = $this->freq;
				$map->priority = $this->priority;

				$map->updated = time();

				$map->save();
			}
		}
	}

	public function deleteItem()
	{
		/** @var ActiveRecord $owner */
		$owner = $this->owner;

		SiteMap::deleteAll(['model_name' => $owner, 'model_id' => $owner->getPrimaryKey(),]);
	}
}
