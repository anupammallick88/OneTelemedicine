<?php

class DummyService
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function index()
    {
        $data = ['success' => false, 'message' => __('Something went wrong'), 'data' => []];
        $get = $this->model->get();

        if ($get) {
            $data['success'] = true;
            $data['message'] = $get;
            $data['data'] = $get;

            return $data;
        }

        return $data;
    }
}
