<?php

declare(strict_types=1);

namespace Capito\Model;

final readonly class User
{
    public function __construct(
        private string $email,
        private string $password,
        private string $accountId,
        private string $id,
        private bool $admin,
        private bool $member,
        private bool $verified,
    )
    {}

    public function isAdmin(): bool
    {
        return $this->admin;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getAccountId(): string
    {
        return $this->accountId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function isMember(): bool
    {
        return $this->member;
    }

    public function isVerified(): bool
    {
        return $this->verified;
    }
}
