<?php

namespace yii2bundle\qiwi\web\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class Thumb extends Widget
{

    public $url;
    public $logoUrl;
	public $title;

	public function run() {
		?>
        <a class="thumbnail" style="height: 170px;" href="<?= $this->url ?>">
			<?= Html::img($this->logoUrl, ['width' => '96']) ?>
            <div class="caption text-center">
				<?= $this->title ?>
            </div>
        </a>
		<?php
	}

}
