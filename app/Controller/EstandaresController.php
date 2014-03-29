<?php
App::uses('AppController', 'Controller');
class EstandaresController extends AppController {

    var $name = "Estandares";
    var $helpers = array("Html", "Form");
    var $uses = array('Estandar','Item','ItemsEstandar','Programa','Facultad');
    public $components = array('Paginator');
    public $paginate = array(
        'limit'=>9,
        'order' => array(
            'Estandar.programa_id' => 'asc','Estandar.id' => 'asc'
        )
    );

	public function add() 
	{
		if ($this->request->is('post')) 
		{
			$this->Estandar->create();
			if ($this->Estandar->save($this->request->data)) 
			{
				$this->Session->setFlash(__('Estandar guardado exitosamente'));
				$this->redirect(array('action' => 'index'));
			} else 
			{
				$this->Session->setFlash(__('El estandar no se ha guardado correctament eintente de nuevo'));
			}
		}
		$facultades = $this->Facultad->find('list');
		$programas = $this->Estandar->Programa->find('list');
		$tiposestandares = $this->Estandar->Tiposestandar->find('list');
		$items = $this->Item->find('list',array('fields' => array('Item.id','Item.nombre'),'order' => array('Item.id' => 'asc')));
		$this->set(compact('facultades','programas', 'tiposestandares', 'items'));
	}

	public function editar_composicion($id = null) {
		if ($this->request->is('post')) {
			$this->ItemsEstandar->create();
			if ($this->ItemsEstandar->save($this->request->data)) {
				$this->Session->setFlash(__('The items estandar has been saved'));
				$this->redirect(array('action' => 'editar_compocicion/'.$id));
			} else {
				$this->Session->setFlash(__('The items estandar could not be saved. Please, try again.'));
			}
		}
		$items = $this->Item->find('list',array(
			'order' => 'Item.nombre asc'
			));
		$this->set("items", $items);
		$estandar = $this->Estandar->find('first',
			array(
				    'conditions' => 
		            array(
		                'Estandar.id ' => $id
		            	)
		    	)
			);
		$this->set("Estandar", $estandar);
		$itemsestandar = $this->ItemsEstandar->find('all',
			array(
				'joins' => array(
		        array(
		            'table' => 'items',
		            'alias' => 'Item',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Item.id = ItemsEstandar.item_id'
		            	)
		        	)
		    		),
		    	'fields' => array('Item.nombre','ItemsEstandar.id','ItemsEstandar.orden','ItemsEstandar.items_estandar_id'),
		    	'order' => array('ItemsEstandar.orden' => 'asc'),
		    	'conditions' => 
		            array(
		                'ItemsEstandar.items_estandar_id' => 0,'ItemsEstandar.estandar_id' => $id
		            	)
		    	)
			);

		//Ya tenemos los items que son las bases del documentos
		//Declaramos un array para juntar todo
		$arr = array();
		$arr2 = array();
		$larr = array();
		$larr2 = array();
		$a=0;
		$b=0;
		//Ahora vamos a sacar los items de nivel 2 de cada 1 de esos elemtos
		foreach($itemsestandar as $i => $v){
			//Le agregamos el nuevo valor al primer array
			$arr[$a]['ItemsEstandar']['id'] = $v["ItemsEstandar"]["id"];
			$arr[$a]['ItemsEstandar']['orden'] = $v["ItemsEstandar"]["orden"].".";
			$arr[$a]['Item']['nombre'] = $v["Item"]["nombre"];
			$arr[$a]['ItemsEstandar']['items_estandar_id'] = $v["ItemsEstandar"]["items_estandar_id"];
			$larr[$v["ItemsEstandar"]["id"]] = $v["Item"]["nombre"];
			$a=$a+1;
			//Sacaremos los sub items de esto a partir de una consulta
			$nivel2itemsestandar = $this->ItemsEstandar->find('all',
			array(
				'joins' => array(
		        array(
		            'table' => 'items',
		            'alias' => 'Item',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Item.id = ItemsEstandar.item_id'
		            	)
		        	)
		    		),
		    	'fields' => array('Item.nombre','ItemsEstandar.id','ItemsEstandar.orden','ItemsEstandar.items_estandar_id'),
		    	'order' => array('ItemsEstandar.orden' => 'asc'),
		    	'conditions' => 
		            array(
		                'ItemsEstandar.items_estandar_id' => $v["ItemsEstandar"]["id"],'ItemsEstandar.estandar_id' => $id
		            	)
		    	)
			);

