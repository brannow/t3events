<?php
namespace Webfox\T3events\Tests\Unit\Domain\Model;
/***************************************************************
 *  Copyright notice
 *  (c) 2012 Dirk Wenzel <wenzel@webfox01.de>, Agentur Webfox
 *  Michael Kasten <kasten@webfox01.de>, Agentur Webfox
 *  All rights reserved
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \Webfox\T3events\Domain\Model\Dto\PerformanceDemand.
 *
 * @author Dirk Wenzel <wenzel@webfox01.de>
 * @coversDefaultClass \Webfox\T3events\Domain\Model\Dto\PerformanceDemand
 */
class PerformanceDemandTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \Webfox\T3events\Domain\Model\Dto\PerformanceDemand
	 */
	protected $fixture;


	public function setUp() {
		$this->fixture = new \Webfox\T3events\Domain\Model\Dto\PerformanceDemand();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getDateReturnsInitialNull() {
		$this->assertSame(NULL, $this->fixture->getDate());
	}

	/**
	 * @test
	 */
	public function setDateForDateTimeSetsDate() {
		$now = date('Y-m-d H:i:s');
		$this->fixture->setDate($now);

		$this->assertEquals($now, $this->fixture->getDate());
	}

	/**
	 * @test
	 */
	public function getStatusReturnsInitialNull() {
		$this->assertSame(NULL, $this->fixture->getStatus());
	}

	/**
	 * @test
	 */
	public function setStatusForPerformanceStatusSetsStatus() {
		$status = new \Webfox\T3events\Domain\Model\PerformanceStatus();

		$this->fixture->setStatus($status);

		$this->assertEquals($status, $this->fixture->getStatus());
	}

	//

	/**
	 * @test
	 * @covers ::getGenres
	 */
	public function getGenresReturnsInitialNull(){
		$this->assertSame(NULL, $this->fixture->getGenres());
	}

	/**
	 * @test
	 * @covers ::setGenres
	 */
	public function setGenresForStringSetsGenres(){
		$this->fixture->setGenres('1');
		$this->assertSame('1', $this->fixture->getGenres());
	}

	/**
	 * @test
	 * @covers ::getVenues
	 */
	public function getVenuesReturnsInitialNull(){
		$this->assertSame(NULL, $this->fixture->getVenues());
	}

	/**
	 * @test
	 * @covers ::setVenues
	 */
	public function setVenuesForStringSetsVenues(){
		$this->fixture->setVenues('1');
		$this->assertSame('1', $this->fixture->getVenues());
	}

	/**
	 * @test
	 * @covers ::getEventTypes
	 */
	public function getEventTypesReturnsInitialNull() {
		$this->assertEquals(
			NULL,
			$this->fixture->getEventTypes()
		);
	}

	/**
	 * @test
	 * @covers ::setEventTypes
	 */
	public function setEventTypesForStringSetsEventTypes(){
		$this->fixture->setEventTypes('1,2,3');

		$this->assertSame(
			'1,2,3',
			$this->fixture->getEventTypes()
		);
	}
}

