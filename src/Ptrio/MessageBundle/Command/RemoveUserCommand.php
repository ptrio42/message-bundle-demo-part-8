<?php

namespace App\Ptrio\MessageBundle\Command;

use App\Ptrio\MessageBundle\Model\UserManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RemoveUserCommand extends Command
{
    /**
     * @var string
     */
    public static $defaultName = 'ptrio:message:remove-user';

    /**
     * @var UserManagerInterface
     */
    private $userManager;

    /**
     * RemoveUserCommand constructor.
     * @param UserManagerInterface $userManager
     */
    public function __construct(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;

        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setDefinition([
            new InputArgument('username', InputArgument::REQUIRED),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username = $input->getArgument('username');

        if ($user = $this->userManager->findUserByUsername($username)) {
            $this->userManager->removeUser($user);
            $output->writeln('User removed successfully.');
        } else {
            $output->writeln('User with a given username does not exist.');
        }
    }
}