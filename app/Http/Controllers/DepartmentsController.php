<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;

use DB;
use App\Models\Department;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::paginate(5);

        return view('department.index', ['departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $validated = $request->validated();

        Department::create($validated);

        return response()->json(['status' => 'Success.'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        // RAW SQL VERSION (START) //
        $employees = DB::select("
            SELECT employees.* 
            FROM employees
            JOIN departments ON employees.department_id = departments.id
            WHERE employees.deleted_at IS NULL AND
            departments.id = ?", [$department->id]);

        $employees = collect($employees);
        // RAW SQL VERSION (END) //
        
        // ELOQUENT VERSION (START) //
        /*
        $employees = Employee::join('departments', 'employees.department_id', '=', 'departments.id')
            ->where('departments.id', $departmentId)
            ->select('employees.*') 
            ->get();
        */
        // ELOQUENT VERSION (END) //

        return view('department.show', [
            'department' => $department,
            'employees' => $employees
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return response()->json($department, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $validated = $request->validated();

        $department->update($validated);

        return response()->json(['status' => 'Success.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return response()->json(['status' => 'Success.'], 200);
    }
}
