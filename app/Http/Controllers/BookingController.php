<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class BookingController extends Controller
{
    public function index(Request $request)
{
    $employeeId = Auth::guard('provider')->id(); 
    $bookings = Booking::with('client') 
                        ->select('booking_ID', 'client_ID', 'provider_ID', 'statusBooking', 'bookingDate', 'bookingTime', 'address', 'description')
                        ->where('provider_ID', $employeeId)
                        ->get(); 

    if ($request->header('X-Inertia')) {
        return Inertia::render('client/dashboard', [
            'bookings' => $bookings
        ]);
    }

    return response()->json([
        'success' => true,
        'data' => $bookings,
    ]);
}


    public function create(Request $request)
{
    // Validate incoming request data
    $request->validate([
        'client_ID' => 'required|exists:clients,client_ID',
        'provider_ID' => 'required|exists:provider,provider_ID',
        'statusBooking' => 'nullable|in:pending,completed,confirmed,declined,cancelled', 
        'bookingDate' => 'required|date_format:Y-m-d',
        'bookingTime' => 'required|date_format:H:i:s',
        'description' => 'nullable|string|max:255',
    ]);

    $statusBooking = $request->statusBooking ?: 'pending';

    $memberID = $request->member_ID;
    $employeeID = $request->employee_ID;

    $exists = DB::table('booking')
        ->where('client_ID', $clientID)
        ->where('provider_ID', $providerID)
        ->whereNotIn('statusBooking', ['completed', 'declined', 'cancelled'])
        ->exists();

    if ($exists) {
        $errorResponse = ['error' => 'Ongoing booking already exists for this client and provider.'];

        if ($request->wantsJson()) {
            return response()->json($errorResponse, 422);
        }

        return back()->withErrors($errorResponse);
    }

    $booking = Booking::saves([
        'client_ID' => $clientID,
        'provider_ID' => $providerID,
        'bookingDate' => $request->bookingDate,
        'bookingTime' => $request->bookingTime, 
        'description' => $request->description,
        'address' => $request->address,
        'statusBooking' => $statusBooking,
    ]);

    if ($request->wantsJson()) {
        return response()->json(['message' => 'Booked successfully!', 'data' => $booking], 201);
    }

    return back()->with('success', 'Booked successfully!');
}


    public function updateStatus(Request $request, $booking_ID)
    {
        $request->validate([
            'statusBooking' => 'required|in:pending,confirmed,completed,declined,cancelled',
        ]);

        $booking = Booking::where('booking_ID', $booking_ID)->firstOrFail();

        if ($booking->statusBooking === 'completed' && $request->input('statusBooking') === 'pending') {
            return response()->json(['error' => 'Cant revert booking from completed to pending.'], 400);
        }

        $booking->statusBooking = $request->input('statusBooking');
        $booking->save();

        return response()->json(['message' => 'Booking completed successfully.']);
    }


    public function getStatus($booking_ID)
    {
        $booking = Booking::find($booking_ID);
        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 404);
        }

        return response()->json(['status' => $booking->statusBooking]);
    }    

    public function confirmBooking($booking_ID)
    {

        $booking = Booking::where('booking_ID', $booking_ID)->firstOrFail();

        if ($booking->statusBooking === 'pending') {
            $booking->statusBooking = 'confirmed';  
            $booking->save();

            return response()->json(['message' => 'Booking confirmed successfully!']);
        }

        return response()->json(['error' => 'Booking cannot be confirmed as it is not in pending status.'], 400);
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        $booking->delete();

        return response()->json(['message' => 'Booking deleted successfully.']);
    }



}
