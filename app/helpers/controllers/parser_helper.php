<?php
// parser functions
class Parser_Helper { 
	function backup_table($capsule, $table){
		print "<br> IN ".__FUNCTION__;
		$now = date('ymdhis');
		$newtable = $table."_".$now;
		$sql1 = "CREATE TABLE $newtable LIKE $table ";
		$sql2 = "INSERT $newtable  SELECT * FROM ".$table ;
		
		/*
		-- http://laravel.com/docs/4.2/database
		Running A Select Query
		$results = DB::select('select * from users where id = ?', array(1));
		The select method will always return an array of results.

		Running An Insert Statement

		DB::insert('insert into users (id, name) values (?, ?)', array(1, 'Dayle'));
		Running An Update Statement

		DB::update('update users set votes = 100 where name = ?', array('John'));
		Running A Delete Statement

		DB::delete('delete from users');
		Note: The update and delete statements return the number of rows affected by the operation.
		
		DB::listen(function($sql, $bindings, $time)
		{
		    //
		});
		*/
		print "<br>sql ".$sql1 ;
		print "<br>sql ".$sql2;
 
			$result1 = $capsule::statement($sql1);
			$result2 = $capsule::statement($sql2);

		print "<br>res ".$result1 ;
		print "<br>res ".$result2 ;

		return (($result1 == 1)&&($result2 == 1));
	}

	function query_for_gender_blank(){
		print "<br> IN ".__FUNCTION__;

		$result = array();
		$talent = Talent::where('gender', '=', '')->take(25)->orderBy('first_name')->get((['talent_id','first_name','last_name','gender']));

	    foreach ($talent as $talent_item){
	   		array_push($result, array(
	   			'talent_id'=>$talent_item->talent_id,
	   			'gender'=>$talent_item->gender,
	   			'first_name'=>$talent_item->first_name,
	   			'last_name'=>$talent_item->last_name
	   		) );
	    } 
		// count and list results
		// before and after
		return $result; // count and rows
	}

	function update_rows_from_csv(){
		print "<br> IN ".__FUNCTION__;
		$file = '/Library/WebServer/Documents/iflist/iflist-testing/csv-data/talent_wo_gender_2858_markedMF.csv';
		$csv = new parseCSV($file);
		foreach($csv->data as $data){
			var_dump($data) ."<br>";
		}
		// open file, construct querie(s)
		// execute
		return true;
	}
	function test(){
		print "i am test";
	}
}
/*
$parser_helper = new Parser_Helper();
$parser_helper->test();
*/