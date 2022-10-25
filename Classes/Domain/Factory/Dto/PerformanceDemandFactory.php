<?php
namespace DWenzel\T3events\Domain\Factory\Dto;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use DWenzel\T3events\Domain\Model\Dto\DemandInterface;
use DWenzel\T3events\Domain\Model\Dto\PerformanceDemand;
use DWenzel\T3events\Domain\Model\Dto\PeriodAwareDemandInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class PerformanceDemandFactory
 * Creates PerformanceDemand objects
 *
 * @package DWenzel\T3events\Domain\Factory\Dto
 */
class PerformanceDemandFactory extends AbstractDemandFactory implements DemandFactoryInterface
{
    use PeriodAwareDemandFactoryTrait;
    /**
     * Class name of the object created by this factory.
     */
    const DEMAND_CLASS = PerformanceDemand::class;

    /**
     * Properties which should be mapped when settings
     * are applied to demand object
     *
     * @var array
     */
    protected static $mappedProperties = [
        'maxItems' => 'limit'
    ];

    /**
     * Composite properties which can not set directly
     * but have to be composed from various settings or
     * require any special logic before setting
     *
     * @var array
     */
    protected static $compositeProperties = [
        'search'
    ];

    /**
     * Creates a demand object from settings
     *
     * @param array $settings
     * @return DemandInterface
     */
    public function createFromSettings(array $settings)
    {
        /** @var PerformanceDemand $demand */
        $demand = GeneralUtility::makeInstance(static::DEMAND_CLASS);

        if (isset($settings['sortBy'])) {
            if ($settings['sortBy'] === 'headline') {
                $settings['sortBy'] = 'event.headline';
            }
            if ($settings['sortBy'] === 'performances.date') {
                $settings['sortBy'] = 'date';
            }
        }
        if (!empty($settings['order'])
            && $settings['order'] === 'performances.date|asc,performances.begin|asc'
        ) {
            $settings['order'] = 'date|asc,begin|asc';
        }
        if (!empty($settings['order'])
            && $settings['order'] === 'performances.date|desc,performances.begin|desc'
        ) {
            $settings['order'] = 'date|desc,begin|desc';
        }
        if ($demand instanceof PeriodAwareDemandInterface) {
            $this->setPeriodConstraints($demand, $settings);
        }
        $this->applySettings($demand, $settings);

        return $demand;
    }
}
