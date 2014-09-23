<?php
App::uses('AppController', 'Controller');
ini_set('default_charset','utf-8');
ini_set('memory_limit', '-2');	
class DocumentosController extends AppController {
	var $components = array("RequestHandler");
	var $helpers = array('Html');  // include the HTML helper
	var $uses = array(
		'Documento',
		'Estandar',
		'Proyecto',
		'Item',
		'ItemsEstandar',
		'Programa',
		'ItemsDocumento',
		'ItemsContenido',
		'TiposEstandar',
		'PersonasProyecto',
		'Rol',
		'Entrega',
		'Detalleentrega',
		'Evaluacion',
		'Persona');
	var $items=array();
	var $maquetarMostrar=array();
	var	$DatosXML="";
	var $descomposiciones=array();
	var $documento_id=0;

	function obtenerItems($itemPadre,$estandar_id)
	{	
		$this->autoRender = false;
		global $items;
		$this->ItemsEstandar->recursive = -1;
		$opciones = array(
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
		    	'fields' => array('ItemsEstandar.id','ItemsEstandar.nivel','Item.nombre','Item.extencion_caracteres','Item.extencion_lineas'),
		    	'conditions' => 
		            array(
		                'ItemsEstandar.items_estandar_id' => $itemPadre,
		                'ItemsEstandar.estandar_id' => $estandar_id
		           	),
	           	'order' => array('ItemsEstandar.orden asc'),		

	   	);
		$itemsConsultar = $this->ItemsEstandar->find('all',$opciones);
		if (is_array($itemsConsultar)) 
		{
			foreach ($itemsConsultar as $item) {
					$arrayTemporal=array();
					$arrayTemporal['id']=$item['ItemsEstandar']['id'];
					$arrayTemporal['titulo']=$item['Item']['nombre'];
					$arrayTemporal['nivel']=$item['ItemsEstandar']['nivel'];
					$arrayTemporal['extencion_caracteres']=$item['Item']['extencion_caracteres'];
					$arrayTemporal['extencion_lineas']=$item['Item']['extencion_lineas'];
					$items[]=$arrayTemporal;			
					$this->requestAction('documentos/obtenerItems/'.$item['ItemsEstandar']['id'].'/'.$estandar_id.'');
			}
		}
	}

