<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreTicketRequest;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
class TicketController extends Controller
{
    /**
     * تأكيد تسجيل الدخول لكل طرق هذا الكنترولر
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * حجز التذاكر للحدث
     *
     * @param StoreTicketRequest $request
     * @return JsonResponse
     */
    public function store(StoreTicketRequest $request): JsonResponse
    {
        // جلب الحدث مع التذاكر المرتبطة به
        $event = Event::with('tickets')->findOrFail($request->event_id);

        // حساب التذاكر المباعة
        $soldQuantity = $event->tickets()->sum('quantity');
        $available = ($event->total_tickets ?? 0) - $soldQuantity;

        if ($available < $request->quantity) {
            return response()->json([
                'message' => "لا توجد تذاكر كافية. التذاكر المتاحة: {$available}"
            ], 400);
        }

        $tickets = [];

        // استخدام transaction لضمان atomic operation
        DB::transaction(function () use ($request, $event, &$tickets) {
            for ($i = 0; $i < $request->quantity; $i++) {
                $tickets[] = Ticket::create([
                    'event_id'    => $event->id,
                    'attendee_id' => Auth::id(),
                    'ticket_type' => $request->ticket_type,
                    'price'       => $event->ticket_price ?? 50.00,
                    'status'      => 'sold',
                    'quantity'    => 1
                ]);
            }
        });

        return response()->json([
            'message' => 'تم حجز التذاكر بنجاح ✅',
            'tickets' => $tickets
        ]);
    }
    public function index()
{
    // مثال: جلب كل الأحداث أو التذاكر
    $events = Event::with('tickets')->get();
    
    return Inertia::render('EventTickets', [
        'events' => $events
    ]);
}

}
