<?php
 namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
class User extends Model{

    protected $table = 'tbluser';
 
 // column  table
 protected $fillable = 
 [
'NAME', 'AGE', 'GENDER'
 ];
 
 public $timestamps = false;
 protected $primaryKey = 'userID';
 }