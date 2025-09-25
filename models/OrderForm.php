<?php
     namespace app\models;

     use Yii;
     use yii\base\Model;

     class OrderForm extends Model
     {
         public $first_name;
         public $last_name;
         public $company_name;
         public $address;
         public $city;
         public $country;
         public $postcode;
         public $mobile;
         public $email;
         public $create_account;
         public $ship_different_address;
         public $notes;
         public $shipping;
         public $payment_method;

         public function rules()
         {
             return [
                 [['first_name', 'last_name', 'address', 'city', 'country', 'postcode', 'mobile', 'email', 'shipping', 'payment_method'], 'required'],
                 [['create_account', 'ship_different_address'], 'boolean'],
                 [['notes'], 'string'],
                 [['email'], 'email'],
                 [['mobile'], 'match', 'pattern' => '/^\+?\d{10,15}$/', 'message' => 'Mobile number must be a valid phone number.'],
                 [['shipping'], 'in', 'range' => ['free', 'flat', 'pickup']],
                 [['payment_method'], 'in', 'range' => ['bank_transfer', 'check', 'cod', 'paypal']],
             ];
         }
     }