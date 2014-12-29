<?php

namespace sitemap\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%seo}}".
 *
 * @property integer $id
 * @property string $model_name
 * @property integer $model_id
 * @property integer $lang_id
 * @property string $label
 * @property string $route
 * @property string $params
 * @property integer $changefreq
 * @property string $priority
 * @property integer $created
 * @property integer $updated
 *
 */
class SiteMap extends ActiveRecord
{
	const CHANGEFREQ_ALWAYS = 1;
	const CHANGEFREQ_HOURLY = 2;
	const CHANGEFREQ_DAILY = 3;
	const CHANGEFREQ_WEEKLY = 4;
	const CHANGEFREQ_MONTHLY = 5;
	const CHANGEFREQ_YEARLY = 6;
	const CHANGEFREQ_NEVER = 7;

	public static function getChangeFreq()
	{
		return [
			self::CHANGEFREQ_ALWAYS => 'always',
			self::CHANGEFREQ_HOURLY => 'hourly',
			self::CHANGEFREQ_DAILY => 'daily',
			self::CHANGEFREQ_WEEKLY => 'weekly',
			self::CHANGEFREQ_MONTHLY => 'monthly',
			self::CHANGEFREQ_YEARLY => 'yearly',
			self::CHANGEFREQ_NEVER => 'never',
		];
	}

	public function getChange()
	{
		return ArrayHelper::getValue(self::getChangeFreq(), $this->changefreq, null);
	}

	public function getUrl()
	{
		return ArrayHelper::merge($this->route, je($this->params));
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%site_map}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['model_name', 'model_id'], 'required'],
			[['model_id', 'changefreq', 'created', 'updated'], 'integer'],
			[['label', 'route', 'params'], 'string'],
			[['lang_id', 'model_name', 'priority'], 'string', 'max' => 255]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => t('ID'),
			'label' => t('Label'),
			'route' => t('Route'),
			'params' => t('Params'),
			'changefreq' => t('Change Freq'),
			'priority' => t('Priority'),
		];
	}
}
