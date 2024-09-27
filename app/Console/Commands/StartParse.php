<?php

namespace App\Console\Commands;

use App\Enums\ParserProductTypeEnum;
use App\Services\ProductParser\ProductParserService;
use Illuminate\Console\Command;

class StartParse extends Command
{
    public function __construct(
        public ProductParserService $service,

    ) {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:start-parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'start TD_RIF site parsing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->service->saveAndParse(0, 9, ParserProductTypeEnum::BARLEY->value);
        $this->service->saveAndParse(0, 10, ParserProductTypeEnum::WHEAT->value);

    }
}
