<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LiveSearch extends Controller
{
    function index()
    {
     return view('search');
    }

    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('user')
         ->where('name', 'like', '%'.$query.'%')
         ->orWhere('fk_department', 'like', '%'.$query.'%')
         ->orWhere('fk_designation', 'like', '%'.$query.'%')
         ->get();
         
      }
       else{
             $data = DB::table('department')
                 ->orderBy('id', 'desc')->get();
       }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
         <td><h3>'.$row->name.'</h3>
         <h4>'.$row->fk_department.'</h4>
         <h5>'.$row->fk_designation.'</h5>
         </td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }
}