			foreach($nivel2itemsestandar as $i2 => $v2){
				//Ponemos el resultado d ela anterior consulta en un array momentaneo
				$arr2[$b]['ItemsEstandar']['id'] = $v2["ItemsEstandar"]["id"];
				$arr2[$b]['ItemsEstandar']['orden'] = $v2["ItemsEstandar"]["orden"];
				$arr2[$b]['Item']['nombre'] = $v2["Item"]["nombre"];
				$arr2[$b]['ItemsEstandar']['items_estandar_id'] = $v2["ItemsEstandar"]["items_estandar_id"];
				$larr2[$v2["ItemsEstandar"]["id"]] = $v2["Item"]["nombre"];
				$b=$b+1;
				//generamos otra consulta para consultar aun los otros items que estan en tercer nivel

				$nivel3itemsestandar = $this->ItemsEstandar->find('all',
				array(
					'joins' => array(
			        array(
			            'table' => 'items',
			            'alias' => 'Item',
			            'type' => 'INNER',
			            'conditions' => 
			            array(
		                'Item.id = ItemsEstandar.item_id'
		            	)
		        	)
		    		),
		    	'fields' => array('Item.nombre','ItemsEstandar.id','ItemsEstandar.orden','ItemsEstandar.items_estandar_id'),
		    	'order' => array('ItemsEstandar.orden' => 'asc'),
		    	'conditions' => 
		            array(
		                'ItemsEstandar.items_estandar_id' => $v2["ItemsEstandar"]["id"],'ItemsEstandar.estandar_id' => $id
		            	)
			    	)
				);
				if(count($nivel3itemsestandar)>0){
					foreach($nivel3itemsestandar as $i3 => $v3){
						$arr2[$b]['ItemsEstandar']['id'] = $v3["ItemsEstandar"]["id"];
						$arr2[$b]['ItemsEstandar']['orden'] = $v2["ItemsEstandar"]["orden"].".".$v3["ItemsEstandar"]["orden"];
						$arr2[$b]['Item']['nombre'] = $v3["Item"]["nombre"];
						$arr2[$b]['ItemsEstandar']['items_estandar_id'] = $v3["ItemsEstandar"]["items_estandar_id"];
						$larr2[$v3["ItemsEstandar"]["id"]] = $v3["Item"]["nombre"];
						$b=$b+1;
					}
				}
			}

