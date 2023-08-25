<?php

namespace App\Console\Commands;

use App\Models\Access;
use Illuminate\Console\Command;

class CleanTable extends Command
{
    protected $signature = 'table:clean';
    protected $description = 'Clean the accesses table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        Access::truncate();

        $this->info('Accesses table cleaned successfully.');
    }
}
