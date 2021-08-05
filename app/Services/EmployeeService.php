<?php
namespace App\Services;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeService extends BaseService{

    public function create(array $attributes){
        return Employee::create($attributes);
    }

    public function index()
    {
        //return Employee::all();
        //return Employee::paginate(20);
        $query = Employee::query();

        $query->when(request()->filled('filter'),function($query){
            [$criteria,$value] = explode(':',request('filter'));
            return $query->where($criteria,$value); 
        });

        return $query->paginate(20);
    }

    public function store(Request $request)
    {   
        return Employee::create($request->all());
    }

    public function show($id)
    {
        return Employee::find($id);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->update($request->all());
        return $employee;
    }

    public function destroy($id)
    {
        Employee::destroy($id);
    }
}