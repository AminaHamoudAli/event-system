<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;
class EventController extends Controller
{


// public function store(Request $request)
// {
//     $data = $request->validate([
//         'title' => 'required|string|max:255',
//         'location' => 'required|string|max:255',
//         'start_date' => 'required|date',
//         'end_date' => 'required|date|after_or_equal:start_date',
//         'description' => 'nullable|string',
//     ]);

//     $data['organizer_id'] = auth()->id(); // إذا لديك تسجيل دخول
//     $event = Event::create($data);

//     return response()->json($event, 201);
// }
public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'description' => 'nullable|string',
    ]);

    // إذا كان organizer_id موجود، يمكنك تعيينه هنا
    // $validated['organizer_id'] = auth()->id();

    $event = Event::create($validated);

    return response()->json($event);
}



// public function index()
// {
//     $events = Event::all()->map(function($e){
//         return [
//             'id' => $e->id,
//             'title' => $e->title,
//             'location' => $e->location,
//             'start_date' => Carbon::parse($e->start_date)->format('Y-m-d'),
//             'end_date' => Carbon::parse($e->end_date)->format('Y-m-d'),
//             'description' => $e->description,
//         ];
//     });

//     return response()->json($events);
// }
public function index()
{
    $events = Event::all();
    return response()->json($events);
}



// public function index()
// {
//     // $events = Event::with('organizer')->get();
//     // return Inertia::render('Events/Index', ['events' => $events]);
//     // return Inertia::render('Events/Index');

//     $events = Event::all(); // أو Event::with('organizer')->get();
//     return response()->json($events);


// }

public function show($id)
{
    $event = Event::with('organizer', 'tickets', 'files')->findOrFail($id);
    return Inertia::render('Events/Show', ['event' => $event]);
}

    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     // // إرجاع جميع الأحداث بصيغة JSON
    //     // $events = Event::with('organizer')->get(); // مع تحميل بيانات المنظم
    //     // return response()->json($events);
    //           // جلب كل الفعاليات مع بيانات المنظم
    //     $events = Event::with('organizer')->get();
    //     return response()->json($events);
    // }



    

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date',
    //         'organizer_id' => 'required|exists:users,id',
    //         'location' => 'nullable|string',
    //     ]);

    //     $event = Event::create($validated);

    //     return response()->json($event, 201);
    // }
//     public function store(Request $request)
// {
//     $data = $request->validate([
//         'title' => 'required|string|max:255',
//         'location' => 'required|string|max:255',
//         'start_date' => 'required|date',
//         'end_date' => 'required|date|after_or_equal:start_date',
//         'description' => 'nullable|string',
//     ]);
//    // ضع المنظم تلقائيًا
//     $data['organizer_id'] = auth()->id();

//     $event = Event::create($data);
   

//     return response()->json($event, 201);
// }


    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $event = Event::with('organizer')->findOrFail($id);
    //     return response()->json($event);
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date',
            'organizer_id' => 'sometimes|exists:users,id',
            'location' => 'nullable|string',
        ]);

        $event->update($validated);

        return response()->json($event);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json(['message' => 'Event deleted successfully']);
    }
    public function __invoke()
{
    // هنا ترجع view أو json
}
public function storeForEvent(Request $request, Event $event)
{
    $data = $request->validate([
        'ticket_type' => 'required|string|max:255',
        'price'       => 'required|numeric|min:0',
        'quantity'    => 'required|integer|min:1',
    ]);

    $ticket = $event->tickets()->create($data);

    return response()->json($ticket, 201);
}


}
