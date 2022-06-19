<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Messenger\CustomerFrontHasBeenCreatedMessage;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface as MessageBus;

class NotifyAboutNewCustomerCommand extends Command
{
    protected static $defaultName = 'project:notify:about:new:customer';

    private MessageBus $messageBus;

    /**
     * @param MessageBus $messageBus
     */
    public function __construct(MessageBus $messageBus)
    {
        parent::__construct();
        $this->messageBus = $messageBus;
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->addArgument('id', InputArgument::REQUIRED);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->messageBus->dispatch(new CustomerFrontHasBeenCreatedMessage((int)$input->getArgument('id')));

        return self::SUCCESS;
    }
}