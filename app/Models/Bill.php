<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;




class Bill extends Model
{ use SoftDeletes;

    use HasFactory;
    protected $table = 'bills';
    protected $fillable = [
        'bill_number',
        'bill_Date',
        'Due_date',
        'product',
        'section_id',
        'Amount_collection',
        'Amount_Commission',
        'Discount',
        'Value_VAT',
        'Rate_VAT',
        'Total',
        'Status',
        'Value_Status',
        'note',
    ];
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
