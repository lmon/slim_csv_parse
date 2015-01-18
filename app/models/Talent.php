<?php

class Talent extends \Illuminate\Database\Eloquent\Model
{
	  protected $table = 'talent';
	  protected $primaryKey = 'talent_id';

	  /*

	  // we could do this if we had columns w diff names
	  const CREATED_AT = 'date_created';
      const UPDATED_AT = 'date_modified';
	  */
      /* but we dont so we will use
      */
      public $timestamps = false;
	  const CREATED_AT = 'date_posted';
}