	public function descomponer_documento($id = null) 
	{	
		function convertirImagen($codigo)
		{   $imgCodigo=$codigo;
		    return base64_decode($imgCodigo);
		}

		function getImagen($id)
		{   
		    $imgid=$id;
		    global $DatosXML;    
		    foreach ($DatosXML as $Etiqueta) 
		    {   
		        if($Etiqueta['tag'] == "RELATIONSHIP" && $Etiqueta['attributes']['ID']==$imgid)
		        {   
		            return $Etiqueta['attributes']['TARGET'];
		        }
		    }
		}

		function getImagenCode($target)
		{   $banderaImg=0;
		    $i=0;
		    $imgtarget="/word/".$target;
		    global $DatosXML;
		    foreach ($DatosXML as $Etiqueta) 
		    {   
		        if($Etiqueta['tag'] == "PKG:PART" && $Etiqueta['type']=="open" )
		        {   
		            if($Etiqueta['attributes']['PKG:NAME']==$imgtarget)
		            {
		            $banderaImg=1;
		            }
		            
		        }
		        else if($banderaImg==1 && $Etiqueta['tag'] == "PKG:BINARYDATA" && $Etiqueta['type']== "complete")
		        {   
		            return $Etiqueta['value'];
		        }

		    }
		}

		function quitar_tildes($cadena) 
		{
			$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
			$permitidas= array ("a","e","i","o","u","a","e","i","o","u","n","n","a","e","i","o","u","a","e","i","o","u","c","c","a","e","i","o","u","a","e","i","o","u","u","o","o","i","a","e","u","i","a","e");
			$texto = str_replace($no_permitidas, $permitidas ,$cadena);
			return $texto;
		}

		function LeerContenidoXML($Archivo) 
		{
			$ArchivoLista = @fopen($Archivo, "r", true);
			$DatosArchivo = fread($ArchivoLista, filesize($Archivo));
			@fclose($ArchivoLista);
			$TotalCaracteres = strlen($DatosArchivo);
			$Parser = xml_parser_create();
			xml_parse_into_struct($Parser, $DatosArchivo, $Valores, $Indices);
			xml_parser_free($Parser);
			return $Valores;
		}

		$this->Documento->recursive = 0;
		$this->ItemsEstandar->recursive = -1;
		global $documento_id;
		$documento_id=$id;
		$direccion = 'files/documentos/'.$documento_id.'/documentoxml.xml';
		$opciones = array('conditions' => array('Documento.' . $this->Documento->primaryKey => $documento_id));
		$documento = $this->Documento->find('first', $opciones);
		$estandar_id = $documento['Estandar']['id'];
		$proyecto = $documento;
		$this->set('proyecto',$proyecto);
		global $items;
		$items[]="";
		$this->requestAction('documentos/obtenerItems/0/'.$estandar_id.'');
		unset($items[0]);
		global $DatosXML;
		$DatosXML = LeerContenidoXML($direccion);

		function MostrarDatosXML() 
		{	global $documento_id;
			global $DatosXML;
			global $items;
			global $descomposiciones;
		   /* if(is_dir($directorio))
		    {   
		        eliminarDir($directorio);
		    }
		    */
		   // mkdir($directorio, 0700);
		    $i=0;
		    $contenidoKey=0;

	        $itemkey=1;
	        $esTitulo=0;//pilas cone sta variable
	        $banderaA=0;//Esta bandera se encarga de naalizar el estado de busuqueda del tag ||
	        //el estado inicial de la bandera es 0 cuando esta buscando el primer || y no ha encntrado nada
	        $banderaB=0;//Esta bandera se encarga de naalizar el estado de busuqueda del texto de titulos
	        $banderaC=0;//Esta bandera se encarga de definir si se capturara el contenido
	        $banderaP=0;//Esta bandera se encarga de definir si se capturara el contenido dentro de un parrafo
	        //ininiciamos un ciclo para rrecorrer el contenido del array con el contenido del xml
	        $contadorImg=0;
	        $contadorCaracteres=0;
		    global $documento_id;
		    $documento_id;
		    $directorio = WWW_ROOT.'files\documentos\\'.$documento_id.'\\';
	        foreach ($DatosXML as $Etiqueta) {
	            if(!isset($items[$itemkey])){break;}
	            // Se ha encontrado una Entrada
	            if($banderaP==0)
	            {
	                //Buscamos la etiqueta p para parrafo
	                if($Etiqueta['tag'] == "W:P" && $Etiqueta['type'] == "open")
	                {	
	                    $banderaP=1;
	                }
	            }
	            else if($banderaP==1)
	            {
	                if($Etiqueta['tag'] == "W:P" && $Etiqueta['type'] == "close" && $esTitulo!=1)
	                {	
	                    $banderaP=0;
	                    $contenidoKey=$contenidoKey+1;
	                }
	            }
	            //empezamos analizando el primer estado de las banderas
	            if($banderaA==0){
	                //entramos aqui para buscar el primer tag ||
	                if($Etiqueta['tag'] == "W:T" && $Etiqueta['type'] == "complete" && $Etiqueta['value'] == "||"){
	                   //Acabamos de encontrar el tag || en donde primero preguntamos por
	                   // si existe el tag w:t que es texto y luego si es una etiqueta cerrada con completado
	                   //cuyo valor value o el texto interno es igual a "||" 
	                    $item = strtolower($Etiqueta['value']);
	                    $banderaA=1;
	                    $banderaB=0;
	                    $banderaC=0;
	                }
	            }else if($banderaA==1 && $banderaB==0){
	                //entramos aqui para buscar el texto dentro del tagg que se ha abierto

	                if($Etiqueta['tag'] == "W:T" && $Etiqueta['type'] == "complete" && str_replace(".","",strtolower(quitar_tildes($Etiqueta['value']))) == strtolower(quitar_tildes($items[$itemkey]['titulo'])))
	                {
	                	
  						$items[$itemkey]['titulo']=$Etiqueta['value'];	
	                   //Acabamos de encontrar el texto dentro del tag 
	                    $item =$Etiqueta['value'];
	                    $banderaA=1;
	                    $banderaB=1;
	                    $banderaC=0;
	                }
	            }else if($banderaA==1 && $banderaB==1)
	            {
	                //entramos aqui para buscar el segundo tag del texto y cambiar al bandera para comenzar a caputara datos
	                if($Etiqueta['tag'] == "W:T" && $Etiqueta['type'] == "complete" && $Etiqueta['value'] == "||")
	                {
	                   //Acabamos de encontrar el texto dentro del tag 
	                    $item = strtolower($Etiqueta['value']);
	                    $banderaA=2;
	                    $banderaB=1;
	                    $banderaC=1;
	                    $descomposiciones["$itemkey"]['id']=$items[$itemkey]['id'];
	                    if($itemkey>1)
	                    {
	                    $prevItemkey=$itemkey-1;
	                    $descomposiciones["$prevItemkey"]['caracteres']=$contadorCaracteres;
	                    $contadorCaracteres=0;
	                    }
	                    $descomposiciones["$itemkey"]['titulo']=$items[$itemkey]['titulo'];
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']="";
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['tipo']=1;
	                    $esTitulo=1;
	                }

	            }else if($banderaA==2 && $banderaB==1 && $banderaC==1)
	            {
	                //entramos aqui para adicionar el texto de lo encontrado
	                if($Etiqueta['tag'] == "W:T" && $Etiqueta['type'] == "complete" && $Etiqueta['value'] =="||")
	                {	
	                    //tipos de entrada : titulo 1 2 texto 3 texto de  figura, 4 fuente 5 pie de pagina 6imagen  7tabla  
	                    $banderaA=1;
	                    $banderaB=0;
	                    $banderaC=0;
	                    $itemkey=$itemkey+1;
	                    $contenidoKey=0;
	                   //Acabamos de encontrar el texto dentro del tag 
	                }
	                else if($Etiqueta['tag'] == "W:T" && $Etiqueta['type'] == "complete" && strstr(strtolower($Etiqueta['value']),"figura ")){
	                    //Antes de comenzar una imagen
	                    if(!isset($descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']))
	                    {
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']="";
	                    }
	                    $esTitulo=0;
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['tipo']=3;
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']=$descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos'].$Etiqueta['value'];
	                	$contadorCaracteres=$contadorCaracteres+strlen($Etiqueta['value']);
	                }
	                else if($Etiqueta['tag'] == "W:T" && $Etiqueta['type'] == "complete" && strstr(strtolower($Etiqueta['value']),"tabla ")){
	                    if(!isset($descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']))
	                    {
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']="";
	                    }
	                    $esTitulo=0;
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['tipo']=7;
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']=$descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos'].$Etiqueta['value'];
	                }
	                else if($Etiqueta['tag'] == "V:IMAGEDATA" && $Etiqueta['type'] == "complete"){
	                    if(!isset($descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']))
	                    {
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']="";
	                    }
	                    $esTitulo=0;
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['tipo']=6;
	                    $id=$Etiqueta['attributes']['R:ID'];
	                    $nameImagen=getImagen($id);
	                    $codigoImg=getImagenCode($nameImagen);
	                    $imagen=convertirImagen($codigoImg);
	                    ++$contadorImg;
	                    $fileName=WWW_ROOT.'files/documentos//'.$documento_id.'//'.$contadorImg.".png";
	                    $file=fopen($fileName,"a") or die("Problemas");
	                    fputs($file,$imagen);
	                    fclose($file);
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']=
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos'].$documento_id.'/'.$contadorImg.'.png';
	                }
	                else if($Etiqueta['tag'] == "W:T" && $Etiqueta['type'] == "complete" && strstr(strtolower($Etiqueta['value']),"fuente:")){
	                    if(!isset($descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']))
	                    {
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']="";
	                    }
	                    $esTitulo=0;
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['tipo']=4;
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']=$descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos'].$Etiqueta['value'];
	                	$contadorCaracteres=$contadorCaracteres+strlen($Etiqueta['value']);
	                }
	                else if($Etiqueta['tag'] == "W:T" && $Etiqueta['type'] == "complete"){
	                    if(!isset($descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']))
	                    {
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']="";
	                    }
	                    $esTitulo=0;
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['tipo']=2;
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']=$descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos'].$Etiqueta['value'];
	                	$contadorCaracteres=$contadorCaracteres+strlen($Etiqueta['value']);
	                }
	                if($itemkey==count($items))
                    {
                    	$itemkey;
	                    $descomposiciones["$itemkey"]['caracteres']=$contadorCaracteres;
                    }
	            }
	        }
		}

		MostrarDatosXML();
		global $descomposiciones;
		$this->set('descomposiciones',$descomposiciones);
		if(!isset($descomposiciones))
		{
			$this->Session->setFlash(__('Por favor ingrese un estandar valido'));
			$this->redirect(array('action' => 'subir_documento/'.$documento['Documento']['proyecto_id']));
		}
			
			foreach ($descomposiciones as $descomposicion) 
		    {
		        $this->ItemsDocumento->create();
		        $itemDocumento=array();
		        $itemDocumento['ItemsDocumento']['documento_id']=$id;
		        $itemDocumento['ItemsDocumento']['items_estandar_id']=$descomposicion['id'];
		        $itemDocumento['ItemsDocumento']['caracteres']=$descomposicion['caracteres'];
				if ($this->ItemsDocumento->save($itemDocumento)) 
				{
					$orden=1;
			        foreach ($descomposicion['contenido'] as $item) 
			        {	
			        	$this->ItemsContenido->create();
			        	$itemContenido=array();
			        	if($item['tipo']==2)
			        	{	
			        		$itemContenido['ItemsContenido']['texto']=$item['elementos'];
			        		$itemContenido['ItemsContenido']['tipo']=2;
			        		$itemContenido['ItemsContenido']['items_documento_id']=$this->ItemsDocumento->id;
			        		$itemContenido['ItemsContenido']['orden']=$orden;
			        		$this->ItemsContenido->save($itemContenido);
			        		//echo "--texto--";
			        	
			        	}
			        	else if($item['tipo']==3)
			        	{	
			        		$itemContenido['ItemsContenido']['texto']=$item['elementos'];
			        		$itemContenido['ItemsContenido']['tipo']=3;
			        		$itemContenido['ItemsContenido']['items_documento_id']=$this->ItemsDocumento->id;
			        		$itemContenido['ItemsContenido']['orden']=$orden;
			        		$this->ItemsContenido->save($itemContenido);
			        		//echo "--cabeza figura--";
			        	}
			        	else if($item['tipo']==4)
			        	{	
			        		$itemContenido['ItemsContenido']['texto']=$item['elementos'];
			        		$itemContenido['ItemsContenido']['tipo']=4;
			        		$itemContenido['ItemsContenido']['items_documento_id']=$this->ItemsDocumento->id;
			        		$itemContenido['ItemsContenido']['orden']=$orden;
			        		$this->ItemsContenido->save($itemContenido);
			        		//echo "--fuente--";
			        	}
			        	else if($item['tipo']==5)
			        	{	
			        		$itemContenido['ItemsContenido']['texto']=$item['elementos'];
			        		$itemContenido['ItemsContenido']['tipo']=5;
			        		$itemContenido['ItemsContenido']['items_documento_id']=$this->ItemsDocumento->id;
			        		$itemContenido['ItemsContenido']['orden']=$orden;
			        		$this->ItemsContenido->save($itemContenido);
			        		//echo "--pie de pagina--";
			        	}
			        	else if($item['tipo']==6)
			        	{	
			        		$itemContenido['ItemsContenido']['texto']=$item['elementos'];
			        		$itemContenido['ItemsContenido']['tipo']=6;
			        		$itemContenido['ItemsContenido']['items_documento_id']=$this->ItemsDocumento->id;
			        		$itemContenido['ItemsContenido']['orden']=$orden;
			        		$this->ItemsContenido->save($itemContenido);
			        		//echo "--Imagen--";
			        	}
			        	else if($item['tipo']==7)
			        	{	
			        		$itemContenido['ItemsContenido']['texto']=$item['elementos'];
			        		$itemContenido['ItemsContenido']['tipo']=7;
			        		$itemContenido['ItemsContenido']['items_documento_id']=$this->ItemsDocumento->id;
			        		$itemContenido['ItemsContenido']['orden']=$orden;
			        		$this->ItemsContenido->save($itemContenido);
			        		//echo "--Tabla--";
			        	}
			        	++$orden;
			        }
				}else
				{
					$this->Session->setFlash(__('Error al guardar contenidos en la base de datos'));
				}
		    }



			
			

	    $this->redirect(array('action' => 'mostrar_documento',$documento_id));
	}

	public function evaluar_documento($id = null)
	{	
		if (!$this->Detalleentrega->exists($id)) 
		{
			throw new NotFoundException(__('Entrega invalida'));
		}
		if ($this->request->is('post')) 
		{
			$id=$this->request->data['Proyecto']['documento']; 
			$this->redirect(array('action' => 'mostrar_documento',$id));
		}
		$this->Detalleentrega->recursive = 0;
		$options = array('conditions' => array('Detalleentrega.' . $this->Detalleentrega->primaryKey => $id));
		$detalleEntrega=$this->Detalleentrega->find('first', $options);
		$this->Documento->recursive = 0;
		$options = array('conditions' => array('Documento.' . $this->Documento->primaryKey => $detalleEntrega['Entrega']['documento_id']));
		$documento=$this->Documento->find('first', $options);
		$id=$documento['Documento']['id'];
		$this->TiposEstandar->recursive = -1;
		$opciones = array('conditions' => array('TiposEstandar.' . $this->TiposEstandar->primaryKey => $documento['Estandar']['tiposestandar_id']));
		$tipoEstandar=$this->TiposEstandar->find('first', $opciones);
		$documento['TiposEstandar']=$tipoEstandar['TiposEstandar'];
		$proyecto = $documento;
		$this->PersonasProyecto->recursive = -1;
		$opciones = array(
		    	'joins' => array(
			        array(
			            'table' => 'personas',
			            'alias' => 'Persona',
			            'type' => 'INNER',
			            'conditions' => 
			            array(
			                'Persona.id = PersonasProyecto.persona_id'
		            	)
		        	)
	    		),
		    	'fields' => array('Persona.id','Persona.nombre','Persona.apellido','PersonasProyecto.rol_id'),
		    	'conditions' => 
		            array(
		                'PersonasProyecto.proyecto_id' => $proyecto['Proyecto']['id'],
		           	),
	           	'order' => array('PersonasProyecto.rol_id asc'),		

	   	);
	   	$integrantes=$this->PersonasProyecto->find('all', $opciones);
	   	$proyecto['Integrantes']=$integrantes;
		$this->set('proyecto',$proyecto);
		$id_documento=$proyecto['Documento']['id'];
		$this->requestAction('documentos/maquetar_documento/'.$id_documento);
		global $maquetarMostrar;
		$anclasItems=array();
		foreach ($maquetarMostrar as $itemAnclar) 
		{
			if($itemAnclar['nivel']!=1)
			{
				$key=$itemAnclar['item_documento_id'];
				$anclasItems[$key]=$itemAnclar['titulo'];	
			}
		}
		$this->Documento->recursive = -1;
		$opciones = array(
	    	'joins' => array(
		        array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'tiposestandares',
		            'alias' => 'TiposEstandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'TiposEstandar.id = Estandar.tiposestandar_id'
	            	)
	        	)
    		),
	    	'fields' => array('TiposEstandar.id','TiposEstandar.nombre'),
	    	'conditions' => 
	            array(
	                'Documento.proyecto_id' => $proyecto['Proyecto']['id'],
	           	),
           	'order' => array('TiposEstandar.nombre asc'),
           	'group' => array('TiposEstandar.id'),		
	   	);
		$tiposestandares=$this->Documento->find('list', $opciones);
		$opciones = array(
	    	'joins' => array(
		        array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'tiposestandares',
		            'alias' => 'TiposEstandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'TiposEstandar.id = Estandar.tiposestandar_id'
	            	)
	        	)
    		),
	    	'fields' => array('Documento.id','Documento.fecha_guardado'),
	    	'conditions' => 
	            array(
	                'Documento.proyecto_id' => $proyecto['Proyecto']['id'],
	                'Estandar.id' => $proyecto['TiposEstandar']['id']
	           	),
           	'order' => array('Documento.fecha_guardado desc'),
	   	);
		$documentos=$this->Documento->find('list', $opciones);
		$opciones = array(
	    	'conditions' => 
	            array(
	                'Rol.id !=' => 3
	           	),
           	'order' => array('Rol.nombre desc'),
	   	);
		$roles=$this->Rol->find('list', $opciones);
		$this->set('descomposiciones',$maquetarMostrar);
		$this->set('tiposestandares',$tiposestandares);
		$this->set('documentos',$documentos);
		$this->set('anclasItems',$anclasItems);
		$this->set('roles',$roles);

	}

	public function index() {
		$this->Documento->recursive = 0;
		$this->set('documentos', $this->paginate());
	}

	public function lista_documentos()
	{
		$tipoDocumento=$this->request->data['Proyecto']['tipodocumento'];
		$proyecto=$this->request->data['Proyecto']['id'];
		$opciones = array(
	    	'joins' => array(
		        array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'tiposestandares',
		            'alias' => 'TiposEstandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'TiposEstandar.id = Estandar.tiposestandar_id'
	            	)
	        	)
    		),
	    	'fields' => array('Documento.id','Documento.fecha_guardado'),
	    	'conditions' => 
	            array(
	                'Documento.proyecto_id' => $proyecto,
	                'TiposEstandar.id' => $tipoDocumento
	           	),
           	'order' => array('Documento.fecha_guardado asc'),
	   	);
		$documentos=$this->Documento->find('list', $opciones);
		$this->set('documentos',$documentos);
	}

