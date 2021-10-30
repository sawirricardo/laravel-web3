<?php

namespace Sawirricardo\LaravelWeb3\Commands;

use Illuminate\Console\Command;

class LaravelWeb3Command extends Command
{
    public $signature = 'web3';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
