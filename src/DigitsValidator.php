<?php

namespace zVPS\PhalconValidation;

use Phalcon\Validation\Validator,
    Phalcon\Validation\ValidatorInterface,
    Phalcon\Validation\Message;

class DigitsValidator extends Validator implements ValidatorInterface
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
        
        if (extension_loaded('mbstring')) {
            // Filter for the value with mbstring
            $pattern = '/[^[:digit:]]/';
        } else {
            // Filter for the value without mbstring
            $pattern = '/[\p{^N}]/';
        }
        
        $filtered = preg_replace($pattern, '', (string) $value);
        
        if((!is_int($value) && !is_float($value)) || $value !== $filtered) {
            
            $message = $this->getOption('message');
            if (!$message) {
                $message = 'Value contains non-alpha characters';
            }

            $validator->appendMessage(new Message($message, $attribute, 'Alpha'));

            return false;
        }

        return true;
    }
    
}
