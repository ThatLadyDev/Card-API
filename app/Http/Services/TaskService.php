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
    private MerchantService $merchantService;

    private CardService $cardService;

    private UserService $userService;

    private Task $task;

    public function __construct()
    {
        $this->merchantService = new MerchantService();
        $this->cardService = new CardService();
        $this->userService = new UserService();
    }

    /**
     * @param string $uuid
     *
     * @return string[]
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
     * @throws APIException
     */
    public function create(CreateRequest $request): void
    {
        try {
            $task = Task::query()->create([
                'user_id' => auth()->id(),
                'uuid' => Str::uuid(),
                'type' => $request->getType(),
            ]);

            if ($request->getType() === 'card_switch') {
                $this->switchCards($request, $task->id);
            }
        } catch (Exception $e) {
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
        } catch (Exception $e) {
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
        } catch (Exception $e) {
            throw new APIException($e->getMessage());
        }
    }

    private function switchCards(CreateRequest $request, int $taskId): void
    {
        $previousCardId = $this->cardService->get($request->getPreviousCardUuid(), ['id'])['id'];
        $newCardId = $this->cardService->get($request->getNewCardUuid(), ['id'])['id'];
        $merchantId = $this->merchantService->get($request->getMerchantUuid(), ['id'])['id'];

        CardSwitch::query()->create([
            'uuid' => Str::uuid(),
            'task_id' => $taskId,
            'new_card_id' => $newCardId,
            'previous_card_id' => $previousCardId,
            'merchant_id' => $merchantId,
        ]);
    }
}
