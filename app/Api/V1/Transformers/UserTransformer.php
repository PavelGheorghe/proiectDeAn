<?php

namespace App\Api\V1\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
                'email' => (string) $user->email,
        ];
    }
}
