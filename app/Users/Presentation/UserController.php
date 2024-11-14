<?php

namespace App\Users\Presentation;

use App\Framework\Http\Controllers\Controller;
use App\Framework\Http\Requests\UserRequest;
use App\Framework\Http\Resources\UserResource;
use App\Users\Application\SubmitUserHandler;
use App\Users\Application\UsersQuery;
use App\Users\Domain\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    private UsersQuery $usersQuery;

    private UserRepository $userRepository;

    private UserFormFactory $userFormFactory;

    private SubmitUserHandler $submitUserHandler;

    public function __construct(
        UsersQuery $usersQuery,
        UserRepository $userRepository,
        UserFormFactory $userFormFactory,
        SubmitUserHandler $submitUserHandler
    ) {
        $this->usersQuery = $usersQuery;
        $this->userRepository = $userRepository;
        $this->userFormFactory = $userFormFactory;
        $this->submitUserHandler = $submitUserHandler;
    }

    public function index(): AnonymousResourceCollection
    {
        return $this->usersQuery->execute();
    }

    public function show($id): UserResource
    {
        return $this->userRepository->findUserById($id);
    }

    public function store(UserRequest $request): JsonResponse
    {
        $form = $this->userFormFactory->createFromRequest($request);
        $this->submitUserHandler->handle($form->toCommand());

        return response()->json(['message' => 'User created successfully'], 201);
    }
}
