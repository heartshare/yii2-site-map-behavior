<?php
/**
 * @author Chekal Dmirty <hanterrian@gmail.com>
 */

namespace sitemap\components\urlRules;

use yii\web\UrlRule;

/**
 * Class SiteMapXmlUrlRule
 * @package siteMap\components
 */
class SiteMapXmlUrlRule extends UrlRule
{
	public $name = 'site_map_xml';
	public $pattern = '/sitemap';
	public $route = 'sitemap/generator/xml';
	public $suffix = '.xml';
}
