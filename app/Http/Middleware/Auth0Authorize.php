<?php

namespace App\Http\Middleware;

use Auth0\Laravel\Contract\Http\Middleware\Stateless\Authorize;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;

class Auth0Authorize implements Authorize
{
    /**
     * @inheritdoc
     */
    public function handle(
        Request $request,
        Closure $next,
        string $scope = ''
    ) {
        $user = auth()->guard('auth0')->user();

        if ($user !== null && $user instanceof User) {
            if (strlen($scope) >= 1 && auth()->guard('auth0')->hasScope($scope) === false) {
                throw new AuthenticationException('Invalid Token.');
            }

            auth()->login($user);
            return $next($request);
        }

        throw new AuthenticationException('Invalid Token.');
    }
}
