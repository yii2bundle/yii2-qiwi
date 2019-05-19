<?php

namespace yii2bundle\qiwi\domain;

use yii2rails\domain\enums\Driver;

/**
 * Class Domain
 * 
 * @property-read \yii2bundle\qiwi\domain\interfaces\services\HistoryInterface $history
 * @property-read \yii2bundle\qiwi\domain\interfaces\repositories\RepositoriesInterface $repositories
 * @property-read \yii2bundle\qiwi\domain\interfaces\services\ProviderInterface $provider
 * @property-read \yii2bundle\qiwi\domain\interfaces\services\CategoryInterface $category
 * @property-read \yii2bundle\qiwi\domain\interfaces\services\PersonInterface $person
 */
class Domain extends \yii2rails\domain\Domain {
	
	public function config() {
		return [
			'repositories' => [
                'history' => Driver::ACTIVE_RECORD,
				'provider' => Driver::ACTIVE_RECORD,
				'category' => Driver::ACTIVE_RECORD,
				'person' => Driver::ACTIVE_RECORD,
			],
			'services' => [
                'history',
				'provider',
				'category',
				'person',
			],
		];
	}
	
}
