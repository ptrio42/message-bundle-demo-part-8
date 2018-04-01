<?php

namespace App\Ptrio\MessageBundle\Command;

use App\Ptrio\MessageBundle\Model\UserManagerInterface;
use App\Ptrio\MessageBundle\Util\TokenGeneratorInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AddUserCommand extends Command
{
    /**
     * @var string
     */
    public static $defaultName = 'ptrio:message:add-user';

    /**
     * @var UserManagerInterface
     */
    private $userManager;

    /**
     * @var TokenGeneratorInterface
     */
    private $tokenGenerator;

    /**
     * AddUserCommand constructor.
     * @param UserManagerInterface $userManager
     * @param TokenGeneratorInterface $tokenGenerator
     */
    public function __construct(
        UserManagerInterface $userManager,
        TokenGeneratorInterface $tokenGenerator
    )
    {
        $this->userManager = $userManager;
        $this->tokenGenerator = $tokenGenerator;

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
            $output->writeln('User with a given username already exists.');
        } else {
            $user = $this->userManager->createUser();
            $user->setUsername($username);
            $apiKey = $this->tokenGenerator->generateToken();
            $user->setApiKey($apiKey);
            $user->addRole($user::ROLE_USER);
            $this->userManager->updateUser($user);

            $output->writeln('User created successfully with the following api key: ' . $apiKey);
        }
    }
}