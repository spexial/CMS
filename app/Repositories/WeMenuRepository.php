<?php  namespace App\Repositories;

use App\WeMenu;

class WeMenuRepository extends PublicRepository
{

    /**
     * WeMenuRepository constructor.
     * @param WeMenu $weMenu
     */
    public function __construct(WeMenu $weMenu)
    {
        parent::__construct($weMenu);
    }


}