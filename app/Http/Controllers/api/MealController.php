<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        global $relations;
        global $tags;
        //http://127.0.0.1:8000/api/meal?per_page=5&tags=2&lang=hr&with=ingredients,category,tags&diff_time=1493902343&page=2
        //dd($request->all());

        //dohvat ovisnosti iz upita
        $perPage = $request['perPage'];
        $with= $request['with'];
        $lang=$request['lang'];
        $ttags=$request['tags'];
        $category=$request['category'];
        $diff_time= $request['diff_time'];

        //ako nema jezika za upit dohvati sve na HRVATSKOM
        if (empty($lang)){
            App::setLocale('hr');
        }
        else{
            App::setLocale($lang);
        }


        //ako nema broja po stranici dohvati 15
        if (empty($perPage)){
            $perPage=15;
        }

        //provjera da li u upitu postoje relacije za jela
        if (!empty($with)){
            $relations = explode(",", $with);
            //Log::alert(json_encode($relations));
        }else{
            $relations=[];
        }

        //provjera da li u upitu postoje tagovi
        if (!empty($ttags)){
            $tags = explode(",", $ttags);
            Log::alert(json_encode($tags));
        }else{
            $tags=[];
        }


       /* $meals = Meal::leftjoin('categories','categories.id','=','meals.category_id')
            ->leftjoin('meal_tags','meals.id','=','meal_tags.meal_id')
            ->where(function ($query) use($tags) {
                for ($i = 0; $i < count($tags); $i++){
                    $query->where('meal_tags.tag_id','=', $tags[$i]);
                }

            })
            ->leftjoin('tags','tags.id','=','meal_tags.tag_id')
            ->leftjoin('meal_ingredients','meals.id','=','meal_ingredients.meal_id')
            ->leftjoin('ingredients','ingredients.id','=','meal_ingredients.ingredient_id')
            ->select('meals.*')
            ->distinct('meals.id')
            ->with($relations)
            ->paginate($perPage);*/


        $meals = Meal::where(function($query) use ($with,$perPage,$tags,$category,$diff_time) {

            if(!empty($tags)){
                $query->whereHas('tags', function ($query) use ($tags) {
                   $query->whereIn('id', $tags);
                },'=', count($tags));
            }

            if(!empty($category)){
                if($category=='NULL'){
                        $query->whereNull('category_id');
                }else if($category=='!NULL'){
                        $query->whereNotNull('category_id');
                }else{
                    $query->whereHas('category', function ($query) use ($category) {
                        $query->where('id',$category);
                    });
                }
            }

            /*if(!empty($diff_time) && is_numeric($diff_time)){
                Log::alert('Usao u datum');
                $diff_time=intval($diff_time);
                //$diff_time = Carbon::createFromTimestamp($diff_time)->format('m/d/Y');
                Log::alert($diff_time);
                if ($diff_time>0){
                    $query->whereDate('created_at','>',$diff_time)
                        ->where('updated_at',function ($query) use ($diff_time) {
                            $query->where('updated_at', '>', 'created_at')
                                ->whereDate('updated_at','>' , $diff_time)
                                ->transform(function ($meal) {
                                    $meal->status = 'modified';
                                });
                        })->where('deleted_at',function ($query) use ($diff_time) {
                            $query->whereDate('deleted_at','>',$diff_time)
                                ->transform(function ($meal) {
                                    $meal->status = 'deleted';
                                });


                        });

                }
                $query->withTrashed();
            }*/


        })->with($relations)
            ->paginate($perPage);

        return $meals;


        /*all = Education::where(function($query) use ($search,$projects,$start_date,$stop_date){
            $query->whereDate('start_date',$start_date)
                ->whereDate('stop_date',$stop_date)
                ->orWhere('schedule','LIKE',"%$search%")
                ->orWhere('other_name','LIKE',"%$search%")
                ->orWhereHas('course', function ($query) use ($search) {
                    $query->where('name','LIKE',"%$search%");
                })
                ->orWhereHas('project', function ($query) use ($search,$projects) {
                    $query->whereIn('name', $projects );
                })
                ->orWhereHas('teacher', function ($query) use ($search) {
                    $query->where('name','LIKE',"%$search%")
                        ->orWhere('last_name','LIKE',"%$search%");
                })
                ->orWhereHas('children', function ($query) use ($search) {
                    $query->where('name','LIKE',"%$search%")
                        ->orWhere('last_name','LIKE',"%$search%");
                });

        })->with('course','project','teacher','children')
          //  ->orderBy($sortBy,$sortDesc)
            ->paginate($perPage);*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
