<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace spec\Bundle\UserBundle\Provider;

use PhpSpec\ObjectBehavior;
use Bundle\UserBundle\Provider\AbstractUserProvider;
use Component\User\Canonicalizer\CanonicalizerInterface;
use Component\User\Model\User;
use Component\User\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class EmailProviderSpec extends ObjectBehavior
{
    function let(UserRepositoryInterface $userRepository, CanonicalizerInterface $canonicalizer): void
    {
        $this->beConstructedWith(User::class, $userRepository, $canonicalizer);
    }

    function it_implements_symfony_user_provider_interface(): void
    {
        $this->shouldImplement(UserProviderInterface::class);
    }

    function it_should_extend_user_provider(): void
    {
        $this->shouldHaveType(AbstractUserProvider::class);
    }

    function it_supports_sylius_user_model(): void
    {
        $this->supportsClass(User::class)->shouldReturn(true);
    }

    function it_loads_user_by_email(
        UserRepositoryInterface $userRepository,
        CanonicalizerInterface $canonicalizer,
        User $user
    ): void {
        $canonicalizer->canonicalize('test@user.com')->willReturn('test@user.com');

        $userRepository->findOneByEmail('test@user.com')->willReturn($user);

        $this->loadUserByUsername('test@user.com')->shouldReturn($user);
    }

    function it_updates_user_by_user_name(UserRepositoryInterface $userRepository, User $user): void
    {
        $userRepository->find(1)->willReturn($user);

        $user->getId()->willReturn(1);

        $this->refreshUser($user)->shouldReturn($user);
    }
}
