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

use Psr\EventDispatcher\StoppableEventInterface;

/**
 * Event is the base class for classes containing event data.
 *
 * This class contains no event data. It is used by events that do not pass
 * state information to an event handler when an event is raised.
 *
 * You can call the method stopPropagation() to abort the execution of
 * further listeners in your event listener.
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 * @author Jonathan Wage <jonwage@gmail.com>
 * @author Roman Borschel <roman@code-factory.org>
 * @author Bernhard Schussek <bschussek@gmail.com>
 * @author Nicolas Grekas <p@tchwork.com>
 * @author Roman JOLY <roman.joly@outlook.fr>
 */
class Event implements StoppableEventInterface, SkippableEventInterface
{
    private bool $propagationStopped = false;
    private ?int $propagationSkippeduntil = null;

    public function isPropagationStopped(): bool
    {
        return $this->propagationStopped;
    }

    /**
     * Stops the propagation of the event to further event listeners.
     *
     * If multiple event listeners are connected to the same event, no
     * further event listener will be triggered once any trigger calls
     * stopPropagation().
     */
    public function stopPropagation(): void
    {
        $this->propagationStopped = true;
    }

    public function isPropagationSkipped(): bool
    {
        return null !== $this->propagationSkippeduntil;
    }

    public function getPropagationSkipUntilPriority(): ?int
    {
        return $this->propagationSkippeduntil;
    }

    /**
     * Skip the propagation of the event to further event listeners until a point.
     *
     * The end Point can be a int for specify the next priority whitch will be executed.
     */
    public function skipPropagationUntil(?int $restartPoint): void
    {
        $this->propagationSkippeduntil = $restartPoint;
    }
}
