<?php
/**
 * WellCart Platform
 *
 * @copyright  Copyright (c) 2017 WellCart Development Team    http://wellcart.org/
 * @license    http://www.opensource.org/licenses/BSD-3-Clause New BSD License
 */
declare(strict_types = 1);

namespace WellCart\Mail;

use AcMailer\Service\MailServiceAwareInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\Log\LoggerAwareInterface;

interface MailerAwareInterface
    extends MailServiceAwareInterface,
            LoggerAwareInterface,
            EventManagerAwareInterface
{

}