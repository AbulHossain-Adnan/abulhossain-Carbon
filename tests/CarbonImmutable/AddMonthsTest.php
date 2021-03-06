<?php

declare(strict_types=1);

/**
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\CarbonImmutable;

use Carbon\CarbonImmutable as Carbon;
use Tests\AbstractTestCase;

class AddMonthsTest extends AbstractTestCase
{
    /**
     * @var \Carbon\CarbonImmutable
     */
    private $carbon;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var Carbon $date */
        $date = Carbon::create(2016, 1, 31);

        $this->carbon = $date;
    }

    public function providerTestAddMonthNoOverflow()
    {
        return [
            [-2, 2015, 11, 30],
            [-1, 2015, 12, 31],
            [0, 2016, 1, 31],
            [1, 2016, 2, 29],
            [2, 2016, 3, 31],
        ];
    }

    /**
     * @dataProvider \Tests\Carbon\AddMonthsTest::providerTestAddMonthNoOverflow
     *
     * @param int $months
     * @param int $y
     * @param int $m
     * @param int $d
     */
    public function testAddMonthNoOverflow($months, $y, $m, $d)
    {
        $this->assertCarbon($this->carbon->addMonthNoOverflow($months), $y, $m, $d);
    }

    /**
     * @dataProvider \Tests\Carbon\AddMonthsTest::providerTestAddMonthNoOverflow
     *
     * @param int $months
     * @param int $y
     * @param int $m
     * @param int $d
     */
    public function testAddMonthsNoOverflow($months, $y, $m, $d)
    {
        $this->assertCarbon($this->carbon->addMonthsNoOverflow($months), $y, $m, $d);
    }

    public function providerTestSubMonthNoOverflow()
    {
        return [
            [-2, 2016, 3, 31],
            [-1, 2016, 2, 29],
            [0, 2016, 1, 31],
            [1, 2015, 12, 31],
            [2, 2015, 11, 30],
        ];
    }

    /**
     * @dataProvider \Tests\Carbon\AddMonthsTest::providerTestSubMonthNoOverflow
     *
     * @param int $months
     * @param int $y
     * @param int $m
     * @param int $d
     */
    public function testSubMonthNoOverflow($months, $y, $m, $d)
    {
        $this->assertCarbon($this->carbon->subMonthNoOverflow($months), $y, $m, $d);
    }

    /**
     * @dataProvider \Tests\Carbon\AddMonthsTest::providerTestSubMonthNoOverflow
     *
     * @param int $months
     * @param int $y
     * @param int $m
     * @param int $d
     */
    public function testSubMonthsNoOverflow($months, $y, $m, $d)
    {
        $this->assertCarbon($this->carbon->subMonthsNoOverflow($months), $y, $m, $d);
    }

    public function providerTestAddMonthWithOverflow()
    {
        return [
            [-2, 2015, 12, 1],
            [-1, 2015, 12, 31],
            [0, 2016, 1, 31],
            [1, 2016, 3, 2],
            [2, 2016, 3, 31],
        ];
    }

    /**
     * @dataProvider \Tests\Carbon\AddMonthsTest::providerTestAddMonthWithOverflow
     *
     * @param int $months
     * @param int $y
     * @param int $m
     * @param int $d
     */
    public function testAddMonthWithOverflow($months, $y, $m, $d)
    {
        $this->assertCarbon($this->carbon->addMonthWithOverflow($months), $y, $m, $d);
    }

    /**
     * @dataProvider \Tests\Carbon\AddMonthsTest::providerTestAddMonthWithOverflow
     *
     * @param int $months
     * @param int $y
     * @param int $m
     * @param int $d
     */
    public function testAddMonthsWithOverflow($months, $y, $m, $d)
    {
        $this->assertCarbon($this->carbon->addMonthsWithOverflow($months), $y, $m, $d);
    }

    public function providerTestSubMonthWithOverflow()
    {
        return [
            [-2, 2016, 3, 31],
            [-1, 2016, 3, 2],
            [0, 2016, 1, 31],
            [1, 2015, 12, 31],
            [2, 2015, 12, 1],
        ];
    }

    /**
     * @dataProvider \Tests\Carbon\AddMonthsTest::providerTestSubMonthWithOverflow
     *
     * @param int $months
     * @param int $y
     * @param int $m
     * @param int $d
     */
    public function testSubMonthWithOverflow($months, $y, $m, $d)
    {
        $this->assertCarbon($this->carbon->subMonthWithOverflow($months), $y, $m, $d);
    }

    /**
     * @dataProvider \Tests\Carbon\AddMonthsTest::providerTestSubMonthWithOverflow
     *
     * @param int $months
     * @param int $y
     * @param int $m
     * @param int $d
     */
    public function testSubMonthsWithOverflow($months, $y, $m, $d)
    {
        $this->assertCarbon($this->carbon->subMonthsWithOverflow($months), $y, $m, $d);
    }

    public function testSetOverflowIsTrue()
    {
        Carbon::useMonthsOverflow(true);
        $this->assertTrue(Carbon::shouldOverflowMonths());
    }

    public function testSetOverflowIsFalse()
    {
        Carbon::useMonthsOverflow(false);
        $this->assertFalse(Carbon::shouldOverflowMonths());
    }

    public function testSetOverflowIsResetInTests()
    {
        $this->assertTrue(Carbon::shouldOverflowMonths());
    }

    public function testSetOverflowIsReset()
    {
        Carbon::useMonthsOverflow(false);
        $this->assertFalse(Carbon::shouldOverflowMonths());

        Carbon::resetMonthsOverflow();
        $this->assertTrue(Carbon::shouldOverflowMonths());
    }

    /**
     * @dataProvider \Tests\Carbon\AddMonthsTest::providerTestAddMonthWithOverflow
     *
     * @param int $months
     * @param int $y
     * @param int $m
     * @param int $d
     */
    public function testUseOverflowAddMonth($months, $y, $m, $d)
    {
        Carbon::useMonthsOverflow(true);
        $this->assertCarbon($this->carbon->addMonth($months), $y, $m, $d);
    }

    /**
     * @dataProvider \Tests\Carbon\AddMonthsTest::providerTestAddMonthWithOverflow
     *
     * @param int $months
     * @param int $y
     * @param int $m
     * @param int $d
     */
    public function testUseOverflowAddMonths($months, $y, $m, $d)
    {
        Carbon::useMonthsOverflow(true);
        $this->assertCarbon($this->carbon->addMonths($months), $y, $m, $d);
    }

    /**
     * @dataProvider \Tests\Carbon\AddMonthsTest::providerTestSubMonthWithOverflow
     *
     * @param int $months
     * @param int $y
     * @param int $m
     * @param int $d
     */
    public function testUseOverflowSubMonth($months, $y, $m, $d)
    {
        Carbon::useMonthsOverflow(true);
        $this->assertCarbon($this->carbon->subMonth($months), $y, $m, $d);
    }

    /**
     * @dataProvider \Tests\Carbon\AddMonthsTest::providerTestSubMonthWithOverflow
     *
     * @param int $months
     * @param int $y
     * @param int $m
     * @param int $d
     */
    public function testUseOverflowSubMonths($months, $y, $m, $d)
    {
        Carbon::useMonthsOverflow(true);
        $this->assertCarbon($this->carbon->subMonths($months), $y, $m, $d);
    }

    /**
     * @dataProvider \Tests\Carbon\AddMonthsTest::providerTestAddMonthNoOverflow
     *
     * @param int $months
     * @param int $y
     * @param int $m
     * @param int $d
     */
    public function testSkipOverflowAddMonth($months, $y, $m, $d)
    {
        Carbon::useMonthsOverflow(false);
        $this->assertCarbon($this->carbon->addMonth($months), $y, $m, $d);
    }

    /**
     * @dataProvider \Tests\Carbon\AddMonthsTest::providerTestAddMonthNoOverflow
     *
     * @param int $months
     * @param int $y
     * @param int $m
     * @param int $d
     */
    public function testSkipOverflowAddMonths($months, $y, $m, $d)
    {
        Carbon::useMonthsOverflow(false);
        $this->assertCarbon($this->carbon->addMonths($months), $y, $m, $d);
    }

    /**
     * @dataProvider \Tests\Carbon\AddMonthsTest::providerTestSubMonthNoOverflow
     *
     * @param int $months
     * @param int $y
     * @param int $m
     * @param int $d
     */
    public function testSkipOverflowSubMonth($months, $y, $m, $d)
    {
        Carbon::useMonthsOverflow(false);
        $this->assertCarbon($this->carbon->subMonth($months), $y, $m, $d);
    }

    /**
     * @dataProvider \Tests\Carbon\AddMonthsTest::providerTestSubMonthNoOverflow
     *
     * @param int $months
     * @param int $y
     * @param int $m
     * @param int $d
     */
    public function testSkipOverflowSubMonths($months, $y, $m, $d)
    {
        Carbon::useMonthsOverflow(false);
        $this->assertCarbon($this->carbon->subMonths($months), $y, $m, $d);
    }
}
