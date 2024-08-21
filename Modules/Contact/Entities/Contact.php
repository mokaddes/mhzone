<?php

namespace Modules\Contact\Entities;

use App\Models\ContactHelp;
use App\Models\HelpReason;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Contact\Database\factories\ContactFactory::new();
    }


    public function subject():BelongsTo
    {
        return $this->belongsTo(ContactHelp::class,'subject_id','id');
    }

    public function reasone():BelongsTo
    {
        return $this->belongsTo(HelpReason::class,'reason_id','id');
    }
}
