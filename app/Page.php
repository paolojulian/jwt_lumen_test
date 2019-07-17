<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url',
    ];
    protected $attributes = [
        'parent_page_id' => 0
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Checks if the parent_page_id exists in the Database
     */
    public function isParentExist($page_id)
    {
        // 0 is the default page_id, no need to check this one
        if ($page_id === 0) return true;

        if (Page::find($page_id))

        return true;
    }

}
