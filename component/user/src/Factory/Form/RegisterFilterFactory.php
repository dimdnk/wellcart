<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\User\Factory\Form;
use ZfcUser\Validator;
use WellCart\User\Form\RegisterFilter;
use Interop\Container\ContainerInterface;
class RegisterFilterFactory extends  \ZfcUser\Factory\Form\Register
{
    public function __invoke(ContainerInterface $serviceManager, $requestedName, array $options = null) {

      $form = parent::__invoke($serviceManager, $requestedName, $options);
      $form->setInputFilter(new RegisterFilter(
        new Validator\NoRecordExists(array(
          'mapper' => $serviceManager->get('zfcuser_user_mapper'),
          'key'    => 'email'
        )),
        new Validator\NoRecordExists(array(
          'mapper' => $serviceManager->get('zfcuser_user_mapper'),
          'key'    => 'username'
        )),
        $serviceManager->get('zfcuser_module_options')
      ));

      return $form;

    }
}
