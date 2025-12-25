<?php

namespace App\Console\Commands;

use App\Enums\FileTypeEnum;
use App\Enums\ParserProductTypeEnum;
use App\Models\User;
use App\Services\FileService;
use App\Services\ProductParser\ProductParserService;
use Illuminate\Console\Command;

class CheckSignatureFiles extends Command
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
    protected $signature = 'signature:check';

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
        $users = User::query()
            ->whereNotNull('sign_me_cid')
            ->where('id', '9d29f0e4-0c94-487a-addc-1a4e02a7209d')
            ->whereHas('files', function ($query) {
                return $query->where(function ($query) {
                    $query->where('type', FileTypeEnum::REQUEST->value)
                        ->orWhere('type', FileTypeEnum::CONTRACT->value)
                        ->orWhere('type', FileTypeEnum::ACT->value);
                })->where(function($signedQuery){
                    return $signedQuery->where('is_signed', false)->orWhere('is_dual_signed', false);
                });
        })->get();

        foreach($users as $user) {
            app(FileService::class)->getDocumentsForSigning(request(), $user->files);
        }
    }
}
