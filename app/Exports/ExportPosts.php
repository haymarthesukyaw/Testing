<?php

namespace App\Exports;
use Auth;
use App\Models\Post;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPosts implements FromCollection,WithHeadings
{
    public function headings(): array {
        return [
           "Post Title",
           "Post Description",
           "Posted User",
           "Posted Date"
        ];
      }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if(Auth::user()->type == '0')
        {
            return Post::select(
                'posts.title',
                'posts.description',
                'users.name',
                'posts.created_at')
                ->join('users', 'users.id', 'posts.create_user_id')
                ->orderBy('posts.updated_at', 'DESC')
                ->get();
        }
        else{
            return Post::select(
                'posts.title',
                'posts.description',
                'users.name',
                'posts.created_at')
                ->join('users','users.id','posts.create_user_id')
                ->where('posts.create_user_id','=',Auth::user()->id)
                ->orderBy('posts.updated_at','DESC')
                ->get();
        }
    }
}
