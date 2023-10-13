<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeHistory;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employees = Employee::where('user_id',auth()->user()->id)->latest()->get();
        return view('home',compact('employees'));
    }
    public function get_history($id){
        $employees = EmployeeHistory::where('emp_id',$id)->latest()->get();
        $emp_id = $id;
        return view('history',compact('employees','emp_id'));
    }
    public function post_history(Request $request){
        dd($request->all());
        foreach ($request->company as $key => $value) {
            $net_salary = $value['salary'] - (($value['salary'] * $value['tax']) /100) ;

            EmployeeHistory::create([
                'company_name'  => $value['company_name'],
                'country_name'  => $value['country_name'],
                'company_email'  => $value['company_email'],
                'company_contact'  => $value['company_contact'],
                'company_department'  => $value['company_department'],
                'job_title'     => $value['job_title'],
                'salary'        => $value['salary'],
                'tax_dec'       => $value['tax'],
                'net_salary'    => $net_salary,
                'emp_id'        => $request->emp_id,
            ]);
        }
        return redirect()->back();
    }
    public function edit_history($id){

        $employ = EmployeeHistory::find($id);
        return view('edit_history',compact('employ'));
    }
    public function update_history(Request $request, $id){

        $employ= EmployeeHistory::find($id);
        $net_salary = $request->salary - (($request->salary * $request->tax) /100) ;

        EmployeeHistory::where('id',$id)->update([
            'company_name'  => $request->company_name,
            'country_name'  => $request->country_name,
            'job_title'     => $request->job_title,
            'company_contact'     => $request->company_contact,
            'company_email'     => $request->company_email,
            'salary'        => $request->salary,
            'tax_dec'       => $request->tax,
            'net_salary'    => $net_salary,

        ]);
        return redirect()->route('get_history',$employ->emp_id);
    }
    public function delete_history($id){

        $employ= EmployeeHistory::find($id);
        if(!empty($employ)){
            $employ->delete();
        }
        return redirect()->back();
    }
}
