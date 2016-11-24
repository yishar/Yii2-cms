<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comentarios".
 *
 * @property integer $id
 * @property string $comentario
 * @property integer $id_usuario
 * @property integer $id_noticia
 * @property string $estado
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $idUsuario
 * @property Noticia $idNoticia
 */
class Comentarios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comentarios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comentario', 'id_usuario', 'id_noticia'], 'required'],
            [['id_usuario', 'id_noticia'], 'integer'],
            [['estado'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['comentario'], 'string', 'max' => 255],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_usuario' => 'id']],
            [['id_noticia'], 'exist', 'skipOnError' => true, 'targetClass' => Noticia::className(), 'targetAttribute' => ['id_noticia' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comentario' => 'Comentario',
            'id_usuario' => 'Id Usuario',
            'id_noticia' => 'Id Noticia',
            'estado' => 'Estado',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdNoticia()
    {
        return $this->hasOne(Noticia::className(), ['id' => 'id_noticia']);
    }
    
    // ---> TRIGERS 
    public function behaviors() {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new \yii\db\Expression('NOW()'),
            ],
            
            'blameable' => [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'id_usuario',
                'updatedByAttribute' => 'id_usuario',
            ],
        ];
    }
}
