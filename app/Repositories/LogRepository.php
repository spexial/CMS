<?php  namespace App\Repositories;

use App\Log;

class LogRepository extends PublicRepository
{
    /**
     * LogRepository constructor.
     * @param Log $log
     */
    public function __construct(Log $log)
    {
        parent::__construct($log);
    }
}

