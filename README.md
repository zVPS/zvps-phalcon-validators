# Phalcon Validators

Additional form and data validators extending the inbuilt phalcon validate interface.

## Example usage

```php
<?php

class LoginForm extends Form
{
    public function initialize($entity = null, $options = null)
    {

        $username = new Text('username', array(
            'class' => 'form-control'
        ));
        $username->setLabel('Username');
        $username->addValidators(array(
            new PresenceOf(array(
                'message' => 'Please enter your username.',
            )),
            new AlphaNumericValidator(array(
                'message' => 'Only Alpha, Numeric and Space characters please.', 
                'allowWhiteSpace' => true,
            )),
            new StringLength(array(
                'max' => 100,
                'messageMaximum' => 'Username is too long. Maximum 100 characters.',
            )),
        ));
        $this->add($username);
```

### Pull Requests

Pull requests are more than welcome!
