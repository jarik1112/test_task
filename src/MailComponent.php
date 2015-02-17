<?php
/**
 * @author jarik <jarik1112@gmail.com>
 * @date   2/17/15
 * @time   11:29 PM
 */

namespace Framework;


use Framework\Interfaces\ConstructorInjectableInterface;
use Framework\Interfaces\IocContainerInterface;

class MailComponent implements ConstructorInjectableInterface
{
    /**
     * @var \Mandrill
     */
    protected $mandrill;

    /**
     * @var IocContainerInterface
     */
    protected $ioc;

    /**
     * @var string
     */
    protected $fromEmail = 'admin@example.com';

    /**
     * @var string
     */
    protected $fromName = 'Test Site';

    public function __construct(IocContainerInterface $container)
    {
        $this->ioc      = $container;
        $config         = $container->build('emailConfig');
        $this->mandrill = new \Mandrill($config['apiKey']);
    }


    public function send($subject, $message, $to)
    {
        $result = $this->mandrill->messages->send(
            array(
                'html'         => $message,
                'subject'      => $subject,
                'from_email'   => $this->fromEmail,
                'from_name'    => $this->fromName,
                'to'           => array(
                    array(
                        'email' => $to,
                    )
                ),
                'headers'      => array(),
                'track_opens'  => false,
                'track_clicks' => false
            )
        );

        if (isset($result[0])) {
            $result = $result[0];
            if (isset($result['status']) && in_array($result['status'], array('sent', 'queued'))) {
                return true;
            }
        }
        return false;
    }
}