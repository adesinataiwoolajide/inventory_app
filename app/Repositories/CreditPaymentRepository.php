<?php 

namespace App\Repositories;
use Illuminate\Database\Eloquent\Model;

class CreditPaymentRepository implements CreditPaymentRepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // update record in the database
    public function update(array $data, $pay_id)
    {
        $update = $this->model->findOrFail($pay_id);
        return $update->update($data);
    }

    // remove record from the database
    public function delete($pay_id)
    {
        return $this->model->destroy($pay_id);
    }

    // show the record with the given pay_id
    public function show($pay_id)
    {
        return $this->model->findOrFail($pay_id);
    }

    
    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }
}


interface CreditPaymentRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $pay_id);

    public function delete($pay_id);

    public function show($pay_id);
}