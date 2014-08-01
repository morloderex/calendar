<?php

namespace Solution10\Calendar\Tests\Resolution;

use PHPUnit_Framework_TestCase;
use Solution10\Calendar\Resolution\MonthResolution as MonthResolution;
use DateTime;

/**
 * Class MonthResolutionTest
 *
 * Tests out the Month resolution on the calendar.
 *
 * FOR REFERENCE: Apr-May-June 2014:
 *
 *  APRIL                           MAY                             JUNE
 *  | M | T | W | T | F | S | S | : | M | T | W | T | F | S | S | : | M | T | W | T | F | S | S |
 *  |---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
 *  |   | 1 | 2 | 3 | 4 | 5 | 6 |   |   |   |   | 1 | 2 | 3 | 4 |   |   |   |   |   |   |   | 1 |
 *  | 7 | 8 | 9 |10 |11 |12 |13 |   | 5 | 6 | 7 | 8 | 9 |10 |11 |   | 2 | 3 | 4 | 5 | 6 | 7 | 8 |
 *  |14 |15 |16 |17 |18 |19 |20 |   |12 |13 |14 |15 |16 |17 |18 |   | 9 |10 |11 |12 |13 |14 |15 |
 *  |21 |22 |23 |24 |25 |26 |27 |   |19 |20 |21 |22 |23 |24 |25 |   |16 |17 |18 |19 |20 |21 |22 |
 *  |28 |29 |30 |   |   |   |   |   |26 |27 |28 |29 |30 |31 |   |   |23 |24 |25 |26 |27 |28 |29 |
 *  |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |   |30 |   |   |   |   |   |   |
 *
 * @package Solution10\Calendar\Tests\Resolution
 */
class MonthResolutionTest extends PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $res = new MonthResolution();
        $this->assertInstanceOf('Solution10\\Calendar\\Resolution\\MonthResolution', $res);

        $res = new MonthResolution(3, 9, false);
        $this->assertInstanceOf('Solution10\\Calendar\\Resolution\\MonthResolution', $res);
    }

    /*
     * ------------------ Testing Month Overflows ----------------------
     */

    public function testSetGetMonthOverflowGood()
    {
        $res = new MonthResolution();
        $this->assertEquals($res, $res->setMonthOverflow(2, 3));

        $this->assertEquals(array(
            'left' => 2,
            'right' => 3
        ), $res->getMonthOverflow());
    }

    public function testSetGetMonthOverflowStrings()
    {
        $res = new MonthResolution();
        $res->setMonthOverflow('3', '4');

        $this->assertEquals(array(
            'left' => 3,
            'right' => 4
        ), $res->getMonthOverflow());
    }

    public function testSetGetMonthOverflowFloats()
    {
        $res = new MonthResolution();
        $res->setMonthOverflow('3.765', '4.123');

        $this->assertEquals(array(
            'left' => 3,
            'right' => 4
        ), $res->getMonthOverflow());
    }

    /*
     * ------------------ Testing Day Overflows ----------------
     */

    public function testSetGetDaysOverflow()
    {
        $res = new MonthResolution();
        $this->assertFalse($res->showOverflowDays());

        $res->setShowOverflowDays(true);
        $this->assertTrue($res->showOverflowDays());
    }

    /*
     * ----------------- Testing Build Cells -------------------
     */

    public function testBuildCellsNoDate()
    {
        $res = new MonthResolution();
        $this->assertEquals(array(), $res->build());
    }

    public function testBuildCellsOneEitherSide()
    {
        $res = new MonthResolution(1, 1);
        $res->setDateTime(new DateTime('2014-05-15'));
        $cells = $res->build();
    }
}
