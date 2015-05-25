<?php
/**
 * @copyright (C) FIT-Media.com (fit-media.com), {@link http://tanitacms.net}
 * Date: 27.02.15, Time: 18:48
 *
 * @author Dmitrij "m00nk" Sheremetjev <m00nk1975@gmail.com>
 * @package
 */

namespace m00nk\b3w;

use yii\helpers\Html;
use yii\base\Widget;

class Panel extends Widget
{
	/** @var bool|string Заголовок панели или FALSE если не нужен */
	public $title = false;

	/** @var string Содержимое панели */
	public $content = '';

	/** @var bool|string Подвал панели или FALSE если не нужен */
	public $footer = false;

	/** @var bool|string Таблица в панели или FALSE если нет */
	public $table = false;

	/** @var string тип панели. Варианты: 'default', 'primary', 'success', 'info', 'warning', 'danger' */
	public $type = 'default';

	/** @var array группа кнопок в заголовке панели. Формат: массив параметров для виджета \m00nk\b3w\ButtonGroup  */
	public $headerButtons = false;

	/** @var array группа кнопок в подвале панели. Формат: массив параметров для виджета \m00nk\b3w\ButtonGroup */
	public $footerButtons = false;

	public function run()
	{
		$view = $this->getView();
		B3wAsset::register($view);

		if(empty($this->content)) return '';

		$_hb = $this->headerButtons !== false ? ButtonGroup::widget($this->headerButtons) : '';
		$_fb = $this->footerButtons !== false ? ButtonGroup::widget($this->footerButtons) : '';

		$header = $this->title!==false ? Html::tag('div', $this->title.$_hb , ['class' => 'panel-heading']) : '';
		$footer = $this->footer!==false ? Html::tag('div', $this->footer.$_fb, ['class' => 'panel-footer']) : '';
		$this->content = Html::tag('div', $this->content, ['class' => 'panel-body']);
		$table = $this->table!==false ? $this->table : '';

		return Html::tag('div', $header.$this->content.$table.$footer, ['class' => 'panel panel-'.$this->type, 'id' => $this->id]);
	}
}
