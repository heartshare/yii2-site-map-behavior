<?php
/**
 * @author Chekal Dmirty <hanterrian@gmail.com>
 *
 * @var $models \sitemap\models\SiteMap[]
 */
?>
<ul class="sitemap">
	<?php foreach ($models as $model): ?>
		<li>
			<?= \yii\helpers\Html::a($model->label, $model->getUrl()) ?>
		</li>
	<?php endforeach; ?>
</ul>
