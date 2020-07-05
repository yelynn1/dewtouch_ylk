<?php

class FileUploadController extends AppController {
	public function index() {
		$this->set('title', __('File Upload Answer'));


		if(isset($this->request->data['FileUpload']['file'])) {
			$file = $this->request->data['FileUpload']['file'];
			$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
			ini_set('auto_detect_line_endings', true);
			if(in_array($file['type'], $mimes)){
				$uploaded_content = array();
				$handle = fopen($file['tmp_name'], 'r');
				while (($row = fgetcsv($handle, 0, ",")) !== FALSE) {
					array_push($uploaded_content, array (
						'name' => $row[0],
						'email' => $row[1]
					));
				}
				fclose($handle);
				$this->FileUpload->saveAll($uploaded_content, ['name', 'email']);
				$this->setFlash("Success");
			}
			else {
				echo "not allowed";
				$this->setFlash("This file type is not allowed to upload");
			}
		}

		$file_uploads = $this->FileUpload->find('all');
		$this->set(compact('file_uploads'));
	}
}