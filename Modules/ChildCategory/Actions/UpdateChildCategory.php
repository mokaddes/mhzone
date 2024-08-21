<?php

namespace Modules\ChildCategory\Actions;

class UpdateChildCategory
{
    public static function update($request, $childcategory)
    {
        return $childcategory->update($request->all());
    }
}
