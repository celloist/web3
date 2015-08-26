<?php
use Symfony\Component\HttpFoundation\File\UploadedFile;

namespace App\Http\Models\Import;

class PhotoImportModel {
	/**
	 * The zip file
	 * 
	 * @var UploadedFile
	 */
	private $file;
	/**
	 * The destination dir or the extract to dir 
	 * @var string
	 */
	private $destinationDir = '';
	/**
	 * ZipArchive
	 * @var ZipArchive
	 */
	private $zip;
	/**
	 * If set, uploaded images will be resized akkording too these options
	 * @var array
	 */
	private $resizeOptions = array();

	public function __construct () {
		$this->zip = new ZipArchive();
	}
	/**
	 * [setDestinationDir description]
	 * @param [type] $destDir [description]
	 */
	public function setDestinationDir ($destDir) {
		if (!file_exists($destDir)){
			throw new Exception('Destination dit doesn\'t exist!');
		}

		$this->destinationDir = $destDir;
	}
	/**
	 * [getDestinationDir description]
	 * @return [type] [description]
	 */
	public function getDestinationDir () {
		return $this->destinationDir;
	}
	/**
	 * [setFile description]
	 * @param UploadedFile $file [description]
	 */
	public function setFile (UploadedFile $file) {
		if (!file_exists($file->getRealPath())){
			throw new Exception('File empty');
		}

		$this->file = $file;
	}
	/**
	 * [getFile description]
	 * @return [type] [description]
	 */
	public function getFile () {
		return $this->file;
	}
	/**
	 * [setResizeOptions description]
	 * @param array $options [description]
	 */
	public function setResizeOptions (array $options) {
		$this->resizeOptions = $options;
	}
	/**
	 * Import a zip contents
	 * 
	 * @return [type] [description]
	 */
	public function import () {
		set_time_limit(0);
		ini_set('memory_limit', '512M');

		try {
			if ($this->file === NULL){
				throw new Exception('File not set yet');
			}

			if ($this->destinationDir === NULL){
				throw new Exception('Destinationdir not set yet');
			}

			if ($this->zip->open($this->file->getRealPath()) !== true){
				throw new Exception('Could not open zip..');
			}
			
			$resize = (!empty($this->resizeOptions));

			//Attempt to extract the zip to the destination dir. On failure, throw an Exception
			if (!$this->zip->extractTo($this->destinationDir)){
				throw new Exception("Could not extract zip to desination (". $this->destinationDir .")");
			}
			//See if the file name is extracted 
			//For example: if the filename = images.zip some archives are structured as images/* in stead of *
			$this->renameFolder();
			//If the resize option is filled
			$this->zip->close();

		} catch (Exception $e) {
			exit($e->getMessage());
		}

	}
	/**
	 * [renameFolder description]
	 * @return [type] [description]
	 */
	private function renameFolder () {
		$folder = str_replace('.zip', '', $this->file->getClientOriginalName());

		if (file_exists(($dir = $this->destinationDir . $folder)) ){
			if ($handle = opendir($dir)){
				while ( ($entry = readdir($handle)) !== false) {
					$file = $dir . '/' . $entry;
					if ($entry[0] == '.'){
						if ($entry != '.' && $entry != '..'){
							unlink($file);
						}
						continue;
					}

					if (file_exists($file)){
						rename($file, $this->destinationDir . $entry);	
					}
					
				}
				//remove folder from ftp
				rmdir($dir);
			}
		}
	}
}