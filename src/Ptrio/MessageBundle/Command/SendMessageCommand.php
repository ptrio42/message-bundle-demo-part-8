<?php

namespace App\Ptrio\MessageBundle\Command;

use App\Ptrio\MessageBundle\Client\ClientInterface;
use App\Ptrio\MessageBundle\Model\DeviceManagerInterface;
use App\Ptrio\MessageBundle\Model\MessageManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendMessageCommand extends Command
{
    private $client;
    private $deviceManager;
    private $messageManager;

    protected static $defaultName = 'ptrio:message:send-message';

    public function __construct(
        ClientInterface $client,
        DeviceManagerInterface $deviceManager,
        MessageManagerInterface $messageManager
    )
    {
        $this->client = $client;
        $this->deviceManager = $deviceManager;
        $this->messageManager = $messageManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDefinition([
            new InputArgument('body', InputArgument::REQUIRED),
            new InputArgument('device-names', InputArgument::IS_ARRAY),
        ]);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $messageBody = $input->getArgument('body');
        $deviceNames = $input->getArgument('device-names');

        $devices = $this->deviceManager->findDevicesByNames($deviceNames);
        foreach ($devices as $device) {
            /** @var DeviceInterface $device */
            $message = $this->messageManager->createMessage();
            $message->setBody($messageBody);
            $message->setDevice($device);
            $message->setSentAt(new \DateTime('now'));
            $this->messageManager->updateMessage($message);
            $response = $this->client->sendMessage($messageBody, $device->getToken());
            $output->writeln('Message successfully sent do device `'.$device->getName().'`.');
            $output->writeln('Response: '.$response);
        }
    }
}