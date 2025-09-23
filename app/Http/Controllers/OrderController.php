<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Notifications\TicketPurchased;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * إنشاء طلب شراء تذاكر.
     */
public function index()
{
    return response()->json(
        Order::with(['user', 'ticket.event'])->get()
    );
}

    //  public function index()
    // {
        
    //     return Inertia::render('Orders/Index'); // يطابق resources/js/Pages/Orders/Index.vue
    // }
    public function store(Request $request)
    {
        // التحقق من صحة البيانات
        $validated = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'quantity'  => 'required|integer|min:1',
        ]);

        $ticket = Ticket::findOrFail($validated['ticket_id']);

        // حساب التذاكر المتاحة
        $soldQuantity = $ticket->orders()->sum('quantity');
        $available = $ticket->quantity - $soldQuantity;

        if ($available < $validated['quantity']) {
            return response()->json([
                'success' => false,
                'message' => "Not enough tickets available. Only {$available} left."
            ], 400);
        }

        // إنشاء الطلب
        $order = Order::create([
            'user_id'   => auth()->id(),
            'ticket_id' => $ticket->id,
            'quantity'  => $validated['quantity'],
            'total'     => $ticket->price * $validated['quantity'],
        ]);

        // إنشاء ملف PDF للتذكرة
        $pdf = Pdf::loadView('pdf.ticket', compact('order', 'ticket'));
        $pdfPath = 'tickets/order_' . $order->id . '.pdf';
        $pdf->save(storage_path('app/public/' . $pdfPath));

        // تخزين مسار ملف PDF في الطلب
        $order->update(['pdf_path' => $pdfPath]);

        // إرسال إشعار البريد بعد إنشاء الطلب
        $order->user->notify(new TicketPurchased($order));

        // إرجاع استجابة JSON احترافية
        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'order'   => $order,
            'pdf_url' => asset('storage/' . $pdfPath)
        ]);
    }
}
