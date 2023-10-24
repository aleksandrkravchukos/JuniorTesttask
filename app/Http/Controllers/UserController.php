<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Mockery\Exception;

class UserController extends Controller
{

    /**
     * @var UserService
     */
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('users');
    }

    /**
     * Create user.
     *
     * @param Request $request
     * @return Model|Builder
     */
    public function store(Request $request): Model|Builder
    {
        return $this->userService->createUser($request);
    }

    /**
     * Get all users data.
     */
    public function getUsers(): array
    {
        return $this->userService->getUsers();
    }

    /**
     * Get user data by id.
     *
     * @param $id
     * @return User
     */
    public function data($id): User
    {
        return $this->userService->getUserById($id);
    }

    /**
     * Update user by id.
     *
     * @param Request $request
     * @return bool
     */
    public function update(Request $request): bool
    {
        try {
            $this->userService->validateUpdateRequest($request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        /** @var User $user */
        $user = User::query()->where('id', $request->id)->first();

        return $this->userService->updateUserData($user, $request);
    }

    /**
     * Delete user by id.
     *
     * @param $id
     * @return bool
     */
    public function destroy($id): bool
    {
        try {
            return $this->userService->deleteUser($id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
