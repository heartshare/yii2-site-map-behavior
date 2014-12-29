<?php
/**
 * @author Chekal Dmirty <hanterrian@gmail.com>
 */

namespace sitemap\controllers;

use sitemap\models\SiteMap;
use yii\helpers\Url;
use yii\web\Controller;

/**
 * Class GeneratorController
 * @package siteMap\controllers
 */
class GeneratorController extends Controller
{
	public function actionXml()
	{
		/** @var SiteMap[] $models */
		$models = SiteMap::find()->all();

		echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
		echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

		foreach ($models as $model) {
			echo "\t<url>\n";
			echo "\t\t<loc>" . Url::toRoute($model->getUrl(), true) . "</loc>\n";
			echo "\t\t<lastmod>" . date('Y-m-d', $model->updated) . "</lastmod>\n";
			echo "\t\t<changefreq>" . $model->getChange() . "</changefreq>\n";
			echo "\t\t<priority>" . $model->priority . "</priority>\n";
			echo "\t</url>\n";
		}

		echo '</urlset>';

		\Yii::$app->end();
	}

	public function actionHtml()
	{
		/** @var SiteMap[] $models */
		$models = SiteMap::find()->all();

		return $this->render('html', ['models' => $models]);
	}
}
