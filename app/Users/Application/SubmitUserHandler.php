<?php

namespace App\Users\Application;

use App\Users\Domain\User;
use App\Users\Domain\UserRegistered;
use App\Users\Domain\UserRepository;

class SubmitUserHandler
{
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function handle(SubmitUserCommand $command): void
    {
        $user = User::submit(
            $command->getName(),
            $command->getEmail(),
            $command->getPassword()
        );

        $this->userRepository->add($user);

        event(new UserRegistered($user));
    }
}
