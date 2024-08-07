<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Security\Http\Authorization;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Security\Core\Authentication\AuthenticationTrustResolverInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * This is used by the ExceptionListener to translate an AccessDeniedException
 * to a Response object.
 *
 * @author Roman JOLY <eltharin18@outlook.fr>
 */
interface NotFullFledgedHandlerInterface
{
    /**
     * Allow to manage NotFullFledged cases when ExceptionListener catch AccessDeniedException
     * 
     * @param $starAuthenticationCallback callable for call start function from 
     * 
     * @return boolean break handleAccessDeniedException function in ExceptionListener after handle
     */
    public function handle( ExceptionEvent $event, AccessDeniedException $exception, AuthenticationTrustResolverInterface $trustResolver, ?TokenInterface $token, ?LoggerInterface $logger, callable $starAuthenticationCallback): bool;
}
