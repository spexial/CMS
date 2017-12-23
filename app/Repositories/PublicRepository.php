<?php  namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

class PublicRepository
{
    /**
     * PublicRepository constructor.
     * @param Model $model
     */

    public function  __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->model->orderBy('updated_at','DESC')->get();
    }

    /**
     * @param $num
     * @return mixed
     */
    public function paginate($num)
    {
        return $this->model->orderBy('updated_at','DESC')->paginate($num);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

}