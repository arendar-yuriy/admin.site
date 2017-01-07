<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
class Revision extends Model
{
    /**
     * Database table
     *
     * @var string
     */
    protected $table = 'revisions';
    /**
     * Fillable fields on the model
     *
     * @var array
     */
    protected $fillable = ['at', 'by', 'revisionable_type', 'revisionable_id', 'admin_user_id',  'action', 'state'];
    /**
     * Hidden attributes on the model
     *
     * @var array
     */
    protected $hidden = ['id', 'revisionable_type', 'revisionable_id'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function revisionable()
    {
        return $this->morphTo();
    }
    /**
     * @param $value
     * @return mixed
     */
    public function getStateAttribute($value)
    {
        return unserialize($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'admin_user_id');
    }
}