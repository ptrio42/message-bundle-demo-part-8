<?php

namespace App\Ptrio\MessageBundle\Command;

use App\Ptrio\MessageBundle\Model\DeviceManagerInterface;
use App\Ptrio\MessageBundle\Model\MessageInterface;
use App\Ptrio\MessageBundle\Model\MessageManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ListDeviceMessagesCommand extends Command
{
    private $messageManager;
    private $deviceManager;
    public static $defaultName = 'ptrio:message:list-device-messages';

    public function __construct(
        MessageManagerInterface $messageManager,
        DeviceManagerInterface $deviceManager
    )
    {
        $this->messageManager = $messageManager;
        $this->deviceManager = $deviceManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setDefinition([
            new InputArgument('device-name', InputArgument::REQUIRED),
        ]);
    }
    
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $deviceName = $input->getArgument('device-name');
        if ($device = $this->deviceManager->findDeviceByName($deviceName)) {
            $deviceMessages = $this->messageManager->findMessagesByDevice($device);
            $io = new SymfonyStyle($input, $output);
            $tableHeader = ['Device Name', 'Message Body', 'Sent At'];
            $tableBody = [];
            foreach ($deviceMessages as $message) {
                /** @var MessageInterface $message */
                $tableBody[] = [$message->getDevice()->getName(), $message->getBody(), $message->getSentAt()->format('Y-m-d H:i')];
            }
            $io->table($tableHeader, $tableBody);
        }
    }
}