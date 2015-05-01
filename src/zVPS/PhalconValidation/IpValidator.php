<?php

namespace zVPS\PhalconValidation;

use Phalcon\Validation\Validator,
    Phalcon\Validation\ValidatorInterface,
    Phalcon\Validation\Message;

class IpValidator extends Validator implements ValidatorInterface
{

    /**
     * Executes the validation
     *
     * @param Phalcon\Validation $validator
     * @param string $attribute
     * @return boolean
     */
    public function validate(\Phalcon\Validation $validator, $attribute)
    {
        $value = $validator->getValue($attribute);

        if (!filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6)) {

            $message = $this->getOption('message');
            if (!$message) {
                $message = 'The IP is not valid';
            }

            $validator->appendMessage(new Message($message, $attribute, 'Ip'));

            return false;
        }

        return true;
    }
    
}
