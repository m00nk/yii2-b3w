<?php
/**
 * @copyright (C) FIT-Media.com (fit-media.com), {@link http://tanitacms.net}
 * Date: 27.02.15, Time: 18:48
 *
 * @author Dmitrij "m00nk" Sheremetjev <m00nk1975@gmail.com>
 * @package
 */

namespace m00nk\b3w;

use yii\bootstrap\Dropdown;
use yii\helpers\Html;
use yii\base\Widget;

class ButtonGroup extends Widget
{
	/** @var array массив ссылок. Формат: ['label' => '...', 'url' => '', 'linkOptions' => [...], 'items' => [...] ] */
	public $items = [];

	/** @var string тип кнопок. Варианты: 'default', 'primary', 'success', 'info', 'warning', 'danger' */
	public $type = 'default';

	/** @var string размер кнопок. Варианты: 'xs', 'sm', '', 'lg'. Если используются выпадающие меню, то не стоит менять эту опцию  */
	public $size = ''; // 'xs', 'sm', '', 'lg'

	/** @var array HTML-опции для DIV-контейнера группы */
	public $containerOptions = [];


	public function run()
	{
		$view = $this->getView();
		B3wAsset::register($view);

		if(!is_array($this->items) || count($this->items) == 0) return '';

		//-----------------------------------------
		$this->size = strtolower($this->size);
		$_sizeClass = in_array($this->size, ['xs', 'sm', 'lg']) ? ('btn-group-'.$this->size) : '';
		$_sizeBtnClass = in_array($this->size, ['xs', 'sm', 'lg']) ? ('btn-'.$this->size) : '';

		$this->type = strtolower($this->type);
		$_typeClass = in_array($this->type, ['default', 'success', 'danger', 'warning', 'info', 'primary']) ? ('btn-'.$this->type) : 'btn-default';

		$out = '';

		foreach($this->items as $item)
		{
			if(isset($item['items']) && is_array($item['items']))
			{
				$out .= Html::tag('div',
					Html::a(
						$item['label'].' <span class="caret"></span>', '#',
						['class' => 'btn '.$_typeClass.' dropdown-toggle '.$_sizeBtnClass, 'data-toggle'=>'dropdown']
					).
					Dropdown::widget(['items' => $item['items']]),
					['class' => 'btn-group', 'role' => 'group']);
			}
			else
			{
				$item['linkOptions']['class'] = (isset($item['linkOptions']['class']) ? $item['linkOptions']['class'] : '').' btn '.$_typeClass;
				$out .= Html::a($item['label'], $item['url'], $item['linkOptions']);
			}
		}

		$this->containerOptions['class'] .= ' btn-group '.$_sizeClass;
		$this->containerOptions['role'] = 'group';

		return !empty($out) ? (Html::tag('div', $out, $this->containerOptions).Html::tag('div', '', ['class' => 'clearfix'])) : '';
	}
}
