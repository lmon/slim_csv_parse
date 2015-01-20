<?php
// parser functions
class Parser_Helper { 
	function backup_table($capsule, $table){
		print "<br> IN ".__FUNCTION__;
		$now = date('ymd_his');
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
		/*
		print "<br>sql ".$sql1 ;
		print "<br>sql ".$sql2;
 		*/
			$result1 = $capsule::statement($sql1);
			$result2 = $capsule::statement($sql2);

		/*
		print "<br>res ".$result1 ;
		print "<br>res ".$result2 ;
		*/
		return (($result1 == 1)&&($result2 == 1));
	}

	function query_for_gender_blank(){
		print "<br> IN ".__FUNCTION__;

		$result = array();
		$talent = Talent::where('gender', '=', '')->orderBy('first_name')->get((['talent_id','first_name','last_name','gender']));
		
		$result['count'] = count($talent);
		$result['rows'] = array();

	    foreach ($talent as $talent_item){
	   		array_push($result['rows'], array(
	   			'talent_id'=>$talent_item->talent_id,
	   			'gender'=>(($talent_item->gender)?$talent_item->gender:'blank'),
	   			'first_name'=>$talent_item->first_name,
	   			'last_name'=>$talent_item->last_name
	   		) );
	    } 
		// count and list results
		// before and after
		return $result; // count and rows
	}

	function update_rows_from_csv($file){
		$debugging = false;
		$sql_output = true;

		if($debugging) print "<br> IN ".__FUNCTION__."<br>";
		$number_ignored = 0;
		$number_notfound = 0;
		$number_updated = 0;
		
		$sql = "";
		$csv = new parseCSV($file);
		$counter = 0;

		foreach($csv->data as $data){
			//tsting
			//if($counter > 10){break;}
			//$counter++;

			if($data['Value'] != 'f' && $data['Value'] != 'm'){
				$number_ignored++;
				if($debugging) print " -- > ignoring CSV Data (bad value): ".$data['ID'].", ".$data['Value']."<br>"; continue;
			}
			/*
				$sql = "UPDATE talent SET gender='". $data['Value']."' WHERE id=".$data['ID']." LIMIT 1;";
				print "$sql <br>";
				or 
			*/
			$talent_item = Talent::find($data['ID']);

			//tsting
			if(isset($talent_item->gender)){
				
				// print "CSV talent: " . $data['ID'].", ".$data['Value']."<br>";	

				if($talent_item->gender !=''){
					$number_ignored++;
					 if($debugging) print " -- > No Update Needed for DB item: ".$talent_item->talent_id." : ".$talent_item->gender."<br>"; continue;
				}else{
					$number_updated++;
					$talent_item->gender = trim($data['Value']);
					// print "DB talent :".$talent_item->talent_id.", ".$talent_item->gender."<br>";			
					
					if($sql_output){ // just write the sql
						
						$sql = "UPDATE talent SET gender='". $data['Value']."' WHERE talent_id=".$data['ID']." LIMIT 1;";
						print "<br>\n  $sql <br>\n"; 
						
					}else{ // make the change in the DB!
						if($debugging) print "Updated ? ".$talent_item->save() ."<hr>";
					}	
				}
			}else{
				$number_notfound++;
				 if($debugging) print " -- > ignoring CSV Data: ".$data['ID']. ". not found in db !!!!!!!!!!<br>"; continue;
			}

		}
		
		print "<h4> ignored $number_ignored  not found $number_notfound  updated $number_updated </h4>";

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