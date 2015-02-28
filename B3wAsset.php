<?php
/**
 * @copyright (C) FIT-Media.com (fit-media.com), {@link http://tanitacms.net}
 * Date: 22.02.15, Time: 14:34
 *
 * @author Dmitrij "m00nk" Sheremetjev <m00nk1975@gmail.com>
 * @package
 */

namespace m00nk\b3w;
use yii\web\AssetBundle;

class B3wAsset extends AssetBundle
{
	public $css = [
		'b3w.css',
	];

	public $depends = [
		'yii\bootstrap\BootstrapAsset',
	];

	public $publishOptions = [
		'forceCopy' => YII_ENV_DEV
	];

	public function init()
	{
		$this->sourcePath = __DIR__.'/assets';
		parent::init();
	}

}