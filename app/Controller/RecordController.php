<?php
	class RecordController extends AppController{
		
		public function index(){
			ini_set('memory_limit','256M');
			set_time_limit(0);
			
			$this->setFlash('Listing Record page too slow, try to optimize it.');

			$this->paginate = array (
				'limit' => 10
			);
			$cond = array();

			if(isset($this->request->query['search'])){
				$keyword = $this->request->query['search'];
				$cond = array("Record.name LIKE '%$keyword%'");
				$this->paginate = array (
					'limit' => 10,
					'conditions' => $cond
				);
			}
			
			if(isset($this->request->query['limit'])) {
				$this->paginate = array (
					'limit' => $this->request->query['limit'],
					'conditions' => $cond
				);
			}

			$records = $this->paginate('Record');
			
			//$records = $this->Record->find('all');
			
			$this->set('records',$records);
			
			
			$this->set('title',__('List Record'));
		}
		
		
// 		public function update(){
// 			ini_set('memory_limit','256M');
			
// 			$records = array();
// 			for($i=1; $i<= 1000; $i++){
// 				$record = array(
// 					'Record'=>array(
// 						'name'=>"Record $i"
// 					)			
// 				);
				
// 				for($j=1;$j<=rand(4,8);$j++){
// 					@$record['RecordItem'][] = array(
// 						'name'=>"Record Item $j"		
// 					);
// 				}
				
// 				$this->Record->saveAssociated($record);
// 			}
			
			
			
// 		}
	}