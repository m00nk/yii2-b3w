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
use \Yii;


class Alert extends Widget
{
	public function run()
	{
		$html = '';

		$s = Yii::$app->session;
		$_ = $s->getFlash('success');
		if($_) $html .= $this->_drawBox($_, 'success');
		$_ = $s->getFlash('danger');
		if($_) $html .= $this->_drawBox($_, 'danger');
		$_ = $s->getFlash('info');
		if($_) $html .= $this->_drawBox($_, 'info');
		$_ = $s->getFlash('warning');
		if($_) $html .= $this->_drawBox($_, 'warning');

		return $html;
	}

	private function _drawBox($text, $type = 'default')
	{
		return Html::tag('div',
			'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$text,
			['class' => 'alert alert-dismissible alert-'.$type]);
	}
}