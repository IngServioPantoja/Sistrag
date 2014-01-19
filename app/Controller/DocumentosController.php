<?php
App::uses('AppController', 'Controller');
ini_set('default_charset','utf-8');
ini_set('memory_limit', '-2');	
class DocumentosController extends AppController {
	var $components = array("RequestHandler");
	var $helpers = array('Html');  // include the HTML helper
	var $uses = array('Documento','Estandar','Proyecto','Item','ItemsEstandar');
	var $items=array();
	var	$DatosXML="";
	var $descomposiciones=array();
	var $documento_id=0;

		function obtenerItems($itemPadre,$estandar_id)
		{	global $items;
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
			    	'fields' => array('ItemsEstandar.id','Item.nombre'),
			    	'conditions' => 
			            array(
			                'ItemsEstandar.items_estandar_id' => $itemPadre,
			                'ItemsEstandar.estandar_id' => $estandar_id
			           	),
		           	'order' => array('ItemsEstandar.orden asc'),		

		   	);

			$itemsConsultar = $this->ItemsEstandar->find('list',$opciones);
			if (is_array($itemsConsultar)) 
			{
				foreach ($itemsConsultar as $item => $value) {
						$arrayTemporal=array();
						$arrayTemporal['id']=$item;
						$arrayTemporal['titulo']=$value;
						$items[]=$arrayTemporal;			
						$this->requestAction('documentos/obtenerItems/'.$item.'/'.$estandar_id.'');
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
		        else if($banderaImg==1 && $Etiqueta['tag'] == "PKG:BINARYDATA" && $Etiqueta['type'][' complete'])
		        {   
		            return $Etiqueta['value'];
		        }

		    }
		}

