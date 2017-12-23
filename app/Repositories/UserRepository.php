<?php  namespace App\Repositories;

use App\User;

class UserRepository extends PublicRepository
{

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }


}