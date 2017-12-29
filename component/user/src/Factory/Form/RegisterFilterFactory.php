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
      $filter = new RegisterFilter(
        new Validator\NoRecordExists(array(
          'mapper' => $serviceManager->get('zfcuser_user_mapper'),
          'key'    => 'email'
        )),
        new Validator\NoRecordExists(array(
          'mapper' => $serviceManager->get('zfcuser_user_mapper'),
          'key'    => 'username'
        )),
        $serviceManager->get('zfcuser_module_options')
      );

      $filter->add(
        [
          'name'       => 'first_name',
          'required'   => true,
          'filters'    => [
            'StripTags'     => ['name' => 'StripTags'],
            'StringTrim'    => ['name' => 'StringTrim'],
            'StripNewlines' => ['name' => 'StripNewlines'],
            'Null'          => ['name' => 'Null'],
          ],
          'validators' => [
            'NotEmpty'     => [
              'name' => 'NotEmpty',
            ],
            'StringLength' => [
              'name'    => 'StringLength',
              'options' => [
                'encoding' => 'UTF-8',
                'min'      => 1,
                'max'      => 255,
              ],
            ],
          ],
        ]
      );

      $filter->add(
        [
          'name'       => 'last_name',
          'required'   => true,
          'filters'    => [
            'StripTags'     => ['name' => 'StripTags'],
            'StringTrim'    => ['name' => 'StringTrim'],
            'StripNewlines' => ['name' => 'StripNewlines'],
            'Null'          => ['name' => 'Null'],
          ],
          'validators' => [
            'NotEmpty'     => [
              'name' => 'NotEmpty',
            ],
            'StringLength' => [
              'name'    => 'StringLength',
              'options' => [
                'encoding' => 'UTF-8',
                'min'      => 1,
                'max'      => 255,
              ],
            ],
          ],
        ]
      );
      $form->setInputFilter($filter);

      return $form;

    }
}
