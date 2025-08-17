<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\PostionAndPromotion;
use Illuminate\Http\Request;

class StaffBioController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function getPositionAndPromotions (Request $request){

        $table = "";

        if(PostionAndPromotion::where('user_id',$request->user_id)->get()->count() > 0){

            $data = PostionAndPromotion::where('user_id',$request->user_id)->get();

            $table .= '<table id="example1" class="table table-bordered"> <tbody> <tr> <td align="center">Date</td> <td align="center">Type</td><td align="center">Grade</td> </tr>';

            foreach ($data as $promotionUserListItem) {

                $table .= '<tr>';

                $table .= '<td  align="center">'.date('jS F Y',strtotime($promotionUserListItem->date)).'</td>';

                $table .= '<td align="center">'.$promotionUserListItem->getTypeName().'</td>';

                $table .= '<td align="center">'.$promotionUserListItem->getGrade().'</td>';

                $table .= '</tr>';
                
            }



            $table .= '</tbody></table>';

            return $table;


        }else{

            return "empty";
        }

    }
}
