<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\User;
use App\Models\Category;
use App\Models\Service;
use App\Models\Booking;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;

class AdminController extends Controller
{
    public function adminDashboard(Request $request): Response
    {
        // Calculate the stats
        $stats = [
            ['number' => User::where('role', 'client')->count(), 'label' => 'Total Clients'],
            ['number' => User::where('role', 'provider')->count(), 'label' => 'Total Service Providers'],
            ['number' => Category::count(), 'label' => 'Categories'],
            ['number' => Service::count(), 'label' => 'Services'],
            ['number' =>Booking::count(), 'label' => 'Bookings'],
        ];
    
        // Return the stats to the Inertia view
        return inertia('admin/dashboard', [
            'stats' => $stats,
        ]);
    }
    
    public function adminProfile(Request $request): Response
    {
      
          // Return the schedules to the Inertia view
          return inertia('admin/profile', [

          ]);
    }

    public function index(Request $request): Response
        {
            return Inertia::render('admin/home');
        }

        public function booking()
        {
            $categories = Booking::all();
            return Inertia::render('admin/bookings', [
                'bookings' => $categories,
            ]);
        }


        public function services()
        {
            

            $categories = Category::all();
            return Inertia::render('admin/serviceCategories', [
                'categories'=> $categories
            ]);
        }

        public function saveCategory(Request $request)
        {
            $request->validate([
                'image' => 'required',
                'title' => 'required',
                'description' => 'required',
            
            ]);
    
            $categories = new Category;
    
            $image = $request->image;
    
            $imagename = time() . '.' . $image->getClientOriginalExtension();
    
            $request->image->move('categoriesImage', $imagename);
            $categories->image = $imagename;
    
            $categories->title = $request->title;
            $categories->description = $request->description;

            $categories->save();
    
    
            return redirect()->route('admin.servicecategories');
        }

        public function updateCategory(Request $request, Category $category): RedirectResponse
        {
    
            $request->validate([
      
                'title' => 'required',
                'description' => 'required',
    
            ]);
    
    
            $category->title = $request->title;
            $category->description = $request->description;
    
            if ($request->hasFile('image')) {
    
                if ($category->image && file_exists(public_path('categoriesImage/' . $category->image))) {
                    unlink(public_path('categoriesImage/' . $category->image));
                }
    
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('categoriesImage'), $imageName);
                $category->image = $imageName;
            }
    
    
            $category->save();
    
            return redirect()->route('admin.servicecategories');
        }
    
        public function deleteCategory(Category $category): RedirectResponse
        {
    
            if ($category->image && file_exists(public_path('categoriesImage/' . $category->image))) {
                unlink(public_path('categoriesImage/' . $category->image));
            }
    
            $category->delete();
    
    
            return to_route('admin.servicecategories');
        }
    
    
        public function userManagement()
        {
            $users = User::all();
            return Inertia::render('admin/userManagement', [
                'users' => $users,
            ]);

        }

        public function saveClient(Request $request)
        {
            $request->validate([
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
                'password' => 'required',
            ]);
            $user = User::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'role' => 'client',
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('admin.user');

        }

        public function updateClient(User $user)
        {
            request()->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'name' => 'required',
                'email' => 'required|unique:users,email,' . $user->id,
            ]);
    
    
            $user->update([
                'firstName' => request('firstName'),
                'lastName' => request('lastName'),
                'name' => request('name'),
                'email' => request('email'),
                'role' => 'client',
                'password' => request('password') ? bcrypt(request('password')) : $user->password,
            ]);
            return redirect()->route('admin.user');
        }

        public function deleteClient(User $user)
        {
            $user->delete();
            return redirect()->route('admin.user');
        }  

        public function serviceProvider()
        {
            $users = User::all();
            return Inertia::render('admin/serviceProvider', [
                'users' => $users,
            ]);
        }

        public function saveProvider(Request $request)
        {
            $request->validate([
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
                'contactNumber' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'password' => 'required',
            ]);
            $user = User::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'role' => 'provider',
                'contactNumber' => $request->contactNumber,
                'address' => $request->address,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('admin.serviceprovider');

        }
        public function updateProvider(User $user)
        {
            request()->validate([
                'firstName' => 'required',
                'lastName' => 'required',
                'name' => 'required',
                'email' => 'required|unique:users,email,' . $user->id,
                'contactNumber' => 'required',
                'address' => 'required',
            ]);
    
    
            $user->update([
                'firstName' => request('firstName'),
                'lastName' => request('lastName'),
                'name' => request('name'),
                'email' => request('email'),
                'role' => 'provider',
                'password' => request('password') ? bcrypt(request('password')) : $user->password,
                'contactNumber' => request('contactNumber'),
                'address' => request('address'),
            ]);
            return redirect()->route('admin.serviceprovider');
        }

        public function deleteProvider(User $user)
        {
            $user->delete();
            return redirect()->route('admin.serviceprovider');
        }  
        public function deleteBooking($id)
        {
            $booking = Booking::findOrFail($id);
            $booking->delete();
            return redirect()->route('admin.deletebooking');
        }
}

