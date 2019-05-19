<?php

namespace yii2bundle\qiwi\domain\enums;

use yii2rails\extension\enum\base\BaseEnum;

class OperationEnum extends BaseEnum {
	
	const ALL = 'ALL'; // все
	const IN = 'IN'; // пополнение
	const OUT = 'OUT'; // платеж
	const QIWI_CARD = 'QIWI_CARD'; // платеж с карт QIWI (QVC, QVP)

}
