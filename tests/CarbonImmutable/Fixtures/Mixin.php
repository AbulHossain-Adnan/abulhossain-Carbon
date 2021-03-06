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

namespace Tests\CarbonImmutable\Fixtures;

use Carbon\CarbonImmutable;

class Mixin
{
    public $timezone;

    public function setUserTimezone()
    {
        $mixin = $this;

        return function ($timezone) use ($mixin) {
            $mixin->timezone = $timezone;
        };
    }

    public function userFormat()
    {
        $mixin = $this;

        return function ($format) use ($mixin) {
            /** @var CarbonImmutable $date */
            $date = $this;

            if ($mixin->timezone) {
                $date = $date->setTimezone($mixin->timezone);
            }

            return $date->format($format);
        };
    }
}
