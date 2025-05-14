<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
// use App\Http\Requests\Request;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Specialization;
use Illuminate\Support\Facades\DB;
use App\Models\Pharma;
use App\Models\Category;




class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Admin::withTrashed()
        ->when($request->search, function($query, $search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        })
        ->when($request->status == 'archived', function($query) {
            $query->onlyTrashed();
        })
        ->when($request->status == 'active', function($query) {
            $query->whereNull('deleted_at');
        })
        ->when($request->status == 'super_admin', function($query) {
            $query->where('role', 'super_admin')->whereNull('deleted_at');
        })
        ->when($request->status == 'admin', function($query) {
            $query->where('role','admin')->whereNull('deleted_at');
        })
        ->orderBy('deleted_at')
        ->orderBy('id', 'desc');

    $admins = $query->paginate(10);

    return view('admin.admins', compact('admins'));
}



    public function create()
    {

    }





    public function show(Admin $admin)
    {

    }


    public function edit(Admin $admin)
    {

    }

    public function update(Request $request, Admin $admin)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:admins,email,'.$admin->id,
        'password' => 'nullable|min:6|confirmed', // Make password optional
        'phone' => 'nullable|string|max:20',
        'role' => 'required',
    ]);

    // Prepare the update data
    $updateData = [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'role' => $request->role,
    ];

    // Only update password if it was provided
    if ($request->filled('password')) {
        $updateData['password'] = bcrypt($request->password);
    }

    // Update the admin
    $admin->update($updateData);

    return back()->with('success', 'Admin updated successfully');
}


    public function destroy(Admin $admin)
    {
        // dd($admin->id);
        $admin->delete();
        return redirect()->back()->with('success','Admin deleted successfully');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'role' => 'required', // Ensure permissions is an array
        ]);

        // Create the admin
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash the password
            'phone' => $request->phone,
            'role' => $request->role,
        ]);

        return redirect()->route('admins.index')->with('success', 'Admin created successfully.');
    }

    public function chart()
    {
        // Total counts
        $totalUsers = User::count();
        $totalDoctors = Doctor::count();
        $totalSpecializations = Specialization::count();
        $totalAppointments = Appointment::count();
        $totalMedicines = Pharma::count();
        $totalCategories = Category::count();

        // Pie Chart: Doctors by specialization
        $specializationCounts = Specialization::withCount('doctors')
            ->get()
            ->map(function ($specialization) {
                return [
                    'name' => $specialization->name,
                    'count' => $specialization->doctors_count,
                ];
            });

        // Horizontal Bar Chart: Top 5 specializations with the most doctors
        $topSpecializations = Specialization::withCount('doctors')
            ->orderByDesc('doctors_count')
            ->take(5)
            ->get()
            ->map(function ($specialization) {
                return [
                    'name' => $specialization->name,
                    'count' => $specialization->doctors_count,
                ];
            });

        // إضافة إحصائيات الأدوية حسب التصنيف
        $medicinesByCategory = Category::withCount('pharma')
            ->get()
            ->map(function ($category) {
                return [
                    'name' => $category->name,
                    'count' => $category->pharma_count,
                ];
            });

        // Pass all data to the view
        return view('admin.chart', compact(
            'totalUsers',
            'totalDoctors',
            'totalSpecializations',
            'totalAppointments',
            'totalMedicines',
            'totalCategories',
            'specializationCounts',
            'topSpecializations',
            'medicinesByCategory'
        ));
    }

}
