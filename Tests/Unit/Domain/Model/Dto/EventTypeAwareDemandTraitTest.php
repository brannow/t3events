<?php
namespace DWenzel\T3events\Tests\Unit\Domain\Model\Dto;

use TYPO3\CMS\Core\Tests\UnitTestCase;
use DWenzel\T3events\Domain\Model\Dto\EventTypeAwareDemandTrait;

/**
 * Test case for class \DWenzel\T3events\Domain\Model\Dto\EventTypeAwareDemandTrait.
 */
class EventTypeAwareDemandTraitTest extends UnitTestCase {

	/**
	 * @var \DWenzel\T3events\Domain\Model\Dto\EventTypeAwareDemandTrait
	 */
	protected $subject;

	public function setUp() {
		$this->subject = $this->getMockForTrait(
			EventTypeAwareDemandTrait::class
		);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getEventTypesReturnsInitialValueForString() {
		$this->assertNull($this->subject->getEventTypes());
	}

	/**
	 * @test
	 */
	public function setEventTypesForStringSetsEventType() {
		$this->subject->setEventTypes('foo');
		$this->assertSame(
			'foo',
			$this->subject->getEventTypes()
		);
	}
}

