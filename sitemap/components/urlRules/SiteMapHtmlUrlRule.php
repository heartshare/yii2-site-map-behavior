<?php
/**
 * @author Chekal Dmirty <hanterrian@gmail.com>
 */

namespace sitemap\components\urlRules;

use yii\web\UrlRule;

/**
 * Class SiteMapHtmlUrlRule
 * @package siteMap\components
 */
class SiteMapHtmlUrlRule extends UrlRule
{
	public $name = 'site_map_html';
	public $pattern = '/sitemap';
	public $route = 'sitemap/generator/html';
	public $suffix = '.html';
}
