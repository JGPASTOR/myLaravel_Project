<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Category;
use App\Models\Service;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function welcome(Request $request): Response
    {
        $categories = Category::all();
        $services = Service::all();
        return inertia('Welcome', [
            'categories' => $categories,
            'services' => $services,
        ]);
    }

    public function clientServiceBooking(Service $service): Response
    {
        return Inertia::render('servicebooking', [
            'service' => $service,
        ]);
    }

    public function clientCategories(Request $request): Response
    {
        $categories = Category::all();
        return inertia('client/categories', [
            'categories' => $categories,
        ]);
    }

    public function clientServices(Request $request): Response
    {
        $services = Service::all();
        return inertia('client/services', [
            'services' => $services,
        ]);
    }

    public function clientDashboard(Request $request): Response
    {
        $categories = Category::all();
        $services = Service::all();
        return inertia('client/dashboard', [
            'categories' => $categories,
            'services' => $services,
        ]);
    }

    public function clientProfile(Request $request): Response
    {
        return inertia('client/profile', []);
    }

    public function clientBooking(Request $request): Response
    {
       
       
    }

    public function pending(Request $request): Response
    {
        $bookings = Booking::where('user_id', Auth::id())->where('status', 'pending')->get();
        return inertia('client/pending', [
            'bookings' => $bookings,
        ]);
    }

    public function ongoing(Request $request): Response
    {
        $bookings = Booking::where('user_id', Auth::id())->where('status', 'accepted')->get();
        return inertia('client/ongoing', [
            'bookings' => $bookings,
        ]);
    }

    public function completed(Request $request): Response
    {
        $bookings = Booking::where('user_id', Auth::id())->where('status', 'completed')->get();
        return inertia('client/completed', [
            'bookings' => $bookings,
        ]);
    }

    public function declined(Request $request): Response
    {
        $bookings = Booking::where('user_id', Auth::id())->where('status', 'declined')->get();
        return inertia('client/declined', [
            'bookings' => $bookings,
        ]);
    }

    public function confirmBook($service)
    {
        $service = Service::findOrFail($service);
        return inertia('confirm_booking', [
            'service' => $service,
        ]);
    }

    public function bookService(Request $request, Service $service)
    {
        $request->validate([
            'date' => 'required',
            'time' => 'required',
            'message' => 'required',
        ]);

        $user = Auth::user();

        $booking = new Booking();
        $booking->user_id = $user->id;
        $booking->client_name = $user->name;
        $booking->client_phone = $user->contactNumber;
        $booking->service_id = $service->id;
        $booking->status = 'pending';

        $booking->date = $request->date;
        $booking->time = $request->time;
        $booking->message = $request->message;

        $booking->service_user_id = $service->provider_id;
        $booking->service_user_name = $service->provider_name;
        $booking->service_user_phone = $service->provider_phone;
        $booking->service_user_address = $service->provider_address;
        $booking->service_user_image = $service->image;
        $booking->service_user_title = $service->title;
        $booking->service_user_price = $service->price;

        $booking->save();

        $service->status = 'booked';
        $service->save();

        return redirect()->route('client.booking');
    }

    public function cancelBooking(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('client.dashboard');
    }

    public function completedBooking(Booking $booking)
    {
        $booking->status = 'completed';
        $booking->save();

        return redirect()->route('client.completed');
    }



}
