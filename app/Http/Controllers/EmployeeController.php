<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ResponseController;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\DB;
class EmployeeController extends Controller
{

    const employees = "employees";

    function EmployeePage(){
        return view('pages.employee');
    }

    function GetAll(){
        return $this->Employees();
    }

    function Create(EmployeeRequest $request){
        $request->merge(['emp_id' => $this->EmployeeID()]);
        $res = Employee::insert($request->all());
        if($res){
            return response(ResponseController::Reponse('employee inserted successfully'), 200);
        }
        else{
            return response(ResponseController::Reponse('employee inserted failed'), 500);
        }
    }

    function Update(Request $request){
        $request->merge(['updated_at' => Carbon::now()]);
        $res = DB::table(self::employees)->where('emp_id', $request->emp_id)->update($request->except('emp_id'));
        if($res){
            return response(ResponseController::Reponse('employee updated successfully'), 200);
        }
        else{
            return response(ResponseController::Reponse('employee updated failed'), 500);
        }
    }

    function GetSingle(Request $request){
        $emp_id = $request->get('emp_id');
        return DB::table(self::employees)->where('emp_id', $emp_id)->first();
    }

    function PaymentInfo(Request $request){
        $emp_id = $request->get('emp_id');
        $employee = $this->Employees($emp_id)->first();

        $joining_date = $employee->joining_date;

        $pay_salary_info =  DB::table('payment_salary')->
        where('emp_id', $emp_id)->
        whereYear('pay_date', date('Y'))->
        whereMonth('pay_date', date('m'));



    }


    function Employees($emp_id = null){
        $employees_data =  DB::table('employees as e')->
        join('emp_per_day_salary as eps', 'e.emp_id', '=', 'eps.emp_id')->
        leftJoin('emp_monthly_salary_info as esi', function($join){
            $join->on('esi.emp_id', '=', 'e.emp_id')->
            where('esi.pay_month', '=', date('Y-m'));
        });
        if($emp_id){
            $employees_data = $employees_data->where('e.emp_id', $emp_id);
        }
        return $employees_data->get([
            'e.id',
            'e.emp_id',
            'e.name',
            'e.phone',
            'e.address',
            'e.basic_salary',
            'e.joining_date',
            'eps.day_salary',
            DB::raw('ifnull(esi.pay_month, "-") as pay_month'),
            DB::raw('ifnull(esi.amount, 0) as amount'),
            DB::raw('ifnull(esi.present, 0) as present')
        ]);

    }



    function Delete(Request $request){
        $emp_id = $request->get('emp_id');
        $res = DB::table(self::employees)->where('emp_id', $emp_id)->delete();
        if($res){
            return response(ResponseController::Reponse('employee deleted successfully'), 200);
        }
        else{
            return response(ResponseController::Reponse('employee deleted failed'), 500);
        }
    }

    function EmployeeID(){
        return "emp".strtotime('now');
    }
}
