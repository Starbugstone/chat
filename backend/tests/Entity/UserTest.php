<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserCreation(): void
    {
        $user = new User();

        $this->assertInstanceOf(User::class, $user);
        $this->assertNull($user->getId());
        $this->assertNull($user->getEmail());
        $this->assertIsArray($user->getRoles());
        $this->assertTrue($user->hasRole('ROLE_USER'));
        $this->assertFalse($user->hasRole('ROLE_ADMIN'));
        $this->assertNull($user->getPassword());
        $this->assertSame(0, $user->getTokenBalance());
        $this->assertInstanceOf(\DateTimeInterface::class, $user->getCreatedAt());
        $this->assertNull($user->getLastActiveAt());
        $this->assertTrue($user->isActive());
        $this->assertFalse($user->isEmailVerified());
        $this->assertNull($user->getEmailVerificationToken());
        $this->assertNull($user->getEmailVerificationExpiresAt());
    }

    public function testGettersAndSetters(): void
    {
        $user = new User();

        $user->setEmail('test@example.com');
        $this->assertSame('test@example.com', $user->getEmail());
        $this->assertSame('test@example.com', $user->getUserIdentifier());

        $user->setPassword('password');
        $this->assertSame('password', $user->getPassword());

        $user->setRoles(['ROLE_ADMIN']);
        $this->assertTrue($user->hasRole('ROLE_ADMIN'));
        $this->assertTrue($user->isAdmin());

        $user->setTokenBalance(100);
        $this->assertSame(100, $user->getTokenBalance());

        $createdAt = new \DateTime();
        $user->setCreatedAt($createdAt);
        $this->assertSame($createdAt, $user->getCreatedAt());

        $lastActiveAt = new \DateTime();
        $user->setLastActiveAt($lastActiveAt);
        $this->assertSame($lastActiveAt, $user->getLastActiveAt());

        $user->setActive(false);
        $this->assertFalse($user->isActive());

        $user->setEmailVerified(true);
        $this->assertTrue($user->isEmailVerified());

        $user->setEmailVerificationToken('token');
        $this->assertSame('token', $user->getEmailVerificationToken());

        $expiresAt = new \DateTime();
        $user->setEmailVerificationExpiresAt($expiresAt);
        $this->assertSame($expiresAt, $user->getEmailVerificationExpiresAt());
    }

    public function testRoleMethods(): void
    {
        $user = new User();

        $this->assertTrue($user->hasRole('ROLE_USER'));
        $this->assertFalse($user->hasRole('ROLE_ADMIN'));
        $this->assertFalse($user->isAdmin());

        $user->setRoles(['ROLE_ADMIN']);
        $this->assertTrue($user->hasRole('ROLE_USER'));
        $this->assertTrue($user->hasRole('ROLE_ADMIN'));
        $this->assertTrue($user->isAdmin());

        $user->setRoles(['ROLE_ID_VERIFIED']);
        $this->assertTrue($user->isIdVerified());

        $user->setRoles(['ROLE_HAS_TOKENS']);
        $this->assertTrue($user->hasTokens());

        $user->setRoles(['ROLE_EARLY_ADOPTER']);
        $this->assertTrue($user->isEarlyAdopter());
    }
}
