	<?php

	class TableController extends BaseController {
		//controller for manipulating tables 


		// a method used to export tables to csv
		public function get_export()
		{
			    $table = SomeTable::all(); //here is where we set the table to be copied
			    $file = fopen('file.csv', 'w'); //open a file using fopen Syntax:fopen(filename,mode,include_path,context)
			   
			    foreach ($table as $row) {
				    fputcsv( $file, $row->to_array() );   // Syntax: fputcsv(file,fields,seperator,enclosure)
			    }

			     fclose($file);
		 return Redirect::to('/');
		}
		

	}