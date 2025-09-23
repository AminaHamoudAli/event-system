<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function stats()
    {
        // عدد الأحداث
        $eventsCount = Event::count();

        // عدد التذاكر المباعة
        $ticketsSold = Order::sum('quantity');

        // إجمالي الإيرادات
        $revenue = Order::sum('total');

        // عدد المستخدمين حسب الدور
        $usersByRole = User::selectRaw('role, COUNT(*) as count')
            ->groupBy('role')
            ->pluck('count', 'role');

        // التذاكر المتاحة لكل حدث
        $ticketsAvailable = Event::with('tickets')->get()->map(function($event) {
            $available = $event->tickets->sum(function($ticket) {
                return $ticket->quantity - $ticket->orders()->sum('quantity');
            });
            return [
                'event_id' => $event->id,
                'title' => $event->title,
                'available_tickets' => $available
            ];
        });

        // آخر الطلبات
        $latestOrders = Order::with('user', 'ticket.event')
            ->latest()
            ->take(5)
            ->get();

        return response()->json([
            'events_count' => $eventsCount,
            'tickets_sold' => $ticketsSold,
            'revenue' => $revenue,
            'users_by_role' => $usersByRole,
            'tickets_available' => $ticketsAvailable,
            'latest_orders' => $latestOrders
        ]);
    }
      public function advancedStats()
    {
        $events = Event::with('tickets.orders')->get();

        $data = $events->map(function($event) {
            $ticketsSold = $event->tickets->sum(function($ticket) {
                return $ticket->orders->sum('quantity');
            });

            $revenue = $event->tickets->sum(function($ticket) {
                return $ticket->orders->sum(function($order) use ($ticket) {
                    return $order->quantity * $ticket->price;
                });
            });

            return [
                'event' => $event->title,
                'tickets_sold' => $ticketsSold,
                'revenue' => $revenue,
            ];
        });

        return response()->json($data);
    }

}
