<?php

namespace UserBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use FOS\UserBundle\Command\CreateUserCommand as BaseCommand;
class CreateUserCommand extends BaseCommand
{
    /**
     * @see Command
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName('app:user:create')
            ->getDefinition()->addArguments(array(
                new InputArgument('nom', InputArgument::REQUIRED, 'The nom'),
                new InputArgument('prenom', InputArgument::REQUIRED, 'The prenom')
            ))
        ;
        $this->setHelp(<<<EOT
// L'aide qui va bien
EOT
        );
    }
    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username   = $input->getArgument('username');
        $email      = $input->getArgument('email');
        $password   = $input->getArgument('password');
        $nom  = $input->getArgument('nom');
        $prenom   = $input->getArgument('prenom');
        $inactive   = $input->getOption('inactive');
        $superadmin = $input->getOption('super-admin');
        /** @var \FOS\UserBundle\Model\UserManager $user_manager */
        $user_manager = $this->getContainer()->get('fos_user.user_manager');
        /** @var \UserBundle\Entity\User $user */
        $user = $user_manager->createUser();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPlainPassword($password);
        $user->setEnabled((Boolean) !$inactive);
        $user->setSuperAdmin((Boolean) $superadmin);
        $user->setnom($nom);
        $user->setprenom($prenom);
        $user_manager->updateUser($user);
        $output->writeln(sprintf('Created user <comment>%s</comment>', $username));
    }
    /**
     * @see Command
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        parent::interact($input, $output);
        if (!$input->getArgument('nom')) {
            $helper = $this->getHelper('question');
            $question = new Question('Please enter your nom : ');
            $question->setValidator(function ($value) {
                if (trim($value) == '') {
                    throw new \Exception('The nom can not be empty');
                }
                return $value;
            });
            $nom = $helper->ask($input, $output, $question);
            $input->setArgument('nom', $nom);
        }
        if (!$input->getArgument('prenom')) {
            $helper = $this->getHelper('question');
            $question = new Question('Please enter your prenom : ');
            $question->setValidator(function ($value) {
                if (trim($value) == '') {
                    throw new \Exception('The prenom can not be empty');
                }
                return $value;
            });
            $prenom = $helper->ask($input, $output, $question);
            $input->setArgument('prenom', $prenom);
        }
    }
}