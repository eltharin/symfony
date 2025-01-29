<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Security\Core\Authorization\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * Voter is an abstract default implementation of a voter.
 *
 * @author Roman Marintšenko <inoryy@gmail.com>
 * @author Grégoire Pineau <lyrixx@lyrixx.info>
 *
 * @template TAttribute of string
 * @template TSubject of mixed
 *
 * @extends Voter<TAttribute, TSubject>
 */
abstract class VoterWithObjects extends Voter
{
    public function vote(TokenInterface $token, mixed $subject, array $attributes, bool $asObject = false): VoteInterface|int
    {
        $vote = $this->doVote($token, $subject, $attributes);

        return $asObject ? $vote : $vote->getAccess();
    }

    public function doVote(TokenInterface $token, mixed $subject, array $attributes): VoteInterface
    {
        throw new \LogicException(\sprintf('"vote" or "doVote" methods must be implemented in "%s"', static::class));
    }
}
