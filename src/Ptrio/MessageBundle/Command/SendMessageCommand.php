<?php

namespace App\Ptrio\MessageBundle\Command;

use App\Ptrio\MessageBundle\Client\ClientInterface;
use App\Ptrio\MessageBundle\Model\DeviceManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendMessageCommand extends Command
{
    private $client;
    private $deviceManager;

    protected static $defaultName = 'ptrio:message:send-message';

    public function __construct(ClientInterface $client, DeviceManagerInterface $deviceManager)
    {
        $this->client = $client;
        $this->deviceManager = $deviceManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDefinition([
            new InputArgument('body', InputArgument::REQUIRED),
            new InputArgument('recipient', InputArgument::REQUIRED),
        ]);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $messageBody = $input->getArgument('body');
        $recipient = $input->getArgument('recipient');

        if ($device = $this->deviceManager->findDeviceByName($recipient)) {
            $response = $this->client->sendMessage($messageBody, $device->getToken());

            $output->writeln('Response: '.$response);
        } else {
            $output->writeln('No device found!');
        }
    }
}