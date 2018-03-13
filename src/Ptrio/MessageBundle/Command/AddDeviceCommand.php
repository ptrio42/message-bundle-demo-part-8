<?php

namespace App\Ptrio\MessageBundle\Command;

use App\Ptrio\MessageBundle\Model\DeviceManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddDeviceCommand extends Command
{
    public static $defaultName = 'ptrio:message:add-device';

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
            new InputArgument('token', InputArgument::REQUIRED),
        ]);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $token = $input->getArgument('token');

        if (null === $this->deviceManager->findDeviceByName($name)) {
            $device = $this->deviceManager->createDevice();
            $device->setName($name);
            $device->setToken($token);
            $this->deviceManager->updateDevice($device);

            $output->writeln('Device `'.$name.'` created!');
        } else {
            $output->writeln('Device with this name already exists!');
        }
    }
}