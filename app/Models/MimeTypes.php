<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MimeTypes extends Model
{
    use HasFactory;

    const DOCUMENT = 'application/vnd.google-apps.document';

    const FOLDER = 'application/vnd.google-apps.folder';
}
