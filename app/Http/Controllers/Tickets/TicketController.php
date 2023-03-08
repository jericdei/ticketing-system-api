<?php

namespace App\Http\Controllers\Tickets;

use App\Models\Tickets\Ticket;
use App\Http\Controllers\Controller;
use App\Services\Common\ModelService;
use App\Services\Common\QueryService;
use App\Http\Requests\Tickets\StoreRequest;
use App\Http\Requests\Tickets\UpdateRequest;
use App\Http\Resources\Tickets\TicketResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketController extends Controller
{
    public function __construct(
        private QueryService $queryService,
        private ModelService $modelService
    ) {}

    /**
     * Get a list of tickets.
     */
    public function index(): JsonResource
    {
        return TicketResource::collection($this->queryService->getMultiple(new Ticket, request()));
    }

    /**
     * Store a newly created ticket in storage.
     */
    public function store(StoreRequest $request)
    {
        $input = $request->validated();
        $input['ticket_code'] = fake()->unique()->regexify('[A-Za-z0-9]{8}');

        $ticket = $this->modelService->storeModel(new Ticket, $input);

        return $this->sendResponseWithData('Ticket created successfully.', $this->show($ticket, request()));
    }

    /**
     * Get a specified ticket.
     */
    public function show(Ticket $ticket): JsonResource
    {
        return new TicketResource($this->queryService->getSingle($ticket, request()));
    }

    /**
     * Update the specified ticket in storage.
     */
    public function update(Ticket $ticket, UpdateRequest $request)
    {
        $ticket = $this->modelService->updateModel($ticket, $request->validated());

        return $this->sendResponseWithData('Ticket updated successfully.', $this->show($ticket, request()));
    }

    /**
     * Remove the specified ticket from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return $this->sendResponse('Ticket deleted successfully.');
    }
}
