<?php

namespace App\Http\Controllers\Tickets;

use Illuminate\Http\Request;
use App\Models\Tickets\Ticket;
use App\Http\Controllers\Controller;
use App\Services\Common\ModelService;
use App\Services\Common\QueryService;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
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
