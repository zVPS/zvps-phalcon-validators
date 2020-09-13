<?php

namespace zVPS\PhalconValidation;

use Phalcon\Validation\AbstractValidator as Validator;
use Phalcon\Validation\ValidatorInterface;
use Phalcon\Messages\Message;

class AlphaValidator extends Validator implements ValidatorInterface
{

    /**
     * Executes the validation
     * Available options:
     *  - allowWhiteSpace => true|false
     *  - allowSpace      => true|false
     *
     * @param Phalcon\Validation $validation
     * @param string $field
     * @return boolean
     */
    public function validate(\Phalcon\Validation $validation, $field): bool
    {
        $value = $validation->getValue($field);
        $whiteSpace = ((bool) $this->getOption('allowWhiteSpace')) ? '\s' : '';
        $space      = ((bool) $this->getOption('allowSpace')) ? ' ' : '';
        
        $pattern = '/[^\p{L}' . $whiteSpace . $space . ']/u';
        $filtered = preg_replace($pattern, '', (string) $value);
        
        if(!is_string($value) || $value !== $filtered) {
            
            $message = $this->getOption('message');
            if (!$message) {
                $message = $field. ' contains non-alpha characters';
            }

            $validation->appendMessage(new Message($message, $field, 'Alpha'));

            return false;
        }

        return true;
    }
    
}