			//Aqui hemos temrinado el nivel 3 y 2 y tenemos un array con esos niveles juntos
			//Siguiente paso unirlo con el primer array de nivel 1
			if(count($arr2)>0 || $arr2!=NULL ){
				foreach($arr2 as $i4 => $v4){

					$arr[$a]['ItemsEstandar']['id'] = $v4["ItemsEstandar"]["id"];
					$arr[$a]['ItemsEstandar']['orden'] = $v["ItemsEstandar"]["orden"].".".$v4["ItemsEstandar"]["orden"];
					$arr[$a]['Item']['nombre'] = $v4["Item"]["nombre"];
					$arr[$a]['ItemsEstandar']['items_estandar_id'] = $v4["ItemsEstandar"]["items_estandar_id"];
					$larr[$v4["ItemsEstandar"]["id"]] = $v4["Item"]["nombre"];
					$a=$a+1;
				}
			//Siempre que se hace ciclos con array dependiendo lo que se haga se hace una limpiesa del array si no repite los datos por que quedan almacenados
			unset($arr2);	
			$arr2 = array();
			}
		}	
	$this->set("itemsestandar", $arr);
	$this->set("litemsestandar", $larr);
	}

	public function editar_estandar($id = null) {
		if (!$this->Estandar->exists($id)) {
			throw new NotFoundException(__('Invalid estandar'));
		}
		if ($this->request->is('post') || $this->request->is('put')) 
		{
			if ($this->Estandar->save($this->request->data)) 
			{
				$this->Session->setFlash(__('Estandar actualizado correctamente'));
				print_r($this->request->data);
				$this->redirect(array('action' => 'index'));	
			} 
			else 
			{
				$this->Session->setFlash(__('The estandar could not be saved. Please, try again.'));
			}
		} else {
			
			$this->Estandar->recursive = 0;
			$options = array('conditions' => array('Estandar.' . $this->Estandar->primaryKey => $id));
			$estandar= $this->Estandar->find('first', $options);
			$this->request->data=$estandar;
			$this->set('estandar',$estandar);
		}
		$programa=$estandar["Estandar"]["programa_id"];
		$this->Programa->recursive = -1;
		$programa = $this->Programa->find('first',array('conditions'=>array('Programa.id'=>$programa)));
		$facultades = $this->Facultad->find('list');
		$programas = $this->Estandar->Programa->find('list',array('conditions'=>array('Programa.facultad_id'=>$programa["Programa"]["facultad_id"])));
		$tiposestandares = $this->Estandar->Tiposestandar->find('list');
		$this->set(compact('facultades','programas', 'tiposestandares'));
		$this->set('programa',$programa);
	}


	public function index() 
	{
		$this->Estandar->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$estandares=$this->Paginator->paginate('Estandar');
		$this->set('estandares', $estandares);
	}

	public function view($id = null) {
		if (!$this->Estandar->exists($id)) {
			throw new NotFoundException(__('Invalid estandar'));
		}
		$options = array('conditions' => array('Estandar.' . $this->Estandar->primaryKey => $id));
		$this->set('estandar', $this->Estandar->find('first', $options));
		$itemsestandar = $this->ItemsEstandar->find('all',
			array(
				'joins' => array(
		        array(
		            'table' => 'items',
		            'alias' => 'Item',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Item.id = ItemsEstandar.item_id'
		            	)
		        	)
		    		),
		    	'fields' => array('Item.nombre','Item.extencion_caracteres','Item.extencion_lineas','ItemsEstandar.id','ItemsEstandar.orden','ItemsEstandar.items_estandar_id'),
		    	'order' => array('ItemsEstandar.orden' => 'asc'),
		    	'conditions' => 
		            array(
		                'ItemsEstandar.items_estandar_id' => 0,'ItemsEstandar.estandar_id' => $id
		            	)
		    	)
			);

		//Ya tenemos los items que son las bases del documentos
		//Declaramos un array para juntar todo
		$arr = array();
		$arr2 = array();
		$larr = array();
		$larr2 = array();
		$a=0;
		$b=0;
		//Ahora vamos a sacar los items de nivel 2 de cada 1 de esos elemtos
		foreach($itemsestandar as $i => $v){
			//Le agregamos el nuevo valor al primer array
			$arr[$a]['ItemsEstandar']['id'] = $v["ItemsEstandar"]["id"];
			$arr[$a]['ItemsEstandar']['orden'] = $v["ItemsEstandar"]["orden"].".";
			$arr[$a]['Item']['nombre'] = $v["Item"]["nombre"];
			$arr[$a]['Item']['extencion_lineas'] = $v["Item"]["extencion_lineas"];
			$arr[$a]['Item']['extencion_caracteres'] = $v["Item"]["extencion_caracteres"];
			$arr[$a]['ItemsEstandar']['items_estandar_id'] = $v["ItemsEstandar"]["items_estandar_id"];
			$larr[$v["ItemsEstandar"]["id"]] = $v["Item"]["nombre"];
			$a=$a+1;
			//Sacaremos los sub items de esto a partir de una consulta
			$nivel2itemsestandar = $this->ItemsEstandar->find('all',
			array(
				'joins' => array(
		        array(
		            'table' => 'items',
		            'alias' => 'Item',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Item.id = ItemsEstandar.item_id'
		            	)
		        	)
		    		),
		    	'fields' => array('Item.nombre','Item.extencion_caracteres','Item.extencion_lineas','ItemsEstandar.id','ItemsEstandar.orden','ItemsEstandar.items_estandar_id'),
		    	'order' => array('ItemsEstandar.orden' => 'asc'),
		    	'conditions' => 
		            array(
		                'ItemsEstandar.items_estandar_id' => $v["ItemsEstandar"]["id"],'ItemsEstandar.estandar_id' => $id
		            	)
		    	)
			);

			foreach($nivel2itemsestandar as $i2 => $v2){
				//Ponemos el resultado d ela anterior consulta en un array momentaneo
				$arr2[$b]['ItemsEstandar']['id'] = $v2["ItemsEstandar"]["id"];
				$arr2[$b]['ItemsEstandar']['orden'] = $v2["ItemsEstandar"]["orden"];
				$arr2[$b]['Item']['nombre'] = $v2["Item"]["nombre"];
				$arr2[$b]['Item']['extencion_lineas'] = $v2["Item"]["extencion_lineas"];
				$arr2[$b]['Item']['extencion_caracteres'] = $v2["Item"]["extencion_caracteres"];
				$arr2[$b]['ItemsEstandar']['items_estandar_id'] = $v2["ItemsEstandar"]["items_estandar_id"];
				$larr2[$v2["ItemsEstandar"]["id"]] = $v2["Item"]["nombre"];
				$b=$b+1;
				//generamos otra consulta para consultar aun los otros items que estan en tercer nivel

				$nivel3itemsestandar = $this->ItemsEstandar->find('all',
				array(
					'joins' => array(
			        array(
			            'table' => 'items',
			            'alias' => 'Item',
			            'type' => 'INNER',
			            'conditions' => 
			            array(
		                'Item.id = ItemsEstandar.item_id'
		            	)
		        	)
		    		),
		    	'fields' => array('Item.nombre','Item.extencion_caracteres','Item.extencion_lineas','ItemsEstandar.id','ItemsEstandar.orden','ItemsEstandar.items_estandar_id'),
		    	'order' => array('ItemsEstandar.orden' => 'asc'),
		    	'conditions' => 
		            array(
		                'ItemsEstandar.items_estandar_id' => $v2["ItemsEstandar"]["id"],'ItemsEstandar.estandar_id' => $id
		            	)
			    	)
				);
				if(count($nivel3itemsestandar)>0){
					foreach($nivel3itemsestandar as $i3 => $v3){
						$arr2[$b]['ItemsEstandar']['id'] = $v3["ItemsEstandar"]["id"];
						$arr2[$b]['ItemsEstandar']['orden'] = $v2["ItemsEstandar"]["orden"].".".$v3["ItemsEstandar"]["orden"];
						$arr2[$b]['Item']['nombre'] = $v3["Item"]["nombre"];
						$arr2[$b]['Item']['extencion_lineas'] = $v3["Item"]["extencion_lineas"];
						$arr2[$b]['Item']['extencion_caracteres'] = $v3["Item"]["extencion_caracteres"];
						$arr2[$b]['ItemsEstandar']['items_estandar_id'] = $v3["ItemsEstandar"]["items_estandar_id"];
						$larr2[$v3["ItemsEstandar"]["id"]] = $v3["Item"]["nombre"];
						$b=$b+1;
					}
				}
			}

			//Aqui hemos temrinado el nivel 3 y 2 y tenemos un array con esos niveles juntos
			//Siguiente paso unirlo con el primer array de nivel 1
			if(count($arr2)>0 || $arr2!=NULL ){
				foreach($arr2 as $i4 => $v4){

					$arr[$a]['ItemsEstandar']['id'] = $v4["ItemsEstandar"]["id"];
					$arr[$a]['ItemsEstandar']['orden'] = $v["ItemsEstandar"]["orden"].".".$v4["ItemsEstandar"]["orden"];
					$arr[$a]['Item']['nombre'] = $v4["Item"]["nombre"];
					$arr[$a]['Item']['extencion_lineas'] = $v4["Item"]["extencion_lineas"];
					$arr[$a]['Item']['extencion_caracteres'] = $v4["Item"]["extencion_caracteres"];
					$arr[$a]['ItemsEstandar']['items_estandar_id'] = $v4["ItemsEstandar"]["items_estandar_id"];
					$larr[$v4["ItemsEstandar"]["id"]] = $v4["Item"]["nombre"];
					$a=$a+1;
				}
			//Siempre que se hace ciclos con array dependiendo lo que se haga se hace una limpiesa del array si no repite los datos por que quedan almacenados
			unset($arr2);	
			$arr2 = array();
			}
		}	
 		$this->set("itemsestandar", $arr);
  		$this->set("litemsestandar", $larr);
	}

	

	public function delete($id = null) {
		$this->Estandar->id = $id;
		if (!$this->Estandar->exists()) {
			throw new NotFoundException(__('Invalid estandar'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Estandar->delete()) {
			$this->Session->setFlash(__('Estandar deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Estandar was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	public function delete_itemsestandares($ida = null,$idb) 
	{
		$this->ItemsEstandar->id = $ida;
		if (!$this->ItemsEstandar->exists()) {
			throw new NotFoundException(__('Ítem invalido'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ItemsEstandar->delete()) {
			$this->Session->setFlash(__('Ítem borrado satisfactoriamente'));
			$this->redirect(array('action' => 'editar_compocicion/'.$idb));
		}
		$this->Session->setFlash(__('Problema no se a podido borrar el Ítem'));
		$this->redirect(array('action' => 'editar_compocicion/'.$idb));
		
	}

	public function lista_programas() {
	$facultad_id=$this->request->data['Estandar']['facultad'];
	$select_entrada=$this->Programa->find('list', 
		array('conditions' => 
			array('facultad_id'=> $facultad_id
			)
		)
	);
	$this->set(compact('select_entrada'));
	$this->render('/Estandares/lista_programas');
}

}
