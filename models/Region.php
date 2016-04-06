<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;

use gilek\gtreetable\models\TreeModel;

/**
 * This is the model class for table "region".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property integer $lft
 * @property integer $rgt
 * @property integer $level
 * @property integer $root
 * @property string $createdAt
 * @property string $updatedAt
 */
class Region extends TreeModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'lft', 'rgt', 'level', 'root'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'level' => 'Level',
            'root' => 'Root',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }

    public function behaviors(){
        $behaviors = parent::behaviors();
        $behaviors['timestamp'] = [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
                'value' => function() { return date('Y-m-d H:m:i'); }
            ];

        return $behaviors;
    }
}
