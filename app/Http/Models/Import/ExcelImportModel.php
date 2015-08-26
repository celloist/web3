<?php
namespace App\Http\Models\Import;

class ExcelImportModel extends AbstractExcelImportModel {
	/**
	 * [run description]
	 * @return [type] [description]
	 */
	public function run () {
		$this->initRun();
		$i = 0;
		
		try {
			$translations = array(
				8 => 'colourTitle',
				3 => 'colourContent',
				13 => 'colourMainImage',
				16 => 'colourBigImage',
				0 => 'colourNumber',
				2 => 'finishTitle',
				5 => 'itemTitle',
				4 => 'itemBarcode',
				1 => 'itemStockReference',
				6 => 'itemPrice'
			);
			
			$hydrator = new \Excel\RowHydrator($translations);

			$this->switchWorksheet(0);
			$worksheetIterator = $this->getCurrentWorksheetIterator();
			$worksheetIterator->setHydrator($hydrator);
			//Ship the first row
			$worksheetIterator->next();
			
			//loop cells
			while(($row = $worksheetIterator->read())){
				//Encode title's/image for quering/misc.
				$colourTitle 			= $this->encode($row->colourTitle);
				$finishTitle 			= $this->encode($row->finishTitle);

				/*
				----------------------
				|	Colour	
				----------------------
				*/
				//Cache result
				$colourCacheKey = 'colour_' . sha1($colourTitle);
				
				$colour = (DB::table('sites')->select('id', 'title AS colourTitle', 'content as colourContent', 'char_0 as colourMainImage', 'char_1 as colourNumber')->whereRaw('title = ? AND structure_id = ? AND parent_id = ?', array($colourTitle, __PAINT_STRUCTURE_ID__, $this->parentShopId))->remember(2, $colourCacheKey)->first());
				//If no results can be found, create the colour
				$colourFields = array(
					'colourTitle',
					'colourContent',
					'colourMainImage',
					'colourNumber'
				);

				$colourId = 0;	
				if (!empty($colour)){
					$colourId = $colour->id;
				}

				$this->prepareColourValues($row);

				if ($colourId <= 0){
					$colourId = $this->addColour($row);

					Cache::forget($colourCacheKey);
				} elseif ($this->valuesDiff($colourFields, $colour, $row)) {
					//Check if the current values diffr. from selected ones
					$this->addColour($row, $colourId);
					Cache::forget($colourCacheKey);
				}
				/*
				----------------------
				|	Finish
				----------------------
				 */
				$finishCacheKey = 'finish_' . sha1($finishTitle . $colourId); 
				$finishId = (int)(Finish::whereRaw('title = ? AND color_id = ?', array($finishTitle, $colourId))->remember(2, $finishCacheKey)->pluck('id')); 

				if ($finishId <= 0){
					// finish
					$finishId = $this->addFinish($row, $colourId);

					Cache::forget($finishCacheKey);
				}

				/*
				----------------------
				|	Item	
				----------------------
				*/
				$item = Can::where('barcode', $row->itemBarcode)->select('barcode','stock_reference as itemStockReference', 'title as itemTitle', 'price as itemPrice')->first();
				
				$itemsFields = array(
					'itemStockReference', 
					'itemTitle',
					'itemPrice'
				);

				//Number of iterations
				$i++;
				if (($i % 50) == 0 ) {
					usleep(200000);
				}
			
			}
		} catch (Exception $e) {
			var_dump($e->getMessage() . ' , '. $e->getFile() . ' => '. $e->getLine());
			exit("Fout");
		}
		//exit('Exit;');
	}
	/**
	 * [addItem description]
	 * @param array   $row      [description]
	 * @param integer $finishId [description]
	 */
	private function addItem ($row, $finishId = 0, $can = NULL) {
		$data = array();
		if (empty($row->itemBarcode)){
			$row->itemBarcode = uniqid();
		}

		if (empty($row->stockReference)){
			$row->stockReference = uniqid();
		}

		$data['barcode'] = $row->itemBarcode;
		$data['finish_id'] = $finishId;
		$data['stock_reference'] = $row->itemStockReference;
		$data['title'] = $row->itemTitle;
		$data['price'] = number_format($row->itemPrice, 2, '.', '');

		if ($can === NULL) {
			$can = Can::create($data);
		} else {
			$can->update($data);
		}

		return $can->barcode;	
	}
}