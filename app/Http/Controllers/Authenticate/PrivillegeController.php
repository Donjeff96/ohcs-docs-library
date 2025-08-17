<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use App\Models\UserCategory;
use App\Models\UserCatLink;
use App\Models\UserLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrivillegeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){

        $userCatList = UserCategory::get();

        $parents = array();
        $child = array();

        $activeLinks = UserLink::where('status' ,'Active')->get();


        foreach ($activeLinks as $r_links) {
            if ($r_links->link_parent == 0) {

                $parents[] = $r_links;
               
            } else {

                $child[] = $r_links;
            }
        }
        
        return view('user.assign_ privilege',[
            'userCatList' => $userCatList,
            'activeLinks' => $activeLinks,
            'parents' => $parents,
            'child' => $child
        ]);
        
    }

    public function getPrivi(Request $request){

        $userCat = $request->category;
        $links = DB::select('SELECT user_links.id, user_links.page_id, user_links.link_url, user_links.link_name, user_links.link_image, user_links.link_parent FROM user_cat_links INNER JOIN user_links ON user_cat_links.link_id = user_links.id WHERE user_cat_links.cat_id = :id ORDER BY user_links.link_name ASC',['id' => $userCat]);

        $child = array();

        if(!empty($links)){

            foreach($links as $row_links){
    
                if($row_links->link_parent > 0){
    
                    $child[] = $row_links;
    
                }
            }
    
         }

         $t_link = UserCatLink::where('cat_id',$userCat)->get();

         $mylinks = [];

         foreach($t_link as $tt){

            $mylinks[] = $tt->link_id;

        }

         $all_links = UserLink::where('status','Active')->get();

        $main = array();
        $children = array();

         foreach($all_links as $r_links){

            if($r_links->link_parent == 0){
                $main[] = $r_links;
            }else{
                $children[] = $r_links;
            }
        }

    
        $privlist = "";

        $privlist .= "<table class='table table-striped table-bordered' style='width:100%'>";
        foreach($main as $mainlink){
            $privlist .= "<tr>
                <td colspan='2'><h7><strong>".$mainlink->link_name."</strong></h7></td>
            </tr>";
            foreach($children as $subs){ if($mainlink->id==$subs->link_parent){

                $privlist .="<tr>
                   <td class=\"text-center\" style=\"width: 60px;\"><input type=\"checkbox\" name=\"priv_check[]\" id=\"priv_check\" value=\"".$subs->id."\" "; if(in_array($subs->id,$mylinks)){ $privlist .="checked";}
                $privlist .="></td>
                   <td>". $subs->link_name."</td>
               </tr>";
               }
            }
             
         }
        $privlist .="</table>";

        return $privlist;

       

    }

    public function savePrivi (Request $request){

        if(!empty($request->priv_check)){

            $usercategory = $request->category;

            UserCatLink::where('cat_id', $usercategory)->delete();

            foreach ($request->priv_check as $r) {

                $sql = DB::insert('insert into user_cat_links (link_id, cat_id) values (?, ?)', [$r, $usercategory]);

            }


            $link = DB::select('SELECT DISTINCT(user_links.link_parent) FROM user_links
            JOIN user_cat_links ON user_links.id = user_cat_links.link_id
            WHERE user_cat_links.cat_id =:id',['id' => $usercategory]);

            foreach ($link as $r_two) {

                $sql_two = DB::insert('insert into user_cat_links (link_id, cat_id) values (?, ?)', [$r_two->link_parent, $usercategory]);

            }

            if($sql==true && $sql_two==true){

                return "ok";

            }else{

                return "fail";

            }

            
        }else{

            return "unchecked";
        }

           

    }


}
