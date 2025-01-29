<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Security\Core\Authorization\Strategy;

use Symfony\Component\Security\Core\Authorization\AccessDecision;
use Symfony\Component\Security\Core\Authorization\Voter\VoteInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

/**
 * Grants access if any voter returns an affirmative response.
 *
 * If all voters abstained from voting, the decision will be based on the
 * allowIfAllAbstainDecisions property value (defaults to false).
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Alexander M. Turek <me@derrabus.de>
 */
final class AffirmativeStrategy implements AccessDecisionStrategyInterface, \Stringable
{
    public function __construct(
        private bool $allowIfAllAbstainDecisions = false,
    ) {
    }

    public function decide(\Traversable $results, $asObject = false): AccessDecision|bool
    {
        $deny = 0;
        $allVotes = [];

        foreach ($results as $result) {
            $allVotes[] = $result;
            if ($result instanceof VoteInterface) {
                $result = $result->getAccess();
            }

            if (VoterInterface::ACCESS_GRANTED === $result) {
                return $this->getReturn(true, $asObject, $allVotes);
            }

            if (VoterInterface::ACCESS_DENIED === $result) {
                ++$deny;
            }
        }

        if ($deny > 0) {
            return $this->getReturn(false, $asObject, $allVotes);
        }

        return $this->getReturn($this->allowIfAllAbstainDecisions, $asObject, $allVotes);
    }

    public function __toString(): string
    {
        return 'affirmative';
    }

    private function getReturn(bool $result, bool $asObject, array $votes): AccessDecision|bool
    {
        return $asObject ? new AccessDecision($result, $votes) : $result;
    }
}
