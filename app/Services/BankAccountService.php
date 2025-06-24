<?php
namespace App\Services;

use App\Models\BankAccount;
use App\Models\Customer;
use App\Services\Accounts\AccountFactory;
use Illuminate\Support\Facades\DB;
use App\Enums\TypeAccount;
use App\Repositories\Contracts\BankAccountRepositoryInterface;
use App\Repositories\Contracts\CustomerRepositoryInterface as ContractsCustomerRepositoryInterface;
use App\Services\Accounts\StandardAccount;

class BankAccountService
{

    public function __construct(
        protected ContractsCustomerRepositoryInterface $customerRepo,
        protected BankAccountRepositoryInterface $accountRepo,
    ) {
    }

    public function createAccountWithCustomer(array $data)
    {
        DB::beginTransaction();

        try {

            $customer = $this->customerRepo->create([
                'fullname' => $data['fullname'],
                'email' => $data['email'] ?? null,
                'phone' => $data['phone'] ?? null,
                'password' => bcrypt($data['password']),
            ]);


            $account = $this->accountRepo->create([
                'customer_id' => $customer->id,
                'password' => $data['password'],
                'type' => isset($data['type'])
                    ? TypeAccount::from($data['type'])->value
                    : TypeAccount::Standard->value,
            ]);

            DB::commit();
            return $this->successResponse(
                'success',
                'Tạo tài khoản thành công'
            );
        } catch (\Exception $e) {
            DB::rollBack();

            $this->errorResponse('error', $e->getMessage());
        }
    }


    public function deposit(BankAccount $account, float $amount): array
    {
        DB::beginTransaction();
        try {

            $logic = AccountFactory::make($account);
            $newbalance = $logic->deposit($amount);

            DB::commit();
            return [
                'status' => 'success',
                'message' => 'Nạp tiền thành công.',
                'balance' => $newbalance,
            ];
        } catch (\Throwable $th) {
            DB::rollBack();

            return [
                'status' => 'error',
                'message' => 'Giao dịch thất bại: ' . $th->getMessage(),
            ];
        }

    }

    public function withdraw(BankAccount $account, float $amount): array
    {
        DB::beginTransaction();
        try {

            $logic = AccountFactory::make($account);
            $newbalance = $logic->withdraw($amount);

            DB::commit();
            return [
                'status' => 'success',
                'message' => 'Rút tiền thành công',
                'balance' => $newbalance
            ];
        } catch (\Throwable $th) {
            DB::rollBack();
            return [
                'status' => 'error',
                'message' => 'Giao dịch thất bại' . $th->getMessage(),
            ];
        }
    }

    public function successResponse($status, $message)
    {
        return [
            'status' => $status,
            'message' => $message
        ];
    }
    public function errorResponse($status, $message)
    {
        return [
            'status' => $status,
            'message' => $message
        ];
    }

    public function filterAccountType(int|string|TypeAccount $type, BankAccount $account): object
    {
        if (!$type instanceof TypeAccount) {
            $type = TypeAccount::tryFrom((int) $type);
        }

        return match ($type) {
            TypeAccount::Standard => new StandardAccount($account),
            default => throw new \Exception("Loại tài khoản không hợp lệ"),
        };
    }


}