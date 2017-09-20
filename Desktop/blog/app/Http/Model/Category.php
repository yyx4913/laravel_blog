<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table ='category';
    protected $primaryKey='cate_id';
    protected $guarded=[];
    public  $timestamps =false;

    public function Tree()
    {
        $cate = $this->orderBy('cate_order','cate_id','asc')->get();
        return $this->getTree($cate,'cate_pid','cate_id',0);
    }

    public function getTree($data,$field_pid,$field_id='id',$pid)  //获取分类树
    {
        $arr= array();
        foreach($data as $k=>$v)
        {
            if($v->$field_pid ==$pid)
            {
                $arr[] = $data[$k];
                foreach($data as $m=>$n)
                {
                    if($n->$field_pid == $v->$field_id)
                    {
                        $arr[] =$data[$m];
                    }
                }
            }
        }
        return $arr;
    }
}
