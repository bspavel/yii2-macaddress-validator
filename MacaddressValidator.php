<?php

/**
 * Yii2 MAC-address Validator
 * 
 * @link https://github.com/vakorovin/yii2-macaddress-validator
 * @license https://github.com/vakorovin/yii2-macaddress-validator/blob/master/LICENSE MIT
 * @author Vladimir Korovin <rolan1986@gmail.com>
 */

namespace vakorovin\yii2_macaddress_validator;

use yii\validators\Validator;

use Yii;

class MacaddressValidator extends Validator
{

	public $patterns=[
		'/^[0-9a-f]{2}[\-: ]{1}[0-9a-f]{2}[\-: ]{1}[0-9a-f]{2}[\-: ]{1}[0-9a-f]{2}[\-: ]{1}[0-9a-f]{2}[\-: ]{1}[0-9a-f]{2}$/i',
		'/^[0-9a-f]{4}[\. ]{1}[0-9a-f]{4}[\. ]{1}[0-9a-f]{4}$/i',
		'/^[0-9a-f]{6}[\-: ]{1}[0-9a-f]{6}$/i',
		'/^[0-9a-f]{12}$/i',
	];


    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = Yii::t('yii', '{attribute} is not a valid mac-address.');
        }
    }

    protected function validateValue($value)
    {

		foreach ($this->patterns as $pattern){
			if (preg_match($pattern, $value)){
				return null;
			}
		}

        return [$this->message, []];

    }

    public function clientValidateAttribute($model, $attribute, $view)
    {

		return "
            var message => ".$this->message.";


			\nvar patterns=[
				/^[0-9a-f]{2}[\-: ]{1}[0-9a-f]{2}[\-: ]{1}[0-9a-f]{2}[\-: ]{1}[0-9a-f]{2}[\-: ]{1}[0-9a-f]{2}[\-: ]{1}[0-9a-f]{2}$/i,
				/^[0-9a-f]{4}[\. ]{1}[0-9a-f]{4}[\. ]{1}[0-9a-f]{4}$/i,
				/^[0-9a-f]{6}[\-: ]{1}[0-9a-f]{6}$/i,
				/^[0-9a-f]{12}$/i,
			];

			var valid=false;

			for (i in patterns){
				matches=patterns[i].exec(value);
				if (matches!=null){
					return true;
				}
			}

			pub.addMessage(messages, message, value);

		";

    }

}
