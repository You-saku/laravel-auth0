<?php

declare(strict_types=1);

namespace App\Auth;

use Auth0\Laravel\Contract\Auth\User\Repository as Repository;
use App\Models\User;

class CustomUserRepository implements Repository
{
    /**
     * @inheritdoc
     *
     * @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function fromSession(
        array $user
    ): ?\Illuminate\Contracts\Auth\Authenticatable {
        // Unused in this quickstart example.
        return null;
    }

    /**
     * @inheritdoc
     */
    public function fromAccessToken(
        array $user
    ): ?\Illuminate\Contracts\Auth\Authenticatable {

        $loginUser = User::where('auth0_id', $user['sub'])->first();
        // return new \App\Models\User([
        //     'id' => $user['sub'] ?? $user['user_id'] ?? null,
        //     // 'name' => $user['name'],
        //     // 'email' => $user['email'],
        // ]);
        return $loginUser;
    }
}
