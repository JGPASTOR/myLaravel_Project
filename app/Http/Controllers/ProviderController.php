<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Service;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;

class ProviderController extends Controller
{
    public function providerDashboard(Request $request): Response
    {
          if(Auth::id())
          {

          $userid=Auth::user()->id;
          $serviceCount = Service::where('provider_id', $userid)->count();
          $bookingCount = Booking::where('service_user_id', $userid)->count();
          
          return inertia('provider/dashboard', [
            'serviceCount' => $serviceCount,
            'bookingCount' => $bookingCount,
          ]);
  
          }
          
          else
          {
              return redirect()->back();
          }
    }

    public function providerProfile(Request $request): Response
    {
      
          
          return inertia('provider/profile', [
            
          ]);
    }

    public function providerService(Request $request): Response
    {
      
          if(Auth::id())
          {
             
          $userid=Auth::user()->id;
          $services = Service::where('provider_id', $userid)->get();
          return inertia('provider/service', [
            'services' => $services,
          ]);
  
          }
          
          else
          {
              return redirect()->back();
          }
    }

    public function saveService(Request $request)
    {
        $request->validate([
            'image' => 'required',
            'title' => 'required',
            'price' => 'required',
          
        ]);

        $user = Auth::user();

        $service = new Service;

        $image = $request->image;

        $imagename = time() . '.' . $image->getClientOriginalExtension();

        $request->image->move('serviceImage', $imagename);
        $service->image = $imagename;


        $service->provider_id = $user->id;
        $service->provider_name = $user->name;
        $service->provider_phone = $user->contactNumber;
        $service->provider_address = $user->address;
        
        $service->title = $request->title;
        $service->price = $request->price;
        
        $service->save();

        return redirect()->route('provider.service');
    }

    public function updateService(Request $request, Service $service): RedirectResponse
    {

        $request->validate([
  
            'title' => 'required',
            'price' => 'required',
        
        ]);

        $service->title = $request->title;
        $service->price = $request->price;

        if ($request->hasFile('image')) {

            if ($service->image && file_exists(public_path('serviceImage/' . $service->image))) {
                unlink(public_path('serviceImage/' . $service->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('serviceImage'), $imageName);
            $service->image = $imageName;
        }

        $service->save();

        return redirect()->route('provider.service');
    }

    public function deleteService(Service $service): RedirectResponse
    {

        if ($service->image && file_exists(public_path('serviceImage/' . $service->image))) {
            unlink(public_path('serviceImage/' . $service->image));
        }

        $service->delete();


        return to_route('provider.service');
    }

    public function pbooking(Request $request): Response
    {

          if(Auth::id())
          {
            
          $userid=Auth::user()->id;
          $bookings = Booking::where('service_user_id', $userid)->get();
          return inertia('provider/booking', [
            'bookings' => $bookings,
          ]);
  
          }
          
          else
          {
              return redirect()->back();
          }
    }

    public function pongoing(Request $request): Response
    {
        if(Auth::id())
        {
          
        $userid=Auth::user()->id;
        $bookings = Booking::where('service_user_id', $userid)->get();
        return inertia('provider/ongoing', [
          'bookings' => $bookings,
        ]);

        }
        
        else
        {
            return redirect()->back();
        }

    }

    public function pcompleted(Request $request): Response
    {
      
        if(Auth::id())
        {
          
        $userid=Auth::user()->id;
        $bookings = Booking::where('service_user_id', $userid)->get();
        return inertia('provider/completed', [
          'bookings' => $bookings,
        ]);

        }
        
        else
        {
            return redirect()->back();
        }
    }
    public function pdeclined(Request $request): Response
    {

        if(Auth::id())
        {
          
        $userid=Auth::user()->id;
        $bookings = Booking::where('service_user_id', $userid)->get();
        return inertia('provider/declined', [
          'bookings' => $bookings,
        ]);

        }
        
        else
        {
            return redirect()->back();
        }

      
          return inertia('provider/declined', [
             
          ]);
    }

    public function acceptBooking(Request $request, Booking $booking): RedirectResponse
    {
        $booking->status = 'accepted';
        $booking->save();
        return redirect()->route('provider.ongoing');
    }

    public function declineBooking(Request $request, Booking $booking): RedirectResponse
    {
        $booking->status = 'declined';
        $booking->save();
        return redirect()->route('provider.declined');
    }


    public function providerCompletedBooking(Booking $booking)
    {
        $booking->status = 'completed';
        $booking->save();

        return redirect()->route('provider.completed');
    }

    public function reports()
    {
        $providerId = auth()->user()->id; 

        $bookings = Booking::where('service_user_id', $providerId)
                           ->orderBy('created_at', 'desc')
                           ->get();

        return Inertia::render('provider/report', [
            'bookings' => $bookings,
        ]);
    }
}

