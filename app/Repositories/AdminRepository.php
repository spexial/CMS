<?php  namespace App\Repositories;

use App\Admin;

class AdminRepository extends PublicRepository
{

    public function __construct(Admin $admin)
    {
        parent::__construct($admin);
    }


}