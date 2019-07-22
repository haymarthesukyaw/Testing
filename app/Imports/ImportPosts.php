<?php

namespace App\Imports;

use App\Models\Post;
use Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportPosts implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $auth_id=Auth::user()->id;
        return new Post([
            'title' => $row[0],
            'description'  => $row[1],
            'create_user_id'=>$auth_id,
            'updated_user_id'=>$auth_id,
        ]);
    }
}
