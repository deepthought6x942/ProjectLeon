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


		public function delete(){
			//delete an array? from some table?
			return 'deleted';
		}

		public function makeBooklet($year){

			//insert a sort function here, sort it first on Location and then within each location on category
    		
    		$donationsTable = AuctionDonation::with('user')->where('year'=$year)->orderBy('location', 'category')->all();

    		return View::make("booklet", $donationsTable);
}
		}


	}