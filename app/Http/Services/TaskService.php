<?php

namespace App\Http\Services;

use App\Exceptions\APIException;
use App\Http\Requests\Task\CreateRequest;
use App\Models\Task;
use Exception;
use Illuminate\Support\Str;

class TaskService
{
    /** @var MerchantService $merchantService */
    private MerchantService $merchantService;

    /** @var CardService $cardService */
    private CardService $cardService;

    /** @var Task $task */
    private Task $task;

    public function __construct()
    {
        $this->merchantService = new MerchantService();
        $this->cardService = new CardService();
    }

    /**
     * @param CreateRequest $request
     * @return void
     * @throws APIException
     */
    public function create(CreateRequest $request): void
    {
        try {
            $cardId = $this->cardService->get($request->cardUuid, ['id'])['id'];
            $merchantId = $this->merchantService->get($request->merchantUuid, ['id'])['id'];

            Task::query()->create([
                'uuid' => Str::uuid(),
                'card_id' => $cardId,
                'merchant_id' => $merchantId,
                'type' => $request->type
            ]);
        }
        catch (Exception $e){
            throw new APIException($e->getMessage());
        }
    }

    public function mark(string $uuid): TaskService
    {
        /** @var Task $task */
        $task = Task::whereUuid($uuid)->first();
        $this->task = $task;
        return $this;
    }

    /**
     * @throws APIException
     */
    public function asFinished(): void
    {
        try {
            $this->task->is_finished = true;
            $this->task->save();
        }
        catch (Exception $e){
            throw new APIException($e->getMessage());
        }
    }

    /**
     * @throws APIException
     */
    public function asFailed(): void
    {
        try {
            $this->task->status = 'failed';
            $this->task->save();
        }
        catch (Exception $e){
            throw new APIException($e->getMessage());
        }
    }
}
