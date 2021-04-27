<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedJobsCustom extends Model
{
    use HasFactory;

    protected $table = 'failed_jobs_custom';
}
