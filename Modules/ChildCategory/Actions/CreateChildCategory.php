<?php

namespace Modules\ChildCategory\Actions;

use Modules\ChildCategory\Entities\ChildCategory;


class CreateChildCategory
{
    public static function create($request)
    {
        
        return ChildCategory::create($request->all());
    }
}
