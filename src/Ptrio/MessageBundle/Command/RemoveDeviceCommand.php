<?php

namespace App\Ptrio\MessageBundle\Command;

use App\Ptrio\MessageBundle\Model\DeviceManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RemoveDeviceCommand extends Command
{
    public static $defaultName = 'ptrio:message:remove-device';

    private $deviceManager;

    public function __construct(DeviceManagerInterface $deviceManager)
    {
        $this->deviceManager = $deviceManager;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setDefinition([
            new InputArgument('name', InputArgument::REQUIRED),
        ]);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');

        if ($device = $this->deviceManager->findDeviceByName($name)) {
            $this->deviceManager->removeDevice($device);

            $output->writeln('Device `'.$name.'` removed!');
        } else {
            $output->writeln('Device with this name does not exist!');
        }
    }
}