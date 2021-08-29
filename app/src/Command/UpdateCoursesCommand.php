<?php

namespace App\Command;

use App\Service\CurrencyRateService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

class UpdateCoursesCommand extends Command
{
    private CurrencyRateService $currencyRate;
    protected static $defaultName = 'app:update-courses';

    public function __construct(CurrencyRateService $currencyRate)
    {
        $this->currencyRate = $currencyRate;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->currencyRate->updateBitcoinRate();
            $output->writeln('rates updated');
        } catch (Throwable $e) {
            $output->writeln($e->getMessage());

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