	function maquetar_documento($id = null)
	{
		//aqui simplemente praparamos la información para no mas de ser mostrada se ha 
		//realizado a manera de funcion para no mas de llamarla y devolver
		if (!$this->Documento->exists($id)) 
		{
			throw new NotFoundException(__('Invalid documento'));
		}
		$this->autoRender = false;
		$this->Documento->recursive = 0;
		$options = array('conditions' => array('Documento.' . $this->Documento->primaryKey => $id));
		$proyecto=$this->Documento->find('first', $options);
		$id_documento=$proyecto['Documento']['id'];
		global $items;
		$items="";
		$this->requestAction('documentos/obtenerItems/0/'.$proyecto['Estandar']['id'].'');
		//$maquetarMostrar[]="";//cuidado con esta línea
		global $maquetarMostrar;
		$maquetarMostrar=$items;
		unset($maquetarMostrar[0]);
		$opcionesItemsDocumento=array(
		    'conditions' => array('ItemsDocumento.documento_id'=> $proyecto['Documento']['id']),
		    'order' => array('ItemsDocumento.id asc'),
		    'recursive' => -1
		);
		$itemsDocumento=$this->ItemsDocumento->find('all', $opcionesItemsDocumento);
		//obtenemos los contenidos de este documento haciendo join entre contenidos titulo sy documento
		$opcionesItemsContenido=array(
		    'joins' => array(
			        array(
			            'table' => 'items_documento',
			            'alias' => 'ItemsDocumento',
			            'type' => 'INNER',
			            'conditions' => 
			            array(
			                'ItemsDocumento.id = ItemsContenido.items_documento_id'
			            	)
			        	)
    		),
		    'fields' => array('ItemsContenido.*,ItemsContenido.texto as elementos'),
		    'conditions' => array('ItemsDocumento.documento_id'=> $proyecto['Documento']['id']),
		    'order' => array('ItemsContenido.items_documento_id asc','ItemsContenido.orden asc'),
		    'recursive' => -1
		);
		$itemsContenido=$this->ItemsContenido->find('all', $opcionesItemsContenido);
		$actual=1;
		foreach ($maquetarMostrar as $item) 
		{
			
			foreach ($itemsDocumento as $itemDocumento) 
			{
				if($item['id']==$itemDocumento['ItemsDocumento']['items_estandar_id'])
				{
					$maquetarMostrar[$actual]['item_documento_id']=$itemDocumento['ItemsDocumento']['id'];
					$maquetarMostrar[$actual]['caracteres']=$itemDocumento['ItemsDocumento']['caracteres'];
					$maquetarMostrar[$actual]['contenido']=array();
					$keyContenido=0;
					foreach ($itemsContenido as $itemContenido) 
					{
						if($itemDocumento['ItemsDocumento']['id']==$itemContenido['ItemsContenido']['items_documento_id'])
						{
							$maquetarMostrar[$actual]['contenido'][$keyContenido]=$itemContenido['ItemsContenido'];
							++$keyContenido;
						}
					}
				}
			}
		++$actual;
		}
	}

