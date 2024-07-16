<?php

namespace App\Services;

use App\Http\Requests\BankAccount\CreateBankAccountRequest;
use App\Http\Requests\BankAccount\CreateForShipperBankAccountRequest;
use App\Http\Requests\BankAccount\CreateRequest;
use App\Http\Requests\BankAccount\IndexLogisticianBankAccountRequest;
use App\Http\Requests\BankAccount\UpdateBankAccountRequest;
use App\Http\Requests\BankAccount\UpdateRequest;
use App\Http\Resources\BankAccount\BankAccountCollection;
use App\Http\Resources\BankAccount\BankAccountResource;
use App\Models\BankAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BankAccountService
{
    public function index(Request $request): BankAccountCollection
    {
        $user = $request->user();
        return new BankAccountCollection($user->bankAccounts);
    }


    public function show (
        BankAccount $bankAccount
    ): BankAccountResource {
        Gate::authorize('view', $bankAccount);
        return new BankAccountResource($bankAccount);
    }

    public function create(CreateRequest $request): BankAccountResource
    {
        $bankAccount = BankAccount::create($request->validated() + ['user_id' => $request->user()->id]);
        return new BankAccountResource($bankAccount);
    }


    public function update(BankAccount $bankAccount, UpdateRequest $request): BankAccountResource
    {
        $bankAccount->update($request->validated());
        Gate::authorize('update', $bankAccount);
        return new BankAccountResource($bankAccount);
    }

    public function delete(BankAccount $bankAccount): void
    {
        Gate::authorize('delete', $bankAccount);
        $bankAccount->delete();
    }
}
