<?php  namespace App\Repositories;

use App\WeReplay;

class WeReplayRepository extends PublicRepository
{

    /**
     * WeReplayRepository constructor.
     * @param WeReplay $weReplay
     */
    public function __construct(WeReplay $weReplay)
    {
        parent::__construct($weReplay);
    }


}