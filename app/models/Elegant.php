<?php

class Elegant extends Eloquent {

    protected $rules = array();

    protected $errors;

    public function validate($data = null)
    {
        if($data == null) {
            $data = $this->getAttributes();
        }
        // make a new validator object
        $v = Validator::make($data, $this->rules, $this->messages);

        // check for failure
        if ($v->fails())
        {
            // set errors and return false
            $this->errors = $v->errors();
            return false;
        }

        // validation pass
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }
}