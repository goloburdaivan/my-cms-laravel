<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\EditProfileRequest;
use App\Repository\UserRepository;
use App\Services\OrderService;
use App\Services\WishlistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController
{
    public function __construct(
        private readonly OrderService $orderService,
        private readonly WishlistService $wishlistService,
        private readonly UserRepository $userRepository,
    ) {
    }

    public function index(): View
    {
        return view('site.profile.index', [
            'orders' => $this->orderService->getOrdersForUser(request()->user()),
            'wishlist' => $this->wishlistService->getUserWishlist(request()->user()),
        ]);
    }

    /**
     * @throws \Exception
     */
    public function update(EditProfileRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->userRepository->update($request->user()?->id, $data);

        return redirect()->route('profile.index');
    }
}
