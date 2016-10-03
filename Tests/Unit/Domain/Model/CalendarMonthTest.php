<?php
namespace DWenzel\T3events\Tests\Unit\Domain\Model;

use TYPO3\CMS\Core\Tests\UnitTestCase;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use DWenzel\T3events\Domain\Model\CalendarMonth;
use DWenzel\T3events\Domain\Model\CalendarWeek;
use DWenzel\T3events\Domain\Model\Event;

/***************************************************************
 *  Copyright notice
 *  (c) 2015 Dirk Wenzel <dirk.wenzel@cps-it.de>
 *  All rights reserved
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Class CalendarMonthTest
 *
 * @package DWenzel\T3events\Tests\Unit\Domain\Model
 * @coversDefaultClass \DWenzel\T3events\Domain\Model\CalendarMonth
 */
class CalendarMonthTest extends UnitTestCase {

	/**
	 * @var CalendarMonth
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = $this->getAccessibleMock(
			'DWenzel\\T3events\\Domain\\Model\\CalendarMonth',
			array('dummy'), array(), '', TRUE
		);
	}

	/**
	 * @test
	 * @covers ::getWeeks
	 */
	public function getWeeksReturnsInitiallyEmptyObjectStorage() {
		$emptyObjectStorage = new ObjectStorage();

		$this->assertEquals(
			$emptyObjectStorage,
			$this->fixture->getWeeks()
		);
	}

	/**
	 * @test
	 * @covers ::setWeeks
	 */
	public function setWeeksForObjectStorageSetsWeeks() {
		$emptyObjectStorage = new ObjectStorage();
		$this->fixture->setWeeks($emptyObjectStorage);

		$this->assertSame(
			$emptyObjectStorage,
			$this->fixture->getWeeks()
		);
	}

	/**
	 * @test
	 * @covers ::addWeek
	 */
	public function addWeekForObjectAddsEvent() {
		$week = new CalendarWeek();
		$this->fixture->addWeek($week);
		$this->assertTrue(
			$this->fixture->getWeeks()->contains($week)
		);
	}

	/**
	 * @test
	 * @covers ::removeWeek
	 */
	public function removeWeekForObjectRemovesEvent() {
		$week = new CalendarWeek();
		$objectStorageContainingOneWeek = new ObjectStorage();
		$objectStorageContainingOneWeek->attach($week);

		$this->fixture->setWeeks($objectStorageContainingOneWeek);
		$this->fixture->removeWeek($week);
		$this->assertFalse(
			$this->fixture->getWeeks()->contains($week)
		);
	}

	/**
	 * @test
	 * @covers ::getMonth
	 */
	public function getMonthReturnsInitiallyNull() {
		$this->assertNull(
			$this->fixture->getMonth()
		);
	}

	/**
	 * @test
	 * @covers ::getMonth
	 */
	public function getMonthForStringReturnsMonth() {
		$timeStamp = 1441065600;
		$dateTime = new \DateTime('@' . $timeStamp);
		$expectedMonth = date('n', $timeStamp);
		$this->fixture->setStartDate($dateTime);
		$this->assertSame(
			$expectedMonth,
			$this->fixture->getMonth()
		);
	}

	/**
	 * @test
	 * @covers ::getStartDate
	 */
	public function getStartDateReturnsInitiallyNull() {
		$this->assertNull(
			$this->fixture->getStartDate()
		);
	}

	/**
	 * @test
	 * @covers ::setStartDate
	 */
	public function setStartDateForObjectSetsStartDate() {
		$expectedStartDate = new \DateTime();
		$this->fixture->setStartDate($expectedStartDate);
		$this->assertSame(
			$expectedStartDate,
			$this->fixture->getStartdate()
		);
	}

	/**
	 * @test
	 */
	public function constructInitializesStorageObjects() {
		$expectedObjectStorage = new ObjectStorage();
		$this->fixture->__construct();

		$this->assertEquals(
			$expectedObjectStorage,
			$this->fixture->getWeeks()
		);
	}
}
