<?php
/**
 * @copyright (C) FIT-Media.com {@link http://fit-media.com}
 * Date: 09.09.15, Time: 23:52
 *
 * @author        Dmitrij "m00nk" Sheremetjev <m00nk1975@gmail.com>
 * @package
 */

namespace m00nk\b3w;

use yii\helpers\Html;
use yii\base\Widget;
use yii\widgets\InputWidget;

/**
 * Class CheckBoxList
 * @package m00nk\b3w
 */
class CheckBoxList extends InputWidget
{
	/** @var array ассоциативный массив значений */
	public $items = [];

	/** @var string Имя для чекбоксов (типа 'Categories[]') */
	public $name = '';

	public function run()
	{
		$list = [];

		$selectedValue = $this->model->{$this->attribute};

		$_index = 0;
		foreach ($this->items as $k => $v)
		{
			$list[] = Html::tag('li',
				Html::checkbox($this->name, $k == $selectedValue, ['id' => $this->id.'_'.$_index, 'hidden' => 'hidden']).
				Html::label($v, $this->id.'_'.$_index)
			);

			$_index++;
		}

		$this->options['class'] .= ' m00nk_b3w_checkboxlist';

		echo Html::tag('ul', implode('', $list), $this->options);
	}
}