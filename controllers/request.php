<?php

 class ControllerRequest
 {
    public function __construct($model) {
        $this->name = 'request';
        $this->model = $model;
    }

    protected function validate_int($value){
        return is_numeric($value);
    }

    protected function validate_string($value){
        return is_string($value) && strlen($value) <= 40;
    }

    public function get($id){
        if($this->validate_int($id)){
            $data = $this->model->get($id);
            if($data->num_rows != 1){
                return [
                    'error' => 'the request is not found'
                ];
            }else{
                return [
                    'request' => $data->fetch_assoc()
                ];
            }
        }else{
            return [
                'error' => 'invalid id'
            ];
        }
    }

    public function all($limit=10){
        if($this->validate_int($limit) && $limit <= 50){
            $data = $this->model->all($limit);
            $rows = [];
            while ($row = $data->fetch_assoc()) {
               $rows[] = $row;
            }
            return [
                'data' => $rows
            ];
        }else{
            return [
                'error' => 'invalid limit'
            ];
        }
    }

    public function add($name){
        if($this->validate_string($name, 40)){
            $result = $this->model->create($name);
            return [
                'result' => $result
            ];
        }else{
            return [
                'error' => 'invalid request\'s name'
            ];
        }
    }

    public function confirm($id){
        if($this->validate_int($id)){
            $result = $this->model->update($id,1);
            return [
                'result' => $result
            ];
        }else{
            return [
                'error' => 'invalid id'
            ];
        }
    }

    public function complete($id){
        if($this->validate_int($id)){
            $result = $this->model->get($id);
            if($result->num_rows != 1){
                return [
                    'error' => 'the request is not found'
                ];
            }
            $request = $result->fetch_assoc();
            if(strtotime($request['created_date']) + 60 > time()){
                return [
                    'error' => 'the request was created less than a minute ago'
                ];
            }
            $hour = intval(date('H', strtotime($request['created_date'])));
            if($hour > 12 && !$request['status']){
                return [
                    'error' => 'the request should be confirmed'
                ];
            }
            $result = $this->model->delete($id);
            return [
                'result' => $result
            ];
        }else{
            return [
                'error' => 'invalid id'
            ];
        }
    }
 }
?>