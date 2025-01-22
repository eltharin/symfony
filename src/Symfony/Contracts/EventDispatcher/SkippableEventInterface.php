<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Contracts\EventDispatcher;

/**
 * An Event can skip processing listeners until a specific priority.
 *
 * @author Roman JOLY <roman.joly@outlook.fr>
 */
interface SkippableEventInterface
{
    public function isPropagationSkipped(): bool;

    public function getPropagationSkipUntilPriority(): ?int;

    /**
     * Skip the propagation of the event to further event listeners until a point.
     *
     * The end Point can be a int for specify the next priority whitch will be executed.
     */
    public function skipPropagationUntil(?int $restartPoint): void;
}
