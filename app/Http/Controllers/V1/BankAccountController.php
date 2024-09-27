<?php

namespace App\Http\Controllers\V1;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\BankAccount\CreateRequest;
use App\Http\Requests\BankAccount\UpdateRequest;
use App\Http\Responses\ApiJsonResponse;
use App\Models\BankAccount;
use App\Services\BankAccountService;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function __construct(
        private BankAccountService $bankAccountService
    ) {
        $this->bankAccountService = new BankAccountService();
    }

    public function index(Request $request): ApiJsonResponse
    {
        return new ApiJsonResponse(200, StatusEnum::OK, 'Банковский счета получены', data: $this->bankAccountService->index($request));
    }

    public function create(CreateRequest $request): ApiJsonResponse
    {
        return new ApiJsonResponse(200, StatusEnum::OK, 'Банковский счёт создан', data: $this->bankAccountService->create($request));
    }

    public function show(BankAccount $bankAccount): ApiJsonResponse
    {
        return new ApiJsonResponse(200, StatusEnum::OK, 'Банковский счёт получен', data: $this->bankAccountService->show($bankAccount));
    }

    public function update(UpdateRequest $request, BankAccount $bankAccount): ApiJsonResponse
    {
        return new ApiJsonResponse(200, StatusEnum::OK, 'Банковский счёт обновлён', data: $this->bankAccountService->update($request, $bankAccount));
    }

    public function delete(BankAccount $bankAccount): ApiJsonResponse
    {
        $this->bankAccountService->delete($bankAccount);

        return new ApiJsonResponse(200, StatusEnum::OK, 'Банковский счёт удалён', data: []);
    }
}