	public function mostrar_documento($id = null)
	{	

		if (!$this->Documento->exists($id)) 
		{
			throw new NotFoundException(__('Invalid documento'));
		}
		if ($this->request->is('post')) 
		{
			$id=$this->request->data['Proyecto']['documento']; 
			$this->redirect(array('action' => 'mostrar_documento',$id));
		}
		$this->Documento->recursive = 0;
		$options = array('conditions' => array('Documento.' . $this->Documento->primaryKey => $id));
		$documento=$this->Documento->find('first', $options);

		$id_del_proyecto=$documento['Documento']['proyecto_id'];
		$this->TiposEstandar->recursive = -1;

		$opciones = array('conditions' => array('TiposEstandar.' . $this->TiposEstandar->primaryKey => $documento['Estandar']['tiposestandar_id']));
		$tipoEstandar=$this->TiposEstandar->find('first', $opciones);

		$documento['TiposEstandar']=$tipoEstandar['TiposEstandar'];
		$proyecto = $documento;

		$this->PersonasProyecto->recursive = -1;
		$opciones = array(
		    	'joins' => array(
			        array(
			            'table' => 'personas',
			            'alias' => 'Persona',
			            'type' => 'INNER',
			            'conditions' => 
			            array(
			                'Persona.id = PersonasProyecto.persona_id'
		            	)
		        	)
	    		),
		    	'fields' => array('Persona.id','Persona.nombre','Persona.apellido','PersonasProyecto.rol_id'),
		    	'conditions' => 
		            array(
		                'PersonasProyecto.proyecto_id' => $proyecto['Proyecto']['id'],
		           	),
	           	'order' => array('PersonasProyecto.rol_id asc'),		

	   	);
	   	$integrantes=$this->PersonasProyecto->find('all', $opciones);
	   	$proyecto['Integrantes']=$integrantes;
		$this->set('proyecto',$proyecto);
		$id_documento=$proyecto['Documento']['id'];
		$this->requestAction('documentos/maquetar_documento/'.$id_documento);
		global $maquetarMostrar;
		$anclasItems=array();
		foreach ($maquetarMostrar as $itemAnclar) 
		{
			if($itemAnclar['nivel']!=1)
			{
				$key=$itemAnclar['item_documento_id'];
				$anclasItems[$key]=$itemAnclar['titulo'];	
			}
		}
		$this->Documento->recursive = -1;
		$opciones = array(
	    	'joins' => array(
		        array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'tiposestandares',
		            'alias' => 'TiposEstandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'TiposEstandar.id = Estandar.tiposestandar_id'
	            	)
	        	)
    		),
	    	'fields' => array('TiposEstandar.id','TiposEstandar.nombre'),
	    	'conditions' => 
	            array(
	                'Documento.proyecto_id' => $proyecto['Proyecto']['id'],
	           	),
           	'order' => array('TiposEstandar.nombre asc'),
           	'group' => array('TiposEstandar.id'),		
	   	);
		$tiposestandares=$this->Documento->find('list', $opciones);

		$opciones = array(
	    	'joins' => array(
		        array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'tiposestandares',
		            'alias' => 'TiposEstandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'TiposEstandar.id = Estandar.tiposestandar_id'
	            	)
	        	)
    		),
	    	'fields' => array('Documento.id','Documento.fecha_guardado'),
	    	'conditions' => 
	            array(
	                'Documento.proyecto_id' => $proyecto['Proyecto']['id'],
	                'TiposEstandar.id' => $proyecto['TiposEstandar']['id']
	           	),
           	'order' => array('Documento.fecha_guardado desc'),
	   	);
		$documentos=$this->Documento->find('list', $opciones);

		$opciones = array(
	    	'conditions' => 
	            array(
	                'Rol.id !=' => 3
	           	),
           	'order' => array('Rol.nombre desc'),
	   	);
		$roles=$this->Rol->find('list', $opciones);
		$this->set('descomposiciones',$maquetarMostrar);
		$this->set('tiposestandares',$tiposestandares);
		$this->set('documentos',$documentos);
		$this->set('anclasItems',$anclasItems);
		$this->set('roles',$roles);
	}

	public function detalle_entrega($id = null)
	{	
		if (!$this->Detalleentrega->exists($id)) 
		{

			$this->redirect($this->referer());
		}
		if ($this->request->is('post')) 
		{
			$id=$this->request->data['Proyecto']['documento']; 
			$this->redirect(array('action' => 'detalle_entrega',$id));
		}
		if(isset($id))
		{
			$options = array('conditions' => array('Detalleentrega.' . $this->Documento->primaryKey => $id));
			$detalle_entrega=$this->Detalleentrega->find('first', $options);
			$this->set('entrega',$detalle_entrega);
			$id=$detalle_entrega['Entrega']['documento_id'];

			$this->set('detalleentrega',$detalle_entrega);
		}
		
		$this->Documento->recursive = 0;
		$options = array('conditions' => array('Documento.' . $this->Documento->primaryKey => $id));
		$documento=$this->Documento->find('first', $options);
		$this->TiposEstandar->recursive = -1;
		$opciones = array('conditions' => array('TiposEstandar.' . $this->TiposEstandar->primaryKey => $documento['Estandar']['tiposestandar_id']));
		$tipoEstandar=$this->TiposEstandar->find('first', $opciones);
		$documento['TiposEstandar']=$tipoEstandar['TiposEstandar'];

		$proyecto = $documento;

		$this->PersonasProyecto->recursive = -1;
		$opciones = array(
		    	'joins' => array(
			        array(
			            'table' => 'personas',
			            'alias' => 'Persona',
			            'type' => 'INNER',
			            'conditions' => 
			            array(
			                'Persona.id = PersonasProyecto.persona_id'
		            	)
		        	)
	    		),
		    	'fields' => array('Persona.id','Persona.nombre','Persona.apellido','PersonasProyecto.rol_id'),
		    	'conditions' => 
		            array(
		                'PersonasProyecto.proyecto_id' => $proyecto['Proyecto']['id'],
		           	),
	           	'order' => array('PersonasProyecto.rol_id asc'),		

	   	);
	   	$integrantes=$this->PersonasProyecto->find('all', $opciones);
	   	$proyecto['Integrantes']=$integrantes;
		$this->set('proyecto',$proyecto);
		$id_documento=$proyecto['Documento']['id'];
		$this->requestAction('documentos/maquetar_documento/'.$id_documento);
		global $maquetarMostrar;
		$anclasItems=array();
		foreach ($maquetarMostrar as $itemAnclar) 
		{
			if($itemAnclar['nivel']!=1)
			{
				$key=$itemAnclar['item_documento_id'];
				$anclasItems[$key]=$itemAnclar['titulo'];	
			}
		}
		$this->Documento->recursive = -1;
		$opciones = array(
	    	'joins' => array(
		        array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'tiposestandares',
		            'alias' => 'TiposEstandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'TiposEstandar.id = Estandar.tiposestandar_id'
	            	)
	        	)
    		),
	    	'fields' => array('TiposEstandar.id','TiposEstandar.nombre'),
	    	'conditions' => 
	            array(
	                'Documento.proyecto_id' => $proyecto['Proyecto']['id'],
	           	),
           	'order' => array('TiposEstandar.nombre asc'),
           	'group' => array('TiposEstandar.id'),		
	   	);
		$tiposestandares=$this->Documento->find('list', $opciones);
		

		//Obtendremos los documentos enviados y los presentaremos por persona a la que se entrego
		$opciones = array(
	    	'joins' => array(
	        	array(
		            'table' => 'personas_proyectos',
		            'alias' => 'PersonaProyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Persona.id = PersonaProyecto.persona_id'
	            	)
	        	),
	        	array(
		            'table' => 'detalleentregas',
		            'alias' => 'DetalleEntrega',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'PersonaProyecto.id = DetalleEntrega.personas_proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'entregas',
		            'alias' => 'Entrega',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Entrega.id = DetalleEntrega.entrega_id'
	            	)
	        	),
	        	array(
		            'table' => 'documentos',
		            'alias' => 'Documento',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Documento.id = Entrega.documento_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	)
    		),
	    	'fields' => array('DetalleEntrega.id','Documento.fecha_guardado','Persona.id'),
	    	'conditions' => 
	            array(
	                'Proyecto.id' => $proyecto['Proyecto']['id'],
	                'Estandar.tiposestandar_id' => $proyecto['TiposEstandar']['id']
	           	),
           	'order' => array('Documento.fecha_guardado desc'),
           	'recursive'=>0
	   	);

		$entregasDocumento=$this->Persona->find('all', $opciones);



		//Personas que recibieorn los documentos
		$opciones = array(
	    	'joins' => array(
	        	array(
		            'table' => 'personas_proyectos',
		            'alias' => 'PersonaProyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Persona.id = PersonaProyecto.persona_id'
	            	)
	        	),
	        	array(
		            'table' => 'detalleentregas',
		            'alias' => 'DetalleEntrega',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'PersonaProyecto.id = DetalleEntrega.personas_proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'entregas',
		            'alias' => 'Entrega',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Entrega.id = DetalleEntrega.entrega_id'
	            	)
	        	),
	        	array(
		            'table' => 'documentos',
		            'alias' => 'Documento',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Documento.id = Entrega.documento_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	)
    		),
	    	'fields' => array('DISTINCT Persona.id','Persona.nombre','Persona.apellido'),
	    	'conditions' => 
	            array(
	                'Proyecto.id' => $proyecto['Proyecto']['id'],
	                'Estandar.tiposestandar_id' => $proyecto['TiposEstandar']['id']
	           	),
           	'order' => array('Documento.fecha_guardado desc'),
           	'recursive'=>0
	   	);

		$personas=$this->Persona->find('all', $opciones);

		$listaEntregas=array();
		foreach ($personas as $persona) 
		{
			
			foreach ($entregasDocumento as $entregaDocumento) {
				
			if($persona['Persona']['id']==$entregaDocumento['Persona']['id'])
			{
				$listaEntregas[$persona['Persona']['nombre']." ".$persona['Persona']['apellido']][$entregaDocumento['DetalleEntrega']['id']]=$entregaDocumento['Documento']['fecha_guardado'];

			}	

			}

		}
		$documentos=$listaEntregas;
		//Previamente organizamo stodos lso elementos para que dijeran aquien se hiso la entrega
		$this->set('documentos',$listaEntregas);




	/* Contenido de las evaluaciones */
		$opciones = array(
	    	'conditions' => 
	            array(
	                'Evaluacion.detalles_entrega_id' => $detalle_entrega['Detalleentrega']['id'],
	           	),
           	'order' => array('Evaluacion.id desc'),
           	'recursive'=>'0'
	   	);
		$evaluaciones=$this->Evaluacion->find('all', $opciones);
		//print_r($evaluaciones);
		/* Ahora Se procede a Asignar a cada item los comentarios respectivos */		
		$opciones = array(
	    	'conditions' => 
	            array(
	                'Rol.id !=' => 3
	           	),
           	'order' => array('Rol.nombre desc'),
	   	);
	   	$contador=1;
		foreach ($maquetarMostrar as $Item) {
			//print_r($Item);
			$maquetarMostrar[$contador]['comentario']="Sin comentarios";
			$maquetarMostrar[$contador]['id_comentario']=0;
			$maquetarMostrar[$contador]['concepto']="No Aprobado";
			$maquetarMostrar[$contador]['color']="882222";
			foreach ($evaluaciones as $evaluacion) 
			{
				# Validar si ese comentario pertenece a un detemrinado item
				if($Item['item_documento_id']==$evaluacion['Evaluacion']['items_documento_id'])
				{
					//echo $evaluacion['Evaluacion']['comentarios'];
					$maquetarMostrar[$contador]['comentario']=$evaluacion['Evaluacion']['comentarios'];
					$maquetarMostrar[$contador]['id_comentario']=$evaluacion['Evaluacion']['id'];
					$maquetarMostrar[$contador]['concepto']=$evaluacion['Parametro']['nombre'];
					$maquetarMostrar[$contador]['id_concepto']=$evaluacion['Parametro']['id'];
					$maquetarMostrar[$contador]['color']=$evaluacion['Parametro']['valor'];
					#Ahora tenemos que presentar el boton de aprobaod no aprobado o aprobado con corecciones
				}
			}
			++$contador;
		}


		$roles=$this->Rol->find('list', $opciones);
		$this->set('descomposiciones',$maquetarMostrar);
		$this->set('tiposestandares',$tiposestandares);
		$this->set('documentos',$documentos);
		$this->set('anclasItems',$anclasItems);
		$this->set('roles',$roles);
	}

	public function comparar_documento($id = null)
	{	
		if ($this->request->is('post')) 
		{
			$this->request->data['Documento']['id_primero'];
			$this->request->data['Documento']['id_segundo'];

			$options = array('conditions' => array('Detalleentrega.' . $this->Documento->primaryKey => $this->request->data['Documento']['id_primero']));
			$detalle_entrega=$this->Detalleentrega->find('first', $options);
			$id=$detalle_entrega['Entrega']['documento_id'];
			$this->set('persona1',$this->Persona->find('first', array('conditions'=>array('Persona.id'=>$detalle_entrega['PersonasProyecto']['persona_id']))));
			$primerDocumento=$detalle_entrega['Detalleentrega']['id'];
			$this->set('idPrimerDocumento',$primerDocumento);


			$optiones = array('conditions' => array('Detalleentrega.' . $this->Documento->primaryKey => $this->request->data['Documento']['id_segundo']));
			$detalle_entrega2=$this->Detalleentrega->find('first', $optiones);
			$segundo=$detalle_entrega2['Entrega']['documento_id'];
			$this->set('persona2',$this->Persona->find('first', array('conditions'=>array('Persona.id'=>$detalle_entrega2['PersonasProyecto']['persona_id']))));
			$segundoDocumento=$detalle_entrega2['Detalleentrega']['id'];
			$this->set('idSegundoDocumento',$segundoDocumento);

		}else
		{
			$options = array('conditions' => array('Detalleentrega.' . $this->Documento->primaryKey => $id));
			$detalle_entrega=$this->Detalleentrega->find('first', $options);
			$id=$detalle_entrega['Entrega']['documento_id'];
			$segundo=$id;
			$this->set('idPrimerDocumento',$id);
			$this->set('idSegundoDocumento',$id);
			$this->set('persona2',$this->Persona->find('first', array('conditions'=>array('Persona.id'=>$detalle_entrega['PersonasProyecto']['persona_id']))));
			$this->set('persona1',$this->Persona->find('first', array('conditions'=>array('Persona.id'=>$detalle_entrega['PersonasProyecto']['persona_id']))));
			$segundoDocumento=$detalle_entrega['Detalleentrega']['id'];
		}

		$this->Documento->recursive = 0;
		$options = array('conditions' => array('Documento.' . $this->Documento->primaryKey => $id));
		$documento=$this->Documento->find('first', $options);
		
		$this->TiposEstandar->recursive = -1;
		$opciones = array('conditions' => array('TiposEstandar.' . $this->TiposEstandar->primaryKey => $documento['Estandar']['tiposestandar_id']));
		$tipoEstandar=$this->TiposEstandar->find('first', $opciones);
		$documento['TiposEstandar']=$tipoEstandar['TiposEstandar'];

		$proyecto = $documento;
		$this->PersonasProyecto->recursive = -1;
		$opciones = array(
		    	'joins' => array(
			        array(
			            'table' => 'personas',
			            'alias' => 'Persona',
			            'type' => 'INNER',
			            'conditions' => 
			            array(
			                'Persona.id = PersonasProyecto.persona_id'
		            	)
		        	)
	    		),
		    	'fields' => array('Persona.id','Persona.nombre','Persona.apellido','PersonasProyecto.rol_id'),
		    	'conditions' => 
		            array(
		                'PersonasProyecto.proyecto_id' => $proyecto['Proyecto']['id'],
		           	),
	           	'order' => array('PersonasProyecto.rol_id asc'),		

	   	);
	   	//2
	   	$integrantes=$this->PersonasProyecto->find('all', $opciones);
	   	$proyecto['Integrantes']=$integrantes;
		$this->set('proyecto',$proyecto);
		$id_documento=$proyecto['Documento']['id'];
		$this->requestAction('documentos/maquetar_documento/'.$id_documento);
		global $maquetarMostrar;
		$anclasItems=array();
		foreach ($maquetarMostrar as $itemAnclar) 
		{
			if($itemAnclar['nivel']!=1)
			{
				$key=$itemAnclar['item_documento_id'];
				$anclasItems[$key]=$itemAnclar['titulo'];	
			}
		}
		//3
		$this->Documento->recursive = -1;
		$opciones = array(
	    	'joins' => array(
		        array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'tiposestandares',
		            'alias' => 'TiposEstandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'TiposEstandar.id = Estandar.tiposestandar_id'
	            	)
	        	)
    		),
	    	'fields' => array('TiposEstandar.id','TiposEstandar.nombre'),
	    	'conditions' => 
	            array(
	                'Documento.proyecto_id' => $proyecto['Proyecto']['id'],
	           	),
           	'order' => array('TiposEstandar.nombre asc'),
           	'group' => array('TiposEstandar.id'),		
	   	);
		$tiposestandares=$this->Documento->find('list', $opciones);
		$opciones = array(
	    	'joins' => array(
	        	array(
		            'table' => 'personas_proyectos',
		            'alias' => 'PersonaProyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Persona.id = PersonaProyecto.persona_id'
	            	)
	        	),
	        	array(
		            'table' => 'detalleentregas',
		            'alias' => 'DetalleEntrega',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'PersonaProyecto.id = DetalleEntrega.personas_proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'entregas',
		            'alias' => 'Entrega',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Entrega.id = DetalleEntrega.entrega_id'
	            	)
	        	),
	        	array(
		            'table' => 'documentos',
		            'alias' => 'Documento',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Documento.id = Entrega.documento_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	)
    		),
	    	'fields' => array('DetalleEntrega.id','Documento.fecha_guardado','Persona.id'),
	    	'conditions' => 
	            array(
	                'Proyecto.id' => $proyecto['Proyecto']['id'],
	                'Estandar.tiposestandar_id' => $proyecto['TiposEstandar']['id']
	           	),
           	'order' => array('Documento.fecha_guardado desc'),
           	'recursive'=>0
	   	);

		$entregasDocumento=$this->Persona->find('all', $opciones);



		//Personas que recibieorn los documentos
		$opciones = array(
	    	'joins' => array(
	        	array(
		            'table' => 'personas_proyectos',
		            'alias' => 'PersonaProyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Persona.id = PersonaProyecto.persona_id'
	            	)
	        	),
	        	array(
		            'table' => 'detalleentregas',
		            'alias' => 'DetalleEntrega',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'PersonaProyecto.id = DetalleEntrega.personas_proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'entregas',
		            'alias' => 'Entrega',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Entrega.id = DetalleEntrega.entrega_id'
	            	)
	        	),
	        	array(
		            'table' => 'documentos',
		            'alias' => 'Documento',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Documento.id = Entrega.documento_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	)
    		),
	    	'fields' => array('DISTINCT Persona.id','Persona.nombre','Persona.apellido'),
	    	'conditions' => 
	            array(
	                'Proyecto.id' => $proyecto['Proyecto']['id'],
	                'Estandar.tiposestandar_id' => $proyecto['TiposEstandar']['id']
	           	),
           	'order' => array('Documento.fecha_guardado desc'),
           	'recursive'=>0
	   	);

		$personas=$this->Persona->find('all', $opciones);

		$listaEntregas=array();
		foreach ($personas as $persona) 
		{
			
			foreach ($entregasDocumento as $entregaDocumento) {
				
			if($persona['Persona']['id']==$entregaDocumento['Persona']['id'])
			{
				$listaEntregas[$persona['Persona']['nombre']." ".$persona['Persona']['apellido']][$entregaDocumento['DetalleEntrega']['id']]=$entregaDocumento['Documento']['fecha_guardado'];

			}	

			}

		}
		//Previamente organizamo stodos lso elementos para que dijeran aquien se hiso la entrega
		$this->set('documentos',$listaEntregas);

		//4
	/* Contenido de las evaluaciones */
		$opciones = array(
	    	'conditions' => 
	            array(
	                'Evaluacion.detalles_entrega_id' => $detalle_entrega['Detalleentrega']['id'],
	           	),
           	'order' => array('Evaluacion.id desc'),
           	'recursive'=>'0'
	   	);
		$evaluaciones=$this->Evaluacion->find('all', $opciones);
		//print_r($evaluaciones);
		/* Ahora Se procede a Asignar a cada item los comentarios respectivos */		
		$opciones = array(
	    	'conditions' => 
	            array(
	                'Rol.id !=' => 3
	           	),
           	'order' => array('Rol.nombre desc'),
	   	);
	   	$contador=1;
		foreach ($maquetarMostrar as $Item) {
			//print_r($Item);
			$maquetarMostrar[$contador]['comentario']="Sin comentarios";
			$maquetarMostrar[$contador]['id_comentario']=0;
			$maquetarMostrar[$contador]['concepto']="No Aprobado";
			$maquetarMostrar[$contador]['color']="882222";
			foreach ($evaluaciones as $evaluacion) 
			{
				# Validar si ese comentario pertenece a un detemrinado item
				if($Item['item_documento_id']==$evaluacion['Evaluacion']['items_documento_id'])
				{
					//echo $evaluacion['Evaluacion']['comentarios'];
					$maquetarMostrar[$contador]['comentario']=$evaluacion['Evaluacion']['comentarios'];
					$maquetarMostrar[$contador]['id_comentario']=$evaluacion['Evaluacion']['id'];
					$maquetarMostrar[$contador]['concepto']=$evaluacion['Parametro']['nombre'];
					$maquetarMostrar[$contador]['id_concepto']=$evaluacion['Parametro']['id'];
					$maquetarMostrar[$contador]['color']=$evaluacion['Parametro']['valor'];
					#Ahora tenemos que presentar el boton de aprobaod no aprobado o aprobado con corecciones
				}
			}
			++$contador;
		}


		$roles=$this->Rol->find('list', $opciones);
		$this->set('descomposiciones',$maquetarMostrar);
		$this->set('tiposestandares',$tiposestandares);
		$this->set('anclasItems',$anclasItems);
		$this->set('roles',$roles);

		//Crearemos la segunda lista de items
		//La entrega 70 con el documento 108;
		$this->Documento->recursive = 0;
		$options = array('conditions' => array('Documento.' . $this->Documento->primaryKey => $segundo));
		$documento=$this->Documento->find('first', $options);
		
		$this->TiposEstandar->recursive = -1;
		$opciones = array('conditions' => array('TiposEstandar.' . $this->TiposEstandar->primaryKey => $documento['Estandar']['tiposestandar_id']));
		$tipoEstandar=$this->TiposEstandar->find('first', $opciones);
		$documento['TiposEstandar']=$tipoEstandar['TiposEstandar'];
		$proyecto = $documento;
		$this->PersonasProyecto->recursive = -1;
		$opciones = array(
		    	'joins' => array(
			        array(
			            'table' => 'personas',
			            'alias' => 'Persona',
			            'type' => 'INNER',
			            'conditions' => 
			            array(
			                'Persona.id = PersonasProyecto.persona_id'
		            	)
		        	)
	    		),
		    	'fields' => array('Persona.id','Persona.nombre','Persona.apellido','PersonasProyecto.rol_id'),
		    	'conditions' => 
		            array(
		                'PersonasProyecto.proyecto_id' => $proyecto['Proyecto']['id'],
		           	),
	           	'order' => array('PersonasProyecto.rol_id asc'),		

	   	);
	   	//3
		$integrantes=$this->PersonasProyecto->find('all', $opciones);
	   	$proyecto['Integrantes']=$integrantes;
		$id_documento=$proyecto['Documento']['id'];
		global $maquetarMostrar;
		$maquetarMostrar="";
		$this->requestAction('documentos/maquetar_documento/'.$id_documento);
		global $maquetarMostrar;
		$anclasItems=array();
		foreach ($maquetarMostrar as $itemAnclar) 
		{
			if($itemAnclar['nivel']!=1)
			{
				$key=$itemAnclar['item_documento_id'];
				$anclasItems[$key]=$itemAnclar['titulo'];	
			}
		}
		//3
		$this->Documento->recursive = -1;
		//4
		$opciones = array(
	    	'conditions' => 
	            array(
	                'Evaluacion.detalles_entrega_id' => $segundoDocumento,
	           	),
           	'order' => array('Evaluacion.id desc'),
           	'recursive'=>'0'
	   	);
		$evaluaciones=$this->Evaluacion->find('all', $opciones);
		//print_r($evaluaciones);
		/* Ahora Se procede a Asignar a cada item los comentarios respectivos */		
		$opciones = array(
	    	'conditions' => 
	            array(
	                'Rol.id !=' => 3
	           	),
           	'order' => array('Rol.nombre desc'),
	   	);
	   	$contador=1;
		foreach ($maquetarMostrar as $Item) {
			//print_r($Item);
			$maquetarMostrar[$contador]['comentario']="Sin comentarios";
			$maquetarMostrar[$contador]['id_comentario']=0;
			$maquetarMostrar[$contador]['concepto']="No Aprobado";
			$maquetarMostrar[$contador]['color']="882222";
			foreach ($evaluaciones as $evaluacion) 
			{
				# Validar si ese comentario pertenece a un detemrinado item
				if($Item['item_documento_id']==$evaluacion['Evaluacion']['items_documento_id'])
				{
					//echo $evaluacion['Evaluacion']['comentarios'];
					$maquetarMostrar[$contador]['comentario']=$evaluacion['Evaluacion']['comentarios'];
					$maquetarMostrar[$contador]['id_comentario']=$evaluacion['Evaluacion']['id'];
					$maquetarMostrar[$contador]['concepto']=$evaluacion['Parametro']['nombre'];
					$maquetarMostrar[$contador]['id_concepto']=$evaluacion['Parametro']['id'];
					$maquetarMostrar[$contador]['color']=$evaluacion['Parametro']['valor'];
					#Ahora tenemos que presentar el boton de aprobaod no aprobado o aprobado con corecciones
				}
			}
			++$contador;
		}
		$this->set('descomposiciones2',$maquetarMostrar);



	}


	public function lista_comparaciones()
	{
		$proyecto=$this->request->data['Documento']['Proyecto'];
		$estandar=$this->request->data['Documento']['tipodocumento'];
		$opciones = array(
	    	'joins' => array(
	        	array(
		            'table' => 'personas_proyectos',
		            'alias' => 'PersonaProyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Persona.id = PersonaProyecto.persona_id'
	            	)
	        	),
	        	array(
		            'table' => 'detalleentregas',
		            'alias' => 'DetalleEntrega',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'PersonaProyecto.id = DetalleEntrega.personas_proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'entregas',
		            'alias' => 'Entrega',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Entrega.id = DetalleEntrega.entrega_id'
	            	)
	        	),
	        	array(
		            'table' => 'documentos',
		            'alias' => 'Documento',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Documento.id = Entrega.documento_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	)
    		),
	    	'fields' => array('DetalleEntrega.id','Documento.fecha_guardado','Persona.id'),
	    	'conditions' => 
	            array(
	                'Proyecto.id' => $proyecto,
	                'Estandar.tiposestandar_id' => $estandar
	           	),
           	'order' => array('Documento.fecha_guardado desc'),
           	'recursive'=>0
	   	);

		$entregasDocumento=$this->Persona->find('all', $opciones);

		//Personas que recibieorn los documentos
		$opciones = array(
	    	'joins' => array(
	        	array(
		            'table' => 'personas_proyectos',
		            'alias' => 'PersonaProyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Persona.id = PersonaProyecto.persona_id'
	            	)
	        	),
	        	array(
		            'table' => 'detalleentregas',
		            'alias' => 'DetalleEntrega',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'PersonaProyecto.id = DetalleEntrega.personas_proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'entregas',
		            'alias' => 'Entrega',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Entrega.id = DetalleEntrega.entrega_id'
	            	)
	        	),
	        	array(
		            'table' => 'documentos',
		            'alias' => 'Documento',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Documento.id = Entrega.documento_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	)
    		),
	    	'fields' => array('DISTINCT Persona.id','Persona.nombre','Persona.apellido'),
	    	'conditions' => 
	            array(
	                'Proyecto.id' => $proyecto,
	                'Estandar.tiposestandar_id' => $estandar
	           	),
           	'order' => array('Documento.fecha_guardado desc'),
           	'recursive'=>0
	   	);

		$personas=$this->Persona->find('all', $opciones);

		$listaEntregas=array();
		foreach ($personas as $persona) 
		{
			
			foreach ($entregasDocumento as $entregaDocumento) {
				
			if($persona['Persona']['id']==$entregaDocumento['Persona']['id'])
			{
				$listaEntregas[$persona['Persona']['nombre']." ".$persona['Persona']['apellido']][$entregaDocumento['DetalleEntrega']['id']]=$entregaDocumento['Documento']['fecha_guardado'];

			}	

			}

		}
		//Previamente organizamo stodos lso elementos para que dijeran aquien se hiso la entrega
		$this->set('documentos',$listaEntregas);

	}


	public function evaluacion_docente($id = null)
	{	
		if (!$this->Detalleentrega->exists($id)) 
		{
			$this->redirect($this->referer());			
		}
		if ($this->request->is('post')) 
		{
			$id=$this->request->data['DetalleEntrega']['documento']; 
			$this->redirect(array('action' => 'evaluacion_dual',$id));
		}
		if(isset($id))
		{
			//COnsultar los detalles de la entrega para msotrar la información
			$options = array('conditions' => array('Detalleentrega.' . $this->Documento->primaryKey => $id));
			$detalle_entrega=$this->Detalleentrega->find('first', $options);
			$this->set('detalleentrega',$detalle_entrega);
			$id=$detalle_entrega['Entrega']['documento_id'];
			if($detalle_entrega['Detalleentrega']['estado_id']==1)
			{
				$this->Detalleentrega->create();
				$detalleentregag=array();
				$detalleentregag['Detalleentrega']['id']=$detalle_entrega['Detalleentrega']['id'];
				$detalleentregag['Detalleentrega']['estado_id']=2;
				$detalleentregag['Detalleentrega']['fecha_estado']=date('Y-m-d');
				if($this->Detalleentrega->save($detalleentregag))
				{
					
					//Se crea la notificación
					

				}
			}
		}

		$this->Documento->recursive = 0;
		$options = array('conditions' => array('Documento.' . $this->Documento->primaryKey => $id));
		$documento=$this->Documento->find('first', $options);
		$this->TiposEstandar->recursive = -1;
		$opciones = array('conditions' => array('TiposEstandar.' . $this->TiposEstandar->primaryKey => $documento['Estandar']['tiposestandar_id']));
		$tipoEstandar=$this->TiposEstandar->find('first', $opciones);
		$documento['TiposEstandar']=$tipoEstandar['TiposEstandar'];
		$proyecto = $documento;
		$this->PersonasProyecto->recursive = -1;
		$opciones = array(
		    	'joins' => array(
			        array(
			            'table' => 'personas',
			            'alias' => 'Persona',
			            'type' => 'INNER',
			            'conditions' => 
			            array(
			                'Persona.id = PersonasProyecto.persona_id'
		            	)
		        	)
	    		),
		    	'fields' => array('Persona.id','Persona.nombre','Persona.apellido','PersonasProyecto.rol_id'),
		    	'conditions' => 
		            array(
		                'PersonasProyecto.proyecto_id' => $proyecto['Proyecto']['id'],
		           	),
	           	'order' => array('PersonasProyecto.rol_id asc'),		

	   	);
	   	$integrantes=$this->PersonasProyecto->find('all', $opciones);
	   	$proyecto['Integrantes']=$integrantes;
		$this->set('proyecto',$proyecto);
		$id_documento=$proyecto['Documento']['id'];
		$this->requestAction('documentos/maquetar_documento/'.$id_documento);
		global $maquetarMostrar;
		$anclasItems=array();
		foreach ($maquetarMostrar as $itemAnclar) 
		{
			if($itemAnclar['nivel']!=1)
			{
				$key=$itemAnclar['item_documento_id'];
				$anclasItems[$key]=$itemAnclar['titulo'];	
			}
		}
		$this->Documento->recursive = -1;
		$opciones = array(
	    	'joins' => array(
		        array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'tiposestandares',
		            'alias' => 'TiposEstandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'TiposEstandar.id = Estandar.tiposestandar_id'
	            	)
	        	)
    		),
	    	'fields' => array('TiposEstandar.id','TiposEstandar.nombre'),
	    	'conditions' => 
	            array(
	                'Documento.proyecto_id' => $proyecto['Proyecto']['id'],
	           	),
           	'order' => array('TiposEstandar.nombre asc'),
           	'group' => array('TiposEstandar.id'),		
	   	);
		$tiposestandares=$this->Documento->find('list', $opciones);
		$opciones = array(
	    	'joins' => array(
		        array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'tiposestandares',
		            'alias' => 'TiposEstandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'TiposEstandar.id = Estandar.tiposestandar_id'
	            	)
	        	)
    		),
	    	'fields' => array('Documento.id','Documento.fecha_guardado'),
	    	'conditions' => 
	            array(
	                'Documento.proyecto_id' => $proyecto['Proyecto']['id'],
	                'Estandar.id' => $proyecto['TiposEstandar']['id']
	           	),
           	'order' => array('Documento.fecha_guardado desc'),
	   	);
		$documentos=$this->Documento->find('list', $opciones);
	/* Contenido de las evaluaciones */
		$opciones = array(
	    	'conditions' => 
	            array(
	                'Evaluacion.detalles_entrega_id' => $detalle_entrega['Detalleentrega']['id'],
	           	),
           	'order' => array('Evaluacion.id desc'),
           	'recursive'=>'0'
	   	);
		$evaluaciones=$this->Evaluacion->find('all', $opciones);
		//print_r($evaluaciones);
		/* Ahora Se procede a Asignar a cada item los comentarios respectivos */		
		$opciones = array(
	    	'conditions' => 
	            array(
	                'Rol.id !=' => 3
	           	),
           	'order' => array('Rol.nombre desc'),
	   	);
	   	$contador=1;
		foreach ($maquetarMostrar as $Item) {
			//print_r($Item);
			$maquetarMostrar[$contador]['comentario']="Sin comentarios";
			$maquetarMostrar[$contador]['id_comentario']=0;
			$maquetarMostrar[$contador]['concepto']="No Aprobado";
			$maquetarMostrar[$contador]['id_concepto']="No Aprobado";
			$maquetarMostrar[$contador]['color']="882222";
			foreach ($evaluaciones as $evaluacion) 
			{
				# Validar si ese comentario pertenece a un detemrinado item
				if($Item['item_documento_id']==$evaluacion['Evaluacion']['items_documento_id'])
				{
					//echo $evaluacion['Evaluacion']['comentarios'];
					$maquetarMostrar[$contador]['comentario']=$evaluacion['Evaluacion']['comentarios'];
					$maquetarMostrar[$contador]['id_comentario']=$evaluacion['Evaluacion']['id'];
					$maquetarMostrar[$contador]['concepto']=$evaluacion['Parametro']['nombre'];
					$maquetarMostrar[$contador]['id_concepto']=$evaluacion['Parametro']['id'];
					$maquetarMostrar[$contador]['color']=$evaluacion['Parametro']['valor'];
					#Ahora tenemos que presentar el boton de aprobaod no aprobado o aprobado con corecciones
				}
			}
			++$contador;
		}


		$roles=$this->Rol->find('list', $opciones);
		$this->set('descomposiciones',$maquetarMostrar);
		$this->set('detalleEntrega',$detalle_entrega);
		$this->set('tiposestandares',$tiposestandares);
		$this->set('documentos',$documentos);
		$this->set('anclasItems',$anclasItems);
		$this->set('roles',$roles);
	}

	public function evaluacion_dual()
	{	
		if ($this->request->is('post')) 
		{
			$this->request->data['Documento']['id_primero'];
			$this->request->data['Documento']['id_segundo'];

			$options = array('conditions' => array('Detalleentrega.' . $this->Documento->primaryKey => $this->request->data['Documento']['id_primero']));
			$detalle_entrega=$this->Detalleentrega->find('first', $options);
			$id=$detalle_entrega['Entrega']['documento_id'];
			$this->set('persona1',$this->Persona->find('first', array('conditions'=>array('Persona.id'=>$detalle_entrega['PersonasProyecto']['persona_id']))));
			$primerDocumento=$detalle_entrega['Detalleentrega']['id'];
			$this->set('idPrimerDocumento',$primerDocumento);

			$options = array('conditions' => array('Detalleentrega.id'=> $primerDocumento));
			$detalle_entrega=$this->Detalleentrega->find('first', $options);

			$this->set('detalleentrega',$detalle_entrega);


			$optiones = array('conditions' => array('Detalleentrega.' . $this->Documento->primaryKey => $this->request->data['Documento']['id_segundo']));
			$detalle_entrega2=$this->Detalleentrega->find('first', $optiones);
			$segundo=$detalle_entrega2['Entrega']['documento_id'];
			$this->set('persona2',$this->Persona->find('first', array('conditions'=>array('Persona.id'=>$detalle_entrega2['PersonasProyecto']['persona_id']))));
			$segundoDocumento=$detalle_entrega2['Detalleentrega']['id'];
			$this->set('idSegundoDocumento',$segundoDocumento);

		}else
		{
			$options = array('conditions' => array('Detalleentrega.' . $this->Documento->primaryKey => $id));
			$detalle_entrega=$this->Detalleentrega->find('first', $options);
			$id=$detalle_entrega['Entrega']['documento_id'];
			$segundo=$id;
			$this->set('idPrimerDocumento',$id);
			$this->set('idSegundoDocumento',$id);
			$this->set('persona2',$this->Persona->find('first', array('conditions'=>array('Persona.id'=>$detalle_entrega['PersonasProyecto']['persona_id']))));
			$this->set('persona1',$this->Persona->find('first', array('conditions'=>array('Persona.id'=>$detalle_entrega['PersonasProyecto']['persona_id']))));
			$segundoDocumento=$detalle_entrega['Detalleentrega']['id'];
		}

		$this->Documento->recursive = 0;
		$options = array('conditions' => array('Documento.' . $this->Documento->primaryKey => $id));
		$documento=$this->Documento->find('first', $options);
		
		$this->TiposEstandar->recursive = -1;
		$opciones = array('conditions' => array('TiposEstandar.' . $this->TiposEstandar->primaryKey => $documento['Estandar']['tiposestandar_id']));
		$tipoEstandar=$this->TiposEstandar->find('first', $opciones);
		$documento['TiposEstandar']=$tipoEstandar['TiposEstandar'];

		$proyecto = $documento;
		$this->PersonasProyecto->recursive = -1;
		$opciones = array(
		    	'joins' => array(
			        array(
			            'table' => 'personas',
			            'alias' => 'Persona',
			            'type' => 'INNER',
			            'conditions' => 
			            array(
			                'Persona.id = PersonasProyecto.persona_id'
		            	)
		        	)
	    		),
		    	'fields' => array('Persona.id','Persona.nombre','Persona.apellido','PersonasProyecto.rol_id'),
		    	'conditions' => 
		            array(
		                'PersonasProyecto.proyecto_id' => $proyecto['Proyecto']['id'],
		           	),
	           	'order' => array('PersonasProyecto.rol_id asc'),		

	   	);
	   	//2
	   	$integrantes=$this->PersonasProyecto->find('all', $opciones);
	   	$proyecto['Integrantes']=$integrantes;
		$this->set('proyecto',$proyecto);
		$id_documento=$proyecto['Documento']['id'];
		$this->requestAction('documentos/maquetar_documento/'.$id_documento);
		global $maquetarMostrar;
		$anclasItems=array();
		foreach ($maquetarMostrar as $itemAnclar) 
		{
			if($itemAnclar['nivel']!=1)
			{
				$key=$itemAnclar['item_documento_id'];
				$anclasItems[$key]=$itemAnclar['titulo'];	
			}
		}
		//3
		$this->Documento->recursive = -1;
		$opciones = array(
	    	'joins' => array(
		        array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'tiposestandares',
		            'alias' => 'TiposEstandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'TiposEstandar.id = Estandar.tiposestandar_id'
	            	)
	        	)
    		),
	    	'fields' => array('TiposEstandar.id','TiposEstandar.nombre'),
	    	'conditions' => 
	            array(
	                'Documento.proyecto_id' => $proyecto['Proyecto']['id'],
	           	),
           	'order' => array('TiposEstandar.nombre asc'),
           	'group' => array('TiposEstandar.id'),		
	   	);
		$tiposestandares=$this->Documento->find('list', $opciones);
		$opciones = array(
	    	'joins' => array(
	        	array(
		            'table' => 'personas_proyectos',
		            'alias' => 'PersonaProyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Persona.id = PersonaProyecto.persona_id'
	            	)
	        	),
	        	array(
		            'table' => 'detalleentregas',
		            'alias' => 'DetalleEntrega',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'PersonaProyecto.id = DetalleEntrega.personas_proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'entregas',
		            'alias' => 'Entrega',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Entrega.id = DetalleEntrega.entrega_id'
	            	)
	        	),
	        	array(
		            'table' => 'documentos',
		            'alias' => 'Documento',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Documento.id = Entrega.documento_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	)
    		),
	    	'fields' => array('DetalleEntrega.id','Documento.fecha_guardado','Persona.id'),
	    	'conditions' => 
	            array(
	                'Proyecto.id' => $proyecto['Proyecto']['id'],
	                'Estandar.tiposestandar_id' => $proyecto['TiposEstandar']['id']
	           	),
           	'order' => array('Documento.fecha_guardado desc'),
           	'recursive'=>0
	   	);

		$entregasDocumento=$this->Persona->find('all', $opciones);



		//Personas que recibieorn los documentos
		$opciones = array(
	    	'joins' => array(
	        	array(
		            'table' => 'personas_proyectos',
		            'alias' => 'PersonaProyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Persona.id = PersonaProyecto.persona_id'
	            	)
	        	),
	        	array(
		            'table' => 'detalleentregas',
		            'alias' => 'DetalleEntrega',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'PersonaProyecto.id = DetalleEntrega.personas_proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'entregas',
		            'alias' => 'Entrega',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Entrega.id = DetalleEntrega.entrega_id'
	            	)
	        	),
	        	array(
		            'table' => 'documentos',
		            'alias' => 'Documento',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Documento.id = Entrega.documento_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	)
    		),
	    	'fields' => array('DISTINCT Persona.id','Persona.nombre','Persona.apellido'),
	    	'conditions' => 
	            array(
	                'Proyecto.id' => $proyecto['Proyecto']['id'],
	                'Estandar.tiposestandar_id' => $proyecto['TiposEstandar']['id']
	           	),
           	'order' => array('Documento.fecha_guardado desc'),
           	'recursive'=>0
	   	);

		$personas=$this->Persona->find('all', $opciones);

		$listaEntregas=array();
		foreach ($personas as $persona) 
		{
			
			foreach ($entregasDocumento as $entregaDocumento) {
				
			if($persona['Persona']['id']==$entregaDocumento['Persona']['id'])
			{
				$listaEntregas[$persona['Persona']['nombre']." ".$persona['Persona']['apellido']][$entregaDocumento['DetalleEntrega']['id']]=$entregaDocumento['Documento']['fecha_guardado'];

			}	

			}

		}
		//Previamente organizamo stodos lso elementos para que dijeran aquien se hiso la entrega
		$this->set('documentos',$listaEntregas);

		//4
	/* Contenido de las evaluaciones */
		$opciones = array(
	    	'conditions' => 
	            array(
	                'Evaluacion.detalles_entrega_id' => $detalle_entrega['Detalleentrega']['id'],
	           	),
           	'order' => array('Evaluacion.id desc'),
           	'recursive'=>'0'
	   	);
		$evaluaciones=$this->Evaluacion->find('all', $opciones);
		//print_r($evaluaciones);
		/* Ahora Se procede a Asignar a cada item los comentarios respectivos */		
		$opciones = array(
	    	'conditions' => 
	            array(
	                'Rol.id !=' => 3
	           	),
           	'order' => array('Rol.nombre desc'),
	   	);
	   	$contador=1;
		foreach ($maquetarMostrar as $Item) {
			//print_r($Item);
			$maquetarMostrar[$contador]['comentario']="Sin comentarios";
			$maquetarMostrar[$contador]['id_comentario']=0;
			$maquetarMostrar[$contador]['concepto']="No Aprobado";
			$maquetarMostrar[$contador]['color']="882222";
			foreach ($evaluaciones as $evaluacion) 
			{
				# Validar si ese comentario pertenece a un detemrinado item
				if($Item['item_documento_id']==$evaluacion['Evaluacion']['items_documento_id'])
				{
					//echo $evaluacion['Evaluacion']['comentarios'];
					$maquetarMostrar[$contador]['comentario']=$evaluacion['Evaluacion']['comentarios'];
					$maquetarMostrar[$contador]['id_comentario']=$evaluacion['Evaluacion']['id'];
					$maquetarMostrar[$contador]['concepto']=$evaluacion['Parametro']['nombre'];
					$maquetarMostrar[$contador]['id_concepto']=$evaluacion['Parametro']['id'];
					$maquetarMostrar[$contador]['color']=$evaluacion['Parametro']['valor'];
					#Ahora tenemos que presentar el boton de aprobaod no aprobado o aprobado con corecciones
				}
			}
			++$contador;
		}


		$roles=$this->Rol->find('list', $opciones);
		$this->set('descomposiciones',$maquetarMostrar);
		$this->set('tiposestandares',$tiposestandares);
		$this->set('anclasItems',$anclasItems);
		$this->set('roles',$roles);

		//Crearemos la segunda lista de items
		//La entrega 70 con el documento 108;
		$this->Documento->recursive = 0;
		$options = array('conditions' => array('Documento.' . $this->Documento->primaryKey => $segundo));
		$documento=$this->Documento->find('first', $options);
		
		$this->TiposEstandar->recursive = -1;
		$opciones = array('conditions' => array('TiposEstandar.' . $this->TiposEstandar->primaryKey => $documento['Estandar']['tiposestandar_id']));
		$tipoEstandar=$this->TiposEstandar->find('first', $opciones);
		$documento['TiposEstandar']=$tipoEstandar['TiposEstandar'];
		$proyecto = $documento;
		$this->PersonasProyecto->recursive = -1;
		$opciones = array(
		    	'joins' => array(
			        array(
			            'table' => 'personas',
			            'alias' => 'Persona',
			            'type' => 'INNER',
			            'conditions' => 
			            array(
			                'Persona.id = PersonasProyecto.persona_id'
		            	)
		        	)
	    		),
		    	'fields' => array('Persona.id','Persona.nombre','Persona.apellido','PersonasProyecto.rol_id'),
		    	'conditions' => 
		            array(
		                'PersonasProyecto.proyecto_id' => $proyecto['Proyecto']['id'],
		           	),
	           	'order' => array('PersonasProyecto.rol_id asc'),		

	   	);
	   	//3
		$integrantes=$this->PersonasProyecto->find('all', $opciones);
	   	$proyecto['Integrantes']=$integrantes;
		$id_documento=$proyecto['Documento']['id'];
		global $maquetarMostrar;
		$maquetarMostrar="";
		$this->requestAction('documentos/maquetar_documento/'.$id_documento);
		global $maquetarMostrar;
		$anclasItems=array();
		foreach ($maquetarMostrar as $itemAnclar) 
		{
			if($itemAnclar['nivel']!=1)
			{
				$key=$itemAnclar['item_documento_id'];
				$anclasItems[$key]=$itemAnclar['titulo'];	
			}
		}
		//3
		$this->Documento->recursive = -1;
		//4
		$opciones = array(
	    	'conditions' => 
	            array(
	                'Evaluacion.detalles_entrega_id' => $segundoDocumento,
	           	),
           	'order' => array('Evaluacion.id desc'),
           	'recursive'=>'0'
	   	);
		$evaluaciones=$this->Evaluacion->find('all', $opciones);
		//print_r($evaluaciones);
		/* Ahora Se procede a Asignar a cada item los comentarios respectivos */		
		$opciones = array(
	    	'conditions' => 
	            array(
	                'Rol.id !=' => 3
	           	),
           	'order' => array('Rol.nombre desc'),
	   	);
	   	$contador=1;
		foreach ($maquetarMostrar as $Item) {
			//print_r($Item);
			$maquetarMostrar[$contador]['comentario']="Sin comentarios";
			$maquetarMostrar[$contador]['id_comentario']=0;
			$maquetarMostrar[$contador]['concepto']="No Aprobado";
			$maquetarMostrar[$contador]['color']="882222";
			foreach ($evaluaciones as $evaluacion) 
			{
				# Validar si ese comentario pertenece a un detemrinado item
				if($Item['item_documento_id']==$evaluacion['Evaluacion']['items_documento_id'])
				{
					//echo $evaluacion['Evaluacion']['comentarios'];
					$maquetarMostrar[$contador]['comentario']=$evaluacion['Evaluacion']['comentarios'];
					$maquetarMostrar[$contador]['id_comentario']=$evaluacion['Evaluacion']['id'];
					$maquetarMostrar[$contador]['concepto']=$evaluacion['Parametro']['nombre'];
					$maquetarMostrar[$contador]['id_concepto']=$evaluacion['Parametro']['id'];
					$maquetarMostrar[$contador]['color']=$evaluacion['Parametro']['valor'];
					#Ahora tenemos que presentar el boton de aprobaod no aprobado o aprobado con corecciones
				}
			}
			++$contador;
		}
		$this->set('descomposiciones2',$maquetarMostrar);
	}


	public function actualizar_comentario()
	{
		$this->autoRender = false;
		$respuesta=array();
		$respuesta['Evaluacion']['id']=$_POST['id'];
		
		
		if($_POST['titulo']!=null)
		{
			$respuesta['Evaluacion']['comentarios']=$_POST['titulo'];
		}
		if($_POST['concepto']!=null)
		{
			$respuesta['Evaluacion']['parametro_concepto_id']=$_POST['concepto'];
			echo "cocnetp indef";
		}
		print_r($_POST);
		print_r($respuesta['Evaluacion']);
		$this->Evaluacion->save($respuesta);
		//Funcion para actualizar comentarios de manera asincrona
	}





	public function view($id = null) {
		if (!$this->Documento->exists($id)) {
			throw new NotFoundException(__('Invalid documento'));
		}
		$options = array('conditions' => array('Documento.' . $this->Documento->primaryKey => $id));
		$this->set('documento', $this->Documento->find('first', $options));
	}

	public function subir_documento($id = null) 
	{
		$proyecto_id=$id;
		$fecha = date_create();
		$fecha = date_format($fecha, 'Y-m-d H:i:s');
		$this->request->data['Documento']['fecha_guardado']=$fecha;
		$this->request->data['Documento']['proyecto_id']=$proyecto_id;
		if ($this->request->is('post')) 
		{
			$this->Documento->create();
			if( $this->data['Documento']['documentoxml']['error'] == 0 &&  $this->data['Documento']['documentoxml']['size'] > 0)
			{
				if ($this->Documento->save($this->request->data)) 
				{
					$destino = WWW_ROOT."files/documentos//".$this->Documento->id."".DS;
					mkdir($destino);
					if(move_uploaded_file($this->data['Documento']['documentoxml']['tmp_name'], $destino."documentoxml.xml"))
					{               
						$this->Session->setFlash(__('El documento se ha subido exitosamente'));
						$this->redirect(array('action' => 'descomponer_documento',$this->Documento->id));
					}
					else
					{
						$this->Session->setFlash(__('El documento no se ha podido subir, por favor intentelo de nuevo'));       
					}
				} 
				else 
				{
					$this->Session->setFlash(__('El documento no se ha registrado correctamente, por favor intente de nuevo.'));
				}

			}		 
		}
		$opciones= array('conditions' => array('Proyecto.id' => $proyecto_id));
		$proyecto=  $this->Proyecto->find('first',$opciones);
		$this->set(compact('proyecto'));
		$usuario=$this->Session->read("Usuario");
		if($usuario['nivel_id']==1 || $usuario['nivel_id']==2 || $usuario['nivel_id']==3 || $usuario['nivel_id']==5 )
		{
			$opciones= array(
				'conditions' => array(
					'Estandar.programa_id' => $proyecto['Proyecto']['programa'],
					'Estandar.tiposestandar_id'=>$proyecto['Proyecto']['estado_id']
				),
				'fields'=>array(
					'Estandar.id','Tiposestandar.nombre'
				),
				'recursive'=>0
			);
			$estandares = $this->Documento->Estandar->find('list',$opciones);
		}
		$this->set(compact('estandares'));
	}

	public function edit($id = null) {
		if (!$this->Documento->exists($id)) {
			throw new NotFoundException(__('Invalid documento'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Documento->save($this->request->data)) {
				$this->Session->setFlash(__('The documento has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The documento could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Documento.' . $this->Documento->primaryKey => $id));
			$this->request->data = $this->Documento->find('first', $options);
		}
	}

	public function generar_comentarios($id_detalle_entrega=null)
	{
		$this->autoRender = false;
		$this->request->data['Evalacion']['detalle_entrega_id']=$id_detalle_entrega;
		$id=$this->request->data['Evalacion']['detalle_entrega_id'];
		$id_detalle_entrega=$this->request->data['Evalacion']['detalle_entrega_id'];
		$options = array('conditions' => array('Detalleentrega.' . $this->Documento->primaryKey => $id));
			$detalle_entrega=$this->Detalleentrega->find('first', $options);
			$id=$detalle_entrega['Entrega']['documento_id'];
		if (!$this->Detalleentrega->exists($this->request->data['Evalacion']['detalle_entrega_id'])) 
		{
			throw new NotFoundException(__('Invalid documento'));
		}

		$this->Documento->recursive = 0;
		$options = array('conditions' => array('Documento.' . $this->Documento->primaryKey => $id));
		$documento=$this->Documento->find('first', $options);
		$this->TiposEstandar->recursive = -1;
		$opciones = array('conditions' => array('TiposEstandar.' . $this->TiposEstandar->primaryKey => $documento['Estandar']['tiposestandar_id']));
		$tipoEstandar=$this->TiposEstandar->find('first', $opciones);
		$documento['TiposEstandar']=$tipoEstandar['TiposEstandar'];
		$proyecto = $documento;
		$this->PersonasProyecto->recursive = -1;
		$opciones = array(
		    	'joins' => array(
			        array(
			            'table' => 'personas',
			            'alias' => 'Persona',
			            'type' => 'INNER',
			            'conditions' => 
			            array(
			                'Persona.id = PersonasProyecto.persona_id'
		            	)
		        	)
	    		),
		    	'fields' => array('Persona.id','Persona.nombre','Persona.apellido','PersonasProyecto.rol_id'),
		    	'conditions' => 
		            array(
		                'PersonasProyecto.proyecto_id' => $proyecto['Proyecto']['id'],
		           	),
	           	'order' => array('PersonasProyecto.rol_id asc'),		

	   	);
	   	$integrantes=$this->PersonasProyecto->find('all', $opciones);
	   	$proyecto['Integrantes']=$integrantes;
		$this->set('proyecto',$proyecto);
		$id_documento=$proyecto['Documento']['id'];
		$this->requestAction('documentos/maquetar_documento/'.$id_documento);
		global $maquetarMostrar;
		$anclasItems=array();
		foreach ($maquetarMostrar as $itemAnclar) 
		{
			if($itemAnclar['nivel']!=1)
			{
				$key=$itemAnclar['item_documento_id'];
				$anclasItems[$key]=$itemAnclar['titulo'];	
			}
		}
		$this->Documento->recursive = -1;
		$opciones = array(
	    	'joins' => array(
		        array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'tiposestandares',
		            'alias' => 'TiposEstandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'TiposEstandar.id = Estandar.tiposestandar_id'
	            	)
	        	)
    		),
	    	'fields' => array('TiposEstandar.id','TiposEstandar.nombre'),
	    	'conditions' => 
	            array(
	                'Documento.proyecto_id' => $proyecto['Proyecto']['id'],
	           	),
           	'order' => array('TiposEstandar.nombre asc'),
           	'group' => array('TiposEstandar.id'),		
	   	);
		$tiposestandares=$this->Documento->find('list', $opciones);
		$opciones = array(
	    	'joins' => array(
		        array(
		            'table' => 'proyectos',
		            'alias' => 'Proyecto',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Proyecto.id = Documento.proyecto_id'
	            	)
	        	),
	        	array(
		            'table' => 'estandares',
		            'alias' => 'Estandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Estandar.id = Documento.estandar_id'
	            	)
	        	),
	        	array(
		            'table' => 'tiposestandares',
		            'alias' => 'TiposEstandar',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'TiposEstandar.id = Estandar.tiposestandar_id'
	            	)
	        	)
    		),
	    	'fields' => array('Documento.id','Documento.fecha_guardado'),
	    	'conditions' => 
	            array(
	                'Documento.proyecto_id' => $proyecto['Proyecto']['id'],
	                'Estandar.id' => $proyecto['TiposEstandar']['id']
	           	),
           	'order' => array('Documento.fecha_guardado desc'),
	   	);
		$documentos=$this->Documento->find('list', $opciones);
	/* Contenido de las evaluaciones */

	   	//
	   	$evaluacion=array();
	   	
	   	
	   	$contador=1;
		foreach ($maquetarMostrar as $Item) {
			//print_r($Item);
			//$maquetarMostrar[$contador]['comentario']="Sin comentarios";
			//$maquetarMostrar[$contador]['id_comentario']=0;
			//$maquetarMostrar[$contador]['concepto']="No Aprobado";
		//	$maquetarMostrar[$contador]['color']="882222";

			$evaluacion['Evaluacion']['items_documento_id']=$Item['item_documento_id'];
		   	$evaluacion['Evaluacion']['detalles_entrega_id']=$id_detalle_entrega;
		   	$evaluacion['Evaluacion']['parametro_concepto_id']=3;
		   	$evaluacion['Evaluacion']['comentarios']="";
		   	$this->Evaluacion->create();
		   	if($this->Evaluacion->save($evaluacion)){
		   		$maquetarMostrar[$contador]['comentario']="";
				$maquetarMostrar[$contador]['id_comentario']=$this->Evaluacion->id;
				$maquetarMostrar[$contador]['concepto']="No aprobado";
				$maquetarMostrar[$contador]['color']="882222";
		   	}


			++$contador;
		}

		$opciones = array(
	    	'conditions' => 
	            array(
	                'Rol.id !=' => 3
	           	),
           	'order' => array('Rol.nombre desc'),
	   	);

		$roles=$this->Rol->find('list', $opciones);
		$this->set('descomposiciones',$maquetarMostrar);
		$this->set('tiposestandares',$tiposestandares);
		$this->set('documentos',$documentos);
		$this->set('anclasItems',$anclasItems);
		$this->set('roles',$roles);










		


	}

	public function delete($id = null) {
		$this->Documento->id = $id;
		if (!$this->Documento->exists()) {
			throw new NotFoundException(__('Invalid documento'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Documento->delete()) {
			$this->Session->setFlash(__('Documento deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Documento was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
