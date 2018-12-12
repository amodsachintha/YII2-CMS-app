<?php

namespace app\models;

use Yii;
use yii\db\Exception;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $role_id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $auth_key
 * @property string $access_token
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'email', 'password', 'name'], 'required'],
            [['role_id'], 'integer'],
            [['email', 'password', 'name', 'auth_key', 'access_token'], 'string', 'max' => 191],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_id' => 'Role ID',
            'email' => 'Email',
            'password' => 'Password',
            'name' => 'Name',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public static function findIdentity($id)
    {
        try{
            return self::find()->where(['id'=>$id])->one();
        }catch (\Exception $e){
            return null;
        }
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        try{
            return self::find()->where(['access_token'=>$token])->one();
        }catch (\Exception $e){
            return null;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public static function findByEmail($email)
    {
        try{
            return self::find()->where(['email'=>$email])->one();
        }catch (Exception $exception){
            return null;
        }

    }

    public function validatePassword($password)
    {
        if(Yii::$app->getSecurity()->validatePassword($password, $this->password)){
            return true;
        }
        else
            return false;

    }


}
