<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bridge\Doctrine\ArgumentResolver;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Default variable loader service used to inject user in EntityValueResolver.
 *
 * @author Roman JOLY <eltharin18@outlook.fr>
 */
class UserInjector implements EntityValueResolverExpressionModifiersInjectorInterface
{
    public function __construct(private TokenStorageInterface $tokenStorage)
    {
    }

    public function getVariables(): array
    {
        return ['user' => $this->tokenStorage?->getToken()?->getUser()];
    }

    public function getFunctions(): array
    {
        return [];
    }
}
