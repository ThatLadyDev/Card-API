<?php

namespace App\Http\Services;

use App\Exceptions\APIException;
use App\Http\Requests\Task\CreateRequest;
use App\Models\CardSwitch;
use App\Models\Task;
use Exception;
use Illuminate\Support\Str;

class TaskService
{
    /** @var MerchantService $merchantService */
    private MerchantService $merchantService;

    /** @var CardService $cardService */
    private CardService $cardService;

    /** @var UserService $userService */
    private UserService $userService;

    /** @var Task $task */
    private Task $task;

    public function __construct()
    {
        $this->merchantService = new MerchantService();
        $this->cardService = new CardService();
        $this->userService = new UserService();
    }

    /**
     * @param string $uuid
     * @return array
     */
    public function listByUser(string $uuid): array
    {
        $userId = $this->userService->get($uuid, ['id'])['id'];
        $tasks = Task::query()
            ->select(
                'tasks.id',
                'cards.card_number',
                'cards.expiration_date',
                'cards.cvv',
                'cards.cardholder_name',
                'merchants.name as merchant_name',
                'tasks.type as task_type',
                'card_switches.merchant_id'
            )
            ->join('card_switches', 'card_switches.task_id', '=', 'tasks.id')
            ->join('cards', 'card_switches.new_card_id', '=', 'cards.id')
            ->join('merchants', 'card_switches.merchant_id', '=', 'merchants.id')
            ->where('tasks.user_id', $userId)
            ->where('tasks.is_finished', true)
            ->latest('tasks.created_at')
            ->get();

        return $tasks->groupBy('merchant_id')->toArray();
    }

    /**
     * @param CreateRequest $request
     * @param int $taskId
     * @return void
     */
    private function switchCards(CreateRequest $request, int $taskId): void
    {
        $previousCardId = $this->cardService->get($request->previousCardUuid, ['id'])['id'];
        $newCardId = $this->cardService->get($request->newCardUuid, ['id'])['id'];
        $merchantId = $this->merchantService->get($request->merchantUuid, ['id'])['id'];

        CardSwitch::query()->create([
            'uuid' => Str::uuid(),
            'task_id' => $taskId,
            'new_card_id' => $newCardId,
            'previous_card_id' => $previousCardId,
            'merchant_id' => $merchantId,
        ]);
    }

    /**
     * @param CreateRequest $request
     * @return void
     * @throws APIException
     */
    public function create(CreateRequest $request): void
    {
        try {
            $task = Task::query()->create([
                'user_id' => auth()->id(),
                'uuid' => Str::uuid(),
                'type' => $request->type
            ]);

            if ($request->type === 'card_switch'){
                $this->switchCards($request, $task->id);
            }
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
