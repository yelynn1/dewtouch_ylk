<?php
	class MigrationController extends AppController{
		
		public function q1(){
			
			$this->setFlash('Question: Migration of data to multiple DB table');
			
			if(isset($this->request->data['Migrate']['file'])) {
				$file = $this->request->data['Migrate']['file'];
				$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
				ini_set('auto_detect_line_endings', true);
				$this->loadModel('Member');
				$this->loadModel('Transaction');
				$this->loadModel('TransactionItem');
				// debug($file['type']);
				if(in_array($file['type'], $mimes)){
					$uploaded_content = array();
					$handle = fopen($file['tmp_name'], 'r');
					$row_num = 0;


					while (($row = fgetcsv($handle, 0, ",")) !== FALSE) {
						if ($row_num != 0) {
							$member_no = explode(" ", $row[3]);
							$time = str_replace('/', '-', $row[0]);
							array_push($uploaded_content, array (
								'Member' => array(
									'type' => $member_no[0], 
									'no' => $member_no[1],
									'name' => $row[2],
									'company' => $row[5],
									'valid' => 1,
									'Transaction' => array(
										array (
											'member_name' => $row[2],
											'member_paytype' => $row[4],
											'member_company' => $row[5],
											'date' => date('Y-m-d', strtotime($time)),
											'year' => date('Y', strtotime($time)),
											'month' => date('m', strtotime($time)),
											'ref_no' => $row[1],
											'receipt_no' => $row[8],
											'payment_method' => $row[6],
											'batch_no' => $row[7],
											'cheque_no' => $row[9],
											'payment_type' => $row[10],
											'renewal_year' => $row[11],
											'subtotal' => $row[12],
											'tax' => $row[13],
											'total' => $row[14],
											'valid' => 1,
											'TransactionItem' => array(
												array(
													'description' => "Being Payment for : " . $row[10],
													'quantity' => 1,
													'unit_price' => $row[12],
													'sum' => $row[12],
													'valid' => 1,
													'table' => 'Member',
													'table_id' => $row_num
												)
											)
										)
										
									)
								),
								
						));
						}
						$row_num++;
					}
					fclose($handle);
					// debug($uploaded_content);
					$this->Member->saveAll($uploaded_content, array('deep' => true));
					$this->setFlash("Success");
				}
				else {
					echo "not allowed";
					$this->setFlash("This file type is not allowed to upload");
				}
			}
		}
		
		public function q1_instruction(){

			$this->setFlash('Question: Migration of data to multiple DB table');
				
			
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
		
	}