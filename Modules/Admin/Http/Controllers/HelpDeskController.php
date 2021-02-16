<?php

namespace Modules\Admin\Http\Controllers;

use App\Grids\HelpTicketsGrid;
use App\Jobs\UpdateUnreadTicketMessages;
use App\Models\HelpTicket;
use App\Models\TicketMessage;
use App\Models\Webinar\Ticket;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\StoreAdminReplyTicketRequest;

class HelpDeskController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function list(Request $request, HelpTicketsGrid $grid)
    {

        $page_title = __(' Tickets List ');

        $query = HelpTicket::query();

        return $grid
            ->create(compact('query', 'request'))
            ->renderOn('admin::grid.index', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(HelpTicket $helpticket, StoreAdminReplyTicketRequest $request)
    {
        $message = $helpticket->messages()->create([
            'body' => $request->message,
            'admin_id' => $request->user()->id
        ]);

        if ($request->has('files')) {
            $files = $request->files->get('files');

            foreach ($files as $file) {

                $message->addMedia($file)->toMediaCollection();
            }
        }

        return redirect()->route('admin.helpdesk.show', $helpticket);
    }

    /**
     * Show the specified resource.
     * @param HelpTicket $ticket
     * @return Renderable
     */
    public function show(HelpTicket $helpticket, Request $request)
    {
        $page_title = __(" Answer Ticket ");

        $new_messages = $helpticket->messages()->agentUnreadMessages()->get();

        $messages = $helpticket->messages()->with('media')->get();

        if ($new_messages->count() > 0)
            dispatch(new UpdateUnreadTicketMessages(
                $helpticket,
                $request->user()
            ));

        return view("admin::helpdesk.show", compact("page_title", "messages", "helpticket", "new_messages"));
    }
}
