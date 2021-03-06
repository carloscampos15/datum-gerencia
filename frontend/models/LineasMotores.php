<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "lineas_motores".
 *
 * @property string $id
 * @property string $descripcion Descripción de la linea de motores
 * @property string $marca_motor_id Marca del motor con la cual esta relacionada la linea
 * @property string $observacion
 * @property string $creado_por
 * @property string $creado_el
 * @property string $actualizado_por
 * @property string $actualizado_el
 *
 * @property User $creadoPor
 * @property User $actualizadoPor
 * @property Motores[] $motores
 */
class LineasMotores extends \common\models\MyActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lineas_motores';
    }
    /**
     * Registra y/o Modifica la empresa en el modelo, según la empresa del usuario logueado
     * @param string $insert Query de inserción
     * @return mixed[]
     */
    public function beforeSave($insert) {
        $this->empresa_id = Yii::$app->user->identity->empresa_id;
        return parent::beforeSave($insert);
    }
    /**
     * Sobreescritura del método find para que siempre filtre por la empresa del usuario logueado
     * @return array Arreglo filtrado por empresa
     */
    public static function find()
    {
        return parent::find()->andFilterWhere(['empresa_id' =>@Yii::$app->user->identity->empresa_id]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descripcion', 'marca_motor_id'], 'required'],
            [['marca_motor_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['observacion'], 'string'],
            [['creado_el', 'actualizado_el'], 'safe'],
            [['descripcion'], 'string', 'max' => 355],
            [['creado_por'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creado_por' => 'id']],
            [['actualizado_por'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['actualizado_por' => 'id']],
            [['marca_motor_id'], 'exist', 'skipOnError' => true, 'targetClass' => MarcasMotores::className(), 'targetAttribute' => ['marca_motor_id' => 'id']], 

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'marca_motor_id' => 'Marca Motor',
            'observacion' => 'Observacion',
            'creado_por' => 'Creado Por',
            'creado_el' => 'Creado El',
            'actualizado_por' => 'Actualizado Por',
            'actualizado_el' => 'Actualizado El',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreadoPor()
    {
        return $this->hasOne(User::className(), ['id' => 'creado_por']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActualizadoPor()
    {
        return $this->hasOne(User::className(), ['id' => 'actualizado_por']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMotores()
    {
        return $this->hasMany(Motores::className(), ['linea_motor_id' => 'id']);
    }
    /**
    * @return \yii\db\ActiveQuery
    */
   public function getMarcaMotor() 
   { 
       return $this->hasOne(MarcasMotores::className(), ['id' => 'marca_motor_id']); 
   } 
}
