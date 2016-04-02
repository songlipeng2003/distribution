<?php
namespace app\models;

/**
 * BaseModel
 *
 */
class BaseModel extends \yii\db\ActiveRecord
{   
    public function getLastError()
    {
        $errors = $this->errors;
        $error = $errors[array_keys($errors)[0]][0];
        return $error;
    }
    
    public function saveAndCheckResult()
    {
        $result = parent::save();
        if(!$result){
            throw new \Exception("Save Error: " . var_export($this->errors, true));
        }
    
        return $result;
    }
}