<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Participant;

class EventController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        $events = Event::where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Events fetched successfully.',
            'data' => $events,
        ]);
    }

    /**
     * Create a new event.
     */
    public function store(Request $request): JsonResponse
    {
      $request->validate([
    'title' => 'required|string|max:255',
    'description' => 'nullable|string',
    'event_date' => 'required|date',
    'location' => 'required|string|max:255',
    'max_seats' => 'required|integer|min:1',
   'status' => 'required|in:Draft,Published,Cancelled',
]);
        $event = Event::create([
            'user_id'     => $request->user()->id,
            'title'       => $request->title,
            'description' => $request->description,
            'event_date'  => $request->event_date,
            'location'    => $request->location,
            'max_seats'   => $request->max_seats,
            'status'      => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Event created successfully.',
            'data' => $event,
        ], 201);
    }


    public function show(Event $event): JsonResponse
    {
        if ($event->user_id != auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.',
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $event,
        ]);
    }


    public function update(Request $request, Event $event): JsonResponse
    {
        if ($event->user_id != auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.',
            ], 403);
        }

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date'  => 'required|date',
            'location'    => 'required|string|max:255',
            'max_seats'   => 'required|integer|min:1',
            'status'      => 'required|in:active,inactive',
        ]);

        $event->update([
            'title'       => $request->title,
            'description' => $request->description,
            'event_date'  => $request->event_date,
            'location'    => $request->location,
            'max_seats'   => $request->max_seats,
            'status'      => $request->status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Event updated successfully.',
            'data' => $event,
        ]);
    }

    /**
     * Delete event.
     */
    public function destroy(Event $event): JsonResponse
    {
        if ($event->user_id != auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.',
            ], 403);
        }

        $event->delete();

        return response()->json([
            'success' => true,
            'message' => 'Event deleted successfully.',
        ]);
    }

    public function registerParticipant(Request $request, Event $event): JsonResponse
{
    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email',
    ]);

    // Check duplicate registration
    $exists = Participant::where('event_id', $event->id)
        ->where('email', $request->email)
        ->exists();

    if ($exists) {
        return response()->json([
            'success' => false,
            'message' => 'Participant already registered for this event.',
        ], 409);
    }

    // Check event capacity
    if ($event->participants()->count() >= $event->max_seats) {
        return response()->json([
            'success' => false,
            'message' => 'Event is full.',
        ], 400);
    }

    $participant = Participant::create([
        'event_id' => $event->id,
        'user_id'  => auth()->id(),
        'name'     => $request->name,
        'email'    => $request->email,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Participant registered successfully.',
        'data' => $participant,
    ], 201);
}
public function participants(Event $event): JsonResponse
{
    return response()->json([
        'success' => true,
        'data' => $event->participants,
    ]);
}
}