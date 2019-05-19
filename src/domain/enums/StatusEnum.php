<?php

namespace yii2bundle\qiwi\domain\enums;

use yii2rails\extension\enum\base\BaseEnum;

class StatusEnum extends BaseEnum {
	
	const WAITING = 'WAITING'; // платеж проводится
	const SUCCESS = 'SUCCESS'; // успешный платеж
	const ERROR = 'ERROR'; // ошибка платежа
	
}
