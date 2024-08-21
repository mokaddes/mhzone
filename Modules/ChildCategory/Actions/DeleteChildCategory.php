<?php

namespace Modules\ChildCategory\Actions;

class DeleteChildCategory
{
    public static function delete($childcategory)
    {
        return $childcategory->delete();
    }
}
