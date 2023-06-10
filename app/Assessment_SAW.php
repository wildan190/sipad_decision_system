<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessment_SAW extends Model
{
    //
    protected $guarded = [];
    
    public static function getMaxMin($criterias){
        $arr=[];
        foreach ($criterias as $key => $criteria) {
        $decoded = json_decode($criteria->saw,true);
        $arr[$criteria['criteria_code']]=[
        'name'=>$criteria['name'],
        'type'=>$criteria['type'],'max_weight'=>max(array_column($decoded, 'weight')),
        'min_weight'=>min(array_column($decoded, 'weight'))] ;
        }
        return $arr;
    }

    //Menentukan Score
    public static function dss_saw(){
        $criterias = Criteria::orderBy('criteria_code','Asc')->has('saw')->with('sub_criteria')->get();
        $media = Media::orderBy('id','Asc')->has('saw')->with('saw')->get(); 
        $arr = [];
        $score=[];
        $minmax =  self::getMaxMin($criterias);
        foreach($media as $index => $media){
            $arr[$index] =[
                'media_name'=>$media->media_name
            ];
             foreach($criterias as $key => $criteria){
                 foreach($media->saw as $saw){
                    if($saw->criteria_id==$criteria->id){
                        $arr[$index]['criteria'][$criteria->criteria_code]=[
                            'name'=>$criteria->name,
                            'type'=>$criteria->type,
                            'weight'=>$saw->weight,
                        ];
                        if ($criteria->type=='benefit') {
                            $result=$saw->weight/$minmax[$criteria->criteria_code]['max_weight'];
                        }else{
                            $result=$minmax[$criteria->criteria_code]['min_weight']/$saw->weight;
                        }
                        $arr[$index]['criteria'][$criteria->criteria_code]['result'] = $result;
                        $score[$index][]=$result*$criteria->weight;
                    }
                }
            }
            
            $arr[$index]['score']=array_sum($score[$index]);
        }
        foreach ($arr as $key => $row)
            {
                $score[$key] = $row['score'];
            }
        array_multisort($score, SORT_DESC, $arr);
        return $arr;
    }
}