		function quitar_tildes($cadena) 
		{
			$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
			$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
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
		    global $documento_id;
		    $documento_id;
		    $directorio = WWW_ROOT.'files\documentos\\'.$documento_id.'\\';
	        $nombreArchivo=$directorio."arraytxt.php";
	        $archivo=fopen($nombreArchivo,"a") or die("Problemas en la creacion del arraytxt");
	        $contenido='<?php $arraytxt=array();';
	        fputs($archivo,$contenido);
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
	                if($Etiqueta['tag'] == "W:T" && $Etiqueta['type'] == "complete" && strtolower(quitar_tildes($Etiqueta['value'])) == strtolower(quitar_tildes($items[$itemkey]['titulo'])))
	                {
  						$items[$itemkey]['titulo']=strtolower($items[$itemkey]['titulo']);	
	                   //Acabamos de encontrar el texto dentro del tag 
	                    $item =$Etiqueta['value'];
	                    $banderaA=1;
	                    $banderaB=1;
	                    $banderaC=0;
	                }
	            }else if($banderaA==1 && $banderaB==1){
	                //entramos aqui para buscar el seguntag del texto y cambiar al bandera para comenzar a caputara datos
	                if($Etiqueta['tag'] == "W:T" && $Etiqueta['type'] == "complete" && $Etiqueta['value'] == "||"){
	                   //Acabamos de encontrar el texto dentro del tag 
	                    $item = strtolower($Etiqueta['value']);
	                    $banderaA=2;
	                    $banderaB=1;
	                    $banderaC=1;
	                    $contenido=' $arraytxt['.$itemkey.']["id"]='.$items[$itemkey]['id'].';';
	                    fputs($archivo,$contenido);
	                    $contenido=' $arraytxt['.$itemkey.']["titulo"]="'.$items[$itemkey]['titulo'].'";';
	                    fputs($archivo,$contenido);
	                    $contenido=' $arraytxt['.$itemkey.']["contenido"]['.$contenidoKey.']["elementos"]=" ";';
	                    fputs($archivo,$contenido);
	                    $contenido=' $arraytxt['.$itemkey.']["contenido"]['.$contenidoKey.']["tipo"]="'."Titulo".'";';
	                    fputs($archivo,$contenido);
	                    $descomposiciones["$itemkey"]['id']=$items[$itemkey]['id'];
	                    $descomposiciones["$itemkey"]['titulo']=$items[$itemkey]['titulo'];
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']="";
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['tipo']="Titulo";
	                    $esTitulo=1;
	                }
	            }else if($banderaA==2 && $banderaB==1 && $banderaC==1){
	                //entramos aqui para adicionar el texto de lo encontrado
	                if($Etiqueta['tag'] == "W:T" && $Etiqueta['type'] == "complete" && $Etiqueta['value'] =="||")
	                {	
	                    //tipos de entrada : 1 texto 2 figura, tabla  y 3 fuente y 4 pie de pagina
	                    $banderaA=1;
	                    $banderaB=0;
	                    $banderaC=0;
	                    $itemkey=$itemkey+1;
	                    $contenidoKey=0;
	                   //Acabamos de encontrar el texto dentro del tag 
	                }
	                else if($Etiqueta['tag'] == "W:T" && $Etiqueta['type'] == "complete" && strstr(strtolower($Etiqueta['value']),"figura ")){
	                    if(!isset($descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']))
	                    {
	                    $contenido=' $arraytxt['.$itemkey.']["contenido"]['.$contenidoKey.']["elementos"]=" ";';
	                    fputs($archivo,$contenido);                    
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']="";
	                    }
	                    $esTitulo=0;
	                    $contenido=' $arraytxt['.$itemkey.']["contenido"]['.$contenidoKey.']["tipo"]="Figura";';
	                    fputs($archivo,$contenido); 
	                    $contenido=' $arraytxt['.$itemkey.']["contenido"]['.$contenidoKey.']["elementos"]="'.$descomposiciones["$itemkey"]["contenido"][$contenidoKey]["elementos"].$Etiqueta["value"].'";';
	                    fputs($archivo,$contenido); 
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['tipo']="Figura";
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']=$descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos'].$Etiqueta['value'];
	                }
	                else if($Etiqueta['tag'] == "W:T" && $Etiqueta['type'] == "complete" && strstr(strtolower($Etiqueta['value']),"tabla ")){
	                    if(!isset($descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']))
	                    {
	                    $contenido=' $arraytxt['.$itemkey.']["contenido"]['.$contenidoKey.']["elementos"]=" ";';
	                    fputs($archivo,$contenido); 
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']="";
	                    }
	                    $esTitulo=0;
	                    $contenido=' $arraytxt['.$itemkey.']["contenido"]['.$contenidoKey.']["tipo"]="Tabla";';
	                    fputs($archivo,$contenido); 
	                    $contenido=' $arraytxt['.$itemkey.']["contenido"]['.$contenidoKey.']["elementos"]="'.$descomposiciones["$itemkey"]["contenido"][$contenidoKey]["elementos"].$Etiqueta["value"].'";';
	                    fputs($archivo,$contenido);
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['tipo']="Tabla";
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']=$descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos'].$Etiqueta['value'];
	                }
	                else if($Etiqueta['tag'] == "V:IMAGEDATA" && $Etiqueta['type'] == "complete"){
	                    if(!isset($descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']))
	                    {
	                    $contenido=' $arraytxt['.$itemkey.']["contenido"]['.$contenidoKey.']["elementos"]=" ";';
	                    fputs($archivo,$contenido); 
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']="";
	                    }
	                    $esTitulo=0;
	                    $contenido=' $arraytxt['.$itemkey.']["contenido"]['.$contenidoKey.']["tipo"]="Imagen";';
	                    fputs($archivo,$contenido); 
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['tipo']="Imagen";
	                    $id=$Etiqueta['attributes']['R:ID'];
	                    $nameImagen=getImagen($id);
	                    $codigoImg=getImagenCode($nameImagen);
	                    $imagen=convertirImagen($codigoImg);
	                    ++$contadorImg;
	                    $fileName=WWW_ROOT.'files/documentos//'.$documento_id.'//'.$contadorImg.".png";
	                    $file=fopen($fileName,"a") or die("Problemas");
	                    fputs($file,$imagen);
	                    fclose($file);
	                    $contenido=' $arraytxt['.$itemkey.']["contenido"]['.$contenidoKey.']["elementos"]="'.$descomposiciones["$itemkey"]["contenido"][$contenidoKey]["elementos"].$documento_id.'/'.$contadorImg.'.png";';
	                    fputs($archivo,$contenido);
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']=
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos'].$documento_id.'/'.$contadorImg.'.png';
	                }
	                else if($Etiqueta['tag'] == "W:T" && $Etiqueta['type'] == "complete" && strstr(strtolower($Etiqueta['value']),"fuente:")){
	                    if(!isset($descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']))
	                    {
	                    $contenido=' $arraytxt['.$itemkey.']["contenido"]['.$contenidoKey.']["elementos"]=" ";';
	                    fputs($archivo,$contenido); 
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']="";
	                    }
	                    $esTitulo=0;
	                    $contenido=' $arraytxt['.$itemkey.']["contenido"]['.$contenidoKey.']["tipo"]="Fuente";';
	                    fputs($archivo,$contenido); 
	                    $contenido=' $arraytxt['.$itemkey.']["contenido"]['.$contenidoKey.']["elementos"]="'.$descomposiciones["$itemkey"]["contenido"][$contenidoKey]["elementos"].$Etiqueta["value"].'";';
	                    fputs($archivo,$contenido);
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['tipo']="Fuente";
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']=$descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos'].$Etiqueta['value'];
	                }
	                else if($Etiqueta['tag'] == "W:T" && $Etiqueta['type'] == "complete"){
	                    if(!isset($descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']))
	                    {
	                    $contenido=' $arraytxt['.$itemkey.']["contenido"]['.$contenidoKey.']["elementos"]=" ";';
	                    fputs($archivo,$contenido);                 
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']="";
	                    }
	                    $esTitulo=0;
	                    $contenido=' $arraytxt['.$itemkey.']["contenido"]['.$contenidoKey.']["tipo"]="Texto";';
	                    fputs($archivo,$contenido); 
	                    $contenido=' $arraytxt['.$itemkey.']["contenido"]['.$contenidoKey.']["elementos"]="'.$descomposiciones["$itemkey"]["contenido"][$contenidoKey]["elementos"].$Etiqueta["value"].'";';
	                    fputs($archivo,$contenido);
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['tipo']="texto";
	                    $descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos']=$descomposiciones["$itemkey"]['contenido'][$contenidoKey]['elementos'].$Etiqueta['value'];
	                }
	            }
	        }
		$contenido=' ?>';
		fputs($archivo,$contenido); 
		fclose($archivo);
		}
		MostrarDatosXML();

		global $descomposiciones;
		//print_r($descomposiciones);
		$this->set('descomposiciones',$descomposiciones);
	}

	public function index() {
		$this->Documento->recursive = 0;
		$this->set('documentos', $this->paginate());
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
		print_r($this->data);
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
		if($usuario['nivel_id']==1)
		{
			$estandares = $this->Documento->Estandar->find('list');
		}
		else if($usuario['nivel_id']==2 || $usuario['nivel_id']==3 )
		{
			$opciones= array('conditions' => array('Estandar.programa_id' => $usuario['Persona']['programa_id']));
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
