<?php

namespace DWenzel\T3events\Tests\Unit\Utility;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Dirk Wenzel <dirk.wenzel@cps-it.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use DWenzel\T3events\Utility\TableConfiguration;
use Nimut\TestingFramework\TestCase\UnitTestCase;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;

class TableConfigurationTest extends UnitTestCase
{
    /**
     * @var TableConfiguration
     */
    protected $subject;

    public function setUp()
    {
        $this->subject = new TableConfiguration();
    }

    /**
     * @return  array
     */
    public function wizardIconDataProvider()
    {
        $iconStrings = [
            8 => [
                ['add', 'actions-add'],
                ['edit', 'actions-add'],
                ['link', 'actions-wizard-link'],
                ['rte', 'actions-open'],
            ],
            7 => [
                ['add', 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_add.gif'],
                ['edit', 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_edit.gif'],
                ['link', 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_link.gif'],
                ['rte', 'EXT:backend/Resources/Public/Images/FormFieldWizard/wizard_rte.gif']
            ],
            6 => [
                ['add', 'add.gif'],
                ['edit', 'edit2.gif'],
                ['link', 'link.gif'],
                ['rte', 'wizard_rte2.gif']
            ]
        ];

        /* expected icon strings by version */
        $version = 8;
        $versionNumber = VersionNumberUtility::getNumericTypo3Version();
        if ($versionNumber >= 6000000 && $versionNumber < 7000000) {
            $version = 6;
        }
        if ($versionNumber >= 7000000 && $versionNumber < 8000000) {
            $version = 7;
        }

        return $iconStrings[$version];
    }

    /**
     * @test
     * @dataProvider wizardIconDataProvider
     * @param string $wizardName
     * @param string $expectedValue
     */
    public function getWizardIconReturnsCorrectValue($wizardName, $expectedValue)
    {
        $this->assertSame(
            $expectedValue,
            TableConfiguration::getWizardIcon($wizardName)
        );

    }
}
