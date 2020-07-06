<?php
	class OrderReportController extends AppController{

		public function index(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));
			// debug($orders);exit;

			$this->loadModel('Portion');
			$portions = $this->Portion->find('all',array('conditions'=>array('Portion.valid'=>1),'recursive'=>2));
			//debug($portions);exit;


			// To Do - write your own array in this format
			// $order_reports = array('Order 1' => array(
			// 							'Ingredient A' => 1,
			// 							'Ingredient B' => 12,
			// 							'Ingredient C' => 3,
			// 							'Ingredient G' => 5,
			// 							'Ingredient H' => 24,
			// 							'Ingredient J' => 22,
			// 							'Ingredient F' => 9,
			// 						),
			// 					  'Order 2' => array(
			// 					  		'Ingredient A' => 13,
			// 					  		'Ingredient B' => 2,
			// 					  		'Ingredient G' => 14,
			// 					  		'Ingredient I' => 2,
			// 					  		'Ingredient D' => 6,
			// 					  	),
			// 					);

			// ...
			$portion_detail = array();
			foreach ($portions as $portion) {
				$name = $portion['Item']['name'];
				$ingredients = array();
				foreach ($portion['PortionDetail'] as $detail) {
					$ingredients[$detail['Part']['name']] = $detail['value'];
				}
				$portion_detail[$name] = $ingredients;
			}
			// debug($portion_detail);exit;
			
			$order_reports = array();
			foreach ($orders as $order) {
				$name = $order['Order']['name'];
				$dish = array();
				foreach ($order['OrderDetail'] as $detail) {
					$quantity = $detail['quantity'];
					$dish_name = $detail['Item']['name'];
					foreach ($portion_detail[$dish_name] as $key => $val) {
						if(array_key_exists($key, $dish)) {
							$dish[$key] += $val * $quantity;
						}
						else {
							$dish[$key] = $val * $quantity;
						}
					}
				}
				ksort($dish);
				$order_reports[$name] = $dish;
			}
			// debug($order_reports); exit;

			$this->set('order_reports',$order_reports);

			$this->set('title',__('Orders Report'));
		}

		public function Question(){

			$this->setFlash('Multidimensional Array.');

			$this->loadModel('Order');
			$orders = $this->Order->find('all',array('conditions'=>array('Order.valid'=>1),'recursive'=>2));

			// debug($orders);exit;

			$this->set('orders',$orders);

			$this->loadModel('Portion');
			$portions = $this->Portion->find('all',array('conditions'=>array('Portion.valid'=>1),'recursive'=>2));
				
			// debug($portions);exit;

			$this->set('portions',$portions);

			$this->set('title',__('Question - Orders Report'));
		}

	}