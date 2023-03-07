<?php

namespace App\Http\Controllers\Tickets;

use Illuminate\Http\Request;
use App\Models\Tickets\Ticket;
use App\Http\Controllers\Controller;
use App\Services\Common\ModelService;
use App\Services\Common\QueryService;
use App\Http\Requests\Tickets\StoreRequest;
use App\Http\Resources\Tickets\TicketResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketController extends Controller
{
    public function __construct(
        private QueryService $queryService,
        private ModelService $modelService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResource
    {
        return TicketResource::collection($this->queryService->getMultiple(new Ticket, $request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $input = $request->validated();
        $input['ticket_code'] = fake()->unique()->regexify('[A-Za-z0-9]{8}');

        $ticket = $this->modelService->storeModel(new Ticket, $input);

        return $this->sendResponseWithData('Ticket created successfully.', $this->show($ticket, request()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket, Request $request): JsonResource
    {
        return new TicketResource($this->queryService->getSingle($ticket, $request));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
