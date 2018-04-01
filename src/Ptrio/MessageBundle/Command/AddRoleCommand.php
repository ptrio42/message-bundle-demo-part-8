<?php

namespace App\Ptrio\MessageBundle\Command;

use App\Ptrio\MessageBundle\Model\UserManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddRoleCommand extends Command
{
    /**
     * @var string
     */
    public static $defaultName = 'ptrio:message:add-role';

    /**
     * @var UserManagerInterface
     */
    private $userManager;

    /**
     * AddRoleCommand constructor.
     * @param UserManagerInterface $userManager
     */
    public function __construct(
        UserManagerInterface $userManager
    )
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
            new InputArgument('role', InputArgument::REQUIRED),
            new InputArgument('username', InputArgument::REQUIRED),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $role = $input->getArgument('role');
        $username = $input->getArgument('username');

        if ($user = $this->userManager->findUserByUsername($username)) {
            $user->addRole($role);
            $this->userManager->updateUser($user);

            $output->writeln($role.' role has been added to user: '.$user->getUsername());
        } else {
            $output->writeln('The user with the given username cannot be found.');
        }
    }
}