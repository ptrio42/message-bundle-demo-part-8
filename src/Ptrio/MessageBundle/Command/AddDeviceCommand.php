<?php

namespace App\Ptrio\MessageBundle\Command;

use App\Ptrio\MessageBundle\Model\DeviceManagerInterface;
use App\Ptrio\MessageBundle\Model\UserManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddDeviceCommand extends Command
{
    public static $defaultName = 'ptrio:message:add-device';

    private $deviceManager;

    /**
     * @var UserManagerInterface
     */
    private $userManager;

    /**
     * AddDeviceCommand constructor.
     * @param DeviceManagerInterface $deviceManager
     * @param UserManagerInterface $userManager
     */
    public function __construct(
        DeviceManagerInterface $deviceManager,
        UserManagerInterface $userManager
    )
    {
        $this->deviceManager = $deviceManager;
        $this->userManager = $userManager;

        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setDefinition([
            new InputArgument('name', InputArgument::REQUIRED),
            new InputArgument('token', InputArgument::REQUIRED),
            new InputArgument('username', InputArgument::REQUIRED),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $token = $input->getArgument('token');
        $username = $input->getArgument('username');

        if (null === $this->deviceManager->findDeviceByName($name)) {
            $device = $this->deviceManager->createDevice();
            $device->setName($name);
            $device->setToken($token);
            $device->setUser($this->userManager->findUserByUsername($username));
            $this->deviceManager->updateDevice($device);

            $output->writeln('Device `'.$name.'` created!');
        } else {
            $output->writeln('Device with this name already exists!');
        }
    }
}