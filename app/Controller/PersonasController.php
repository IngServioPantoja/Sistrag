<?php
App::uses('AppController', 'Controller');
ini_set("gd.jpeg_ignore_warning", 1);
class PersonasController extends AppController {
var $helpers = array('Form', 'Html', 'Js','Paginator');
public $paginate = array(
        'limit'=>20
    );
var $uses = array('Persona','User','Facultad','Programa','Tipousuario','Nivel');

	public function add() {
		
		function redimensionarImagen($direccion,$anchon,$alton,$extension)
		{
			switch($extension)
			{	
				case 'JPEG':
					$original = ImageCreateFromJPEG($direccion."1.".$extension)or die ("error en la imagen");
					break;
				case 'JPG':
					$original = ImageCreateFromJPEG($direccion."1.".$extension)or die ("error en la imagen");
					break;
				case 'jpg':
					$original = ImageCreateFromJPEG($direccion."1.".$extension)or die ("error en la imagen");
					break;
				case 'PNG':
					$original = imagecreatefrompng($direccion."1.".$extension)or die ("error en la imagen");
					break;
				case 'png':
					$original = imagecreatefrompng($direccion."1.".$extension)or die ("error en la imagen");
					break;
				case 'gif':
					$original = imagecreatefromgif($direccion."1.".$extension)or die ("error en la imagen");
					break;
				default:
					$original = ImageCreateFromJPEG($direccion."1.".$extension)or die ("error en la imagen");
					break;
			}

			$max_ancho = $anchon;
			$max_alto = $alton;
			//Recoger ancho y alto de la original
			list($ancho,$alto)=getimagesize($direccion."1.".$extension);
			//Calcular proporción ancho y alto
			$x_ratio = $max_ancho / $ancho;
			$y_ratio = $max_alto / $alto;
			if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
			//Si es más pequeña que el máximo no redimensionamos
			$ancho_final = $ancho;
			$alto_final = $alto;
			}
			//si no calculamos si es más alta o más ancha y redimensionamos
			else if (($x_ratio * $alto) < $max_alto){
			$alto_final = ceil($x_ratio * $alto);
			$ancho_final = $max_ancho;
			}
			else{
			$ancho_final = ceil($y_ratio * $ancho);
			$alto_final = $max_alto;
			}
			//Creamos un lienzo para pintar y especificamos alto y ancho
			$lienzo = imagecreatetruecolor($ancho_final,$alto_final);
			//Decimos que todo aquello que pongamos encima del lienzo lo va a remplazar
			imagealphablending($lienzo,false); 
			//Creamos el color transparente
			$transparente = imagecolorallocatealpha($lienzo, 0, 0, 0, 0xff/2);
			//Creamos un rectagulos que pocicionaremos sobre nuestro lienzo y como resultado
			//nos da un lienzo transparente
			imagefilledrectangle ( $lienzo , 0 , 0 , 1000, 1000  , $transparente );
			//No se para que es to la verdad...
			imagesavealpha($lienzo,true);
			//FUsionamos la imagen de origen en el lienzo transparente
			imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho, $alto);
			$cal=90;
			if($anchon>=$alton)
			{
				$namepx=$anchon;
			}
			else
			{
				$namepx=$alton;
			}

			switch($extension)
			{	
				case 'JPEG':
					imagejpeg($lienzo,$direccion."1_".$namepx.".png",$cal);
					break;
				case 'JPG':
					imagejpeg($lienzo,$direccion."1_".$namepx.".png",$cal);
					break;
				case 'jpg':
					imagejpeg($lienzo,$direccion."1_".$namepx.".png",$cal);
					break;
				case 'PNG':
					imagepng($lienzo,$direccion."1_".$namepx.".png",1);
					break;
				case 'png':
					imagepng($lienzo,$direccion."1_".$namepx.".png",1);
					break;
				case 'gif':
					imagegif($lienzo,$direccion."1_".$namepx.".png",1);
					break;
				default:
					imagejpeg($lienzo,$direccion."1_".$namepx.".png",$cal);
					break;
			}
			imagedestroy($original);
			imagedestroy($lienzo);
		}

		if ($this->request->is('post')) 
		{
			if($this->request->data['User']['password']==$this->request->data['User']['rpassword'])
			{
				if(isset($this->request->data['Persona']['programa_id']))
				{
					$opciones = array(
				    	'conditions' => 
				            array(
				                'Programa.id'=>$this->request->data['Persona']['programa_id']
				           	)
			   		);
					$facultad = $this->Programa->find('first',$opciones);
					$this->request->data['Persona']['facultad_id']=$facultad['Programa']['facultad_id'];
				}
				$this->Persona->create();
				$this->User->create();
				if(isset($this->request->data['Persona']['avatar']))
				{	
					$avatar=$this->data['Persona']['avatar'];
					$this->request->data['Persona']['avatar']="1.jpg";
					$trozos = explode(".", $avatar['name']); 
					$extension = end($trozos); 
				}
				else
				{
					$this->request->data['Persona']['avatar']="escudo400.png";
				}
				if($extension!='bmp')
				{	
					$this->request->data['User']['password']=Security::hash($this->request->data['User']['password'], null, true);
					if ($this->Persona->User->saveall($this->request->data)) 
					{
						$destino = WWW_ROOT."img/img_subida/usuarios/".$this->Persona->id."".DS;
						mkdir($destino);
						if(isset($this->request->data['Persona']['avatar']))
						{	
							if( $avatar['error'] == 0 &&  $avatar['size'] > 0)
							{
								if(move_uploaded_file($avatar['tmp_name'],$destino."1.".$extension))
								{	
									redimensionarImagen($destino,64,64,$extension);
									redimensionarImagen($destino,400,400,$extension);
									unlink($destino."1.".$extension);
								}
								
							}
						}
						$this->Session->setFlash(__('El usuario ha sido registrado exitosamente'));
						return $this->redirect(array('action' => 'index'));
					}
					else
					{
						$this->Session->setFlash(__('No se ha podido registrar el Usuario intente de nuevo'));
					}
				}
				else
				{
					$this->Session->setFlash(__('Solo se permiten imagenes de formato .png .gif .jpg'));
				}
			}
			else
			{
				$this->Session->setFlash(__('Las contraseñas son diferentes intente de nuevo'));
			}
		}
		$usuario=$this->Session->read("Usuario");
		$id_persona=$usuario['Persona']['id'];
		//Flujo para presentar todos los elementos del formulario
		//Administrados institucional
		$opciones = array('conditions' => array('Tiposusuario.id >='=> $usuario['nivel_id']));
		$tiposusuarios = $this->Persona->Tiposusuario->find('list',$opciones);
		$opciones = array('conditions' => array('Nivel.id >='=> $usuario['nivel_id']));
		$niveles = $this->Nivel->find('list',$opciones);



		$this->set(compact('tiposusuarios', 'niveles'));
	}

	public function delete($id = null) {
		$this->Persona->id = $id;
		if (!$this->Persona->exists()) {
			throw new NotFoundException(__('Invalid persona'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Persona->delete()) {
			$this->Session->setFlash(__('El usuario ha sido borrado exitosamente'));
		} else {
			$this->Session->setFlash(__('No se ha podido borrar el usuario intente de nuevo'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function editarContrasena($id = null) 
	{
		if (!$this->Persona->exists($id)) {
			throw new NotFoundException(__('Invalid persona'));
		}
		if ($this->request->is(array('post', 'put'))) 
		{
			$this->Session->setFlash(__('Contraseña actualizada satisfactoriamente'));
			$this->request->data['User']['password']=Security::hash($this->request->data['User']['password'], null, true);
			if($this->User->save($this->request->data))
			{
				$this->Session->setFlash(__('Contraseña actualizada satisfactoriamente'));
				return $this->redirect(array('action' => 'view/'.$id));
			}else
			{

				$this->Session->setFlash(__('Ha ocurrido un error al actualizar la contraseñ intente nuevamente'));
			}

		}else
		{
			$options = array('conditions' => array('User.persona_id'=> $id));
			$user = $this->User->find('first', $options);
			$this->request->data = $user;
			$this->set('persona',$user);
		}
	}

	public function edit($id = null) {
		
		function redimensionarImagen($direccion,$anchon,$alton,$extension)
		{
			switch($extension)
			{	
				case 'JPEG':
					$original = ImageCreateFromJPEG($direccion."1.".$extension)or die ("error en la imagen");
					break;
				case 'JPG':
					$original = ImageCreateFromJPEG($direccion."1.".$extension)or die ("error en la imagen");
					break;
				case 'jpg':
					$original = ImageCreateFromJPEG($direccion."1.".$extension)or die ("error en la imagen");
					break;
				case 'PNG':
					$original = imagecreatefrompng($direccion."1.".$extension)or die ("error en la imagen");
					break;
				case 'png':
					$original = imagecreatefrompng($direccion."1.".$extension)or die ("error en la imagen");
					break;
				case 'gif':
					$original = imagecreatefromgif($direccion."1.".$extension)or die ("error en la imagen");
					break;
				default:
					$original = ImageCreateFromJPEG($direccion."1.".$extension)or die ("error en la imagen");
					break;
			}

			$max_ancho = $anchon;
			$max_alto = $alton;
			//Recoger ancho y alto de la original
			list($ancho,$alto)=getimagesize($direccion."1.".$extension);
			//Calcular proporción ancho y alto
			$x_ratio = $max_ancho / $ancho;
			$y_ratio = $max_alto / $alto;
			if( ($ancho <= $max_ancho) && ($alto <= $max_alto) ){
			//Si es más pequeña que el máximo no redimensionamos
			$ancho_final = $ancho;
			$alto_final = $alto;
			}
			//si no calculamos si es más alta o más ancha y redimensionamos
			else if (($x_ratio * $alto) < $max_alto){
			$alto_final = ceil($x_ratio * $alto);
			$ancho_final = $max_ancho;
			}
			else{
			$ancho_final = ceil($y_ratio * $ancho);
			$alto_final = $max_alto;
			}
			//Creamos un lienzo para pintar y especificamos alto y ancho
			$lienzo = imagecreatetruecolor($ancho_final,$alto_final);
			//Decimos que todo aquello que pongamos encima del lienzo lo va a remplazar
			imagealphablending($lienzo,false); 
			//Creamos el color transparente
			$transparente = imagecolorallocatealpha($lienzo, 0, 0, 0, 0xff/2);
			//Creamos un rectagulos que pocicionaremos sobre nuestro lienzo y como resultado
			//nos da un lienzo transparente
			imagefilledrectangle ( $lienzo , 0 , 0 , 1000, 1000  , $transparente );
			//No se para que es to la verdad...
			imagesavealpha($lienzo,true);
			//FUsionamos la imagen de origen en el lienzo transparente
			imagecopyresampled($lienzo,$original,0,0,0,0,$ancho_final, $alto_final,$ancho, $alto);
			$cal=90;
			if($anchon>=$alton)
			{
				$namepx=$anchon;
			}
			else
			{
				$namepx=$alton;
			}

			switch($extension)
			{	
				case 'JPEG':
					imagejpeg($lienzo,$direccion."1_".$namepx.".png",$cal);
					break;
				case 'JPG':
					imagejpeg($lienzo,$direccion."1_".$namepx.".png",$cal);
					break;
				case 'jpg':
					imagejpeg($lienzo,$direccion."1_".$namepx.".png",$cal);
					break;
				case 'PNG':
					imagepng($lienzo,$direccion."1_".$namepx.".png",1);
					break;
				case 'png':
					imagepng($lienzo,$direccion."1_".$namepx.".png",1);
					break;
				case 'gif':
					imagegif($lienzo,$direccion."1_".$namepx.".png",1);
					break;
				default:
					imagejpeg($lienzo,$direccion."1_".$namepx.".png",$cal);
					break;
			}
			imagedestroy($original);
			imagedestroy($lienzo);
		}

		if (!$this->Persona->exists($id)) {
			throw new NotFoundException(__('Invalid persona'));
		}
		if ($this->request->is(array('post', 'put'))) 
		{
			if(isset($this->request->data['Persona']['programa_id']))
			{
				$opciones = array(
			    	'conditions' => 
			            array(
			                'Programa.id'=>$this->request->data['Persona']['programa_id']
			           	),
			        'recursive'=>0
		   		);
				$facultad = $this->Programa->find('first',$opciones);
				$this->request->data['Persona']['facultad_id']=$facultad['Programa']['facultad_id'];
			}
			$this->Persona->create();
			$this->User->create();
			if(isset($this->request->data['Persona']['avatar']))
			{
				$avatar=$this->data['Persona']['avatar'];
				$this->request->data['Persona']['avatar']="1.jpg";
				$trozos = explode(".", $avatar['name']); 
				$extension = end($trozos); 
			}
			if($extension!='bmp')
			{	
				if ($this->Persona->User->saveall($this->request->data)) 
				{	
					if(isset($this->request->data['Persona']['avatar']))
					{	
						if( $avatar['error'] == 0 &&  $avatar['size'] > 0)
						{	
							$destino = WWW_ROOT."img/img_subida/usuarios/".$this->request->data['Persona']['id']."".DS;
							if (file_exists($destino)) 
							{

							}else
							{
								mkdir($destino);
							}
							if(move_uploaded_file($avatar['tmp_name'],$destino."1.".$extension))
							{	
								redimensionarImagen($destino,64,64,$extension);
								redimensionarImagen($destino,400,400,$extension);
								unlink($destino."1.".$extension);
							}
							
						}
					}
					$this->Session->setFlash(__('El usuario ha sido actualizado exitosamente'));
					return $this->redirect(array('action' => 'index'));
				}
				else
				{
					$this->Session->setFlash(__('No se ha podido registrar el Usuario intente de nuevo'));
				}
			}

		} 
		else 
		{
			$options = array('conditions' => array('User.persona_id'=> $id));
			$user = $this->User->find('first', $options);
			$this->request->data = $user;
			$this->set('persona',$user);
		}
		$programas = $this->Persona->Programa->find('list');
		$usuario=$this->Session->read("Usuario");
		$id_persona=$usuario['Persona']['id'];
		//Flujo para presentar todos los elementos del formulario
		//Administrados institucional
		$opciones = array('conditions' => array('Tiposusuario.id >='=> $usuario['nivel_id']));
		$tiposusuarios = $this->Persona->Tiposusuario->find('list',$opciones);
		$opciones = array('conditions' => array('Nivel.id >='=> $usuario['nivel_id']));
		$niveles = $this->Nivel->find('list',$opciones);
		$this->set(compact('programas', 'tiposusuarios', 'proyectos','niveles'));
	}

	public function index($atributo=null,$valor=null) 
	{	
		$this->Persona->recursive = 0;
		if(isset($this->request->data['Busqueda']))
		{ 
			if($this->request->data['Busqueda']['atributo']!=NULL and $this->request->data['Busqueda']['valor']!=NULL)
			{
				$opciones=array('Persona.'.$this->request->data['Busqueda']['atributo'].' LIKE' => '%'.$this->request->data['Busqueda']['valor'].'%');
				$personas = $this->paginate('Persona',$opciones);
				if (empty($personas)) 
				{
					$this->set('encontrado',0);
				}
			}
			else
			{
    			$personas = $this->paginate('Persona');		
    		}
    		$busqueda=array();
    		$busqueda[0]['atributo']=$this->request->data['Busqueda']['atributo'];
    		$busqueda[0]['valor']=$this->request->data['Busqueda']['valor'];
    		$this->set('busqueda',$busqueda);
		}
		else
		{	
			if(isset($atributo) and isset($valor))
			{
				$opciones=array('Persona.'.$atributo.' LIKE' => '%'.$valor.'%');
	    		$personas = $this->paginate('Persona',$opciones);
	    		$busqueda[0]['atributo']=$atributo;
    			$busqueda[0]['valor']=$valor;	
    			$this->set('busqueda',$busqueda);	
    		}
    		else
    		{
	    		$personas = $this->paginate('Persona');			
    		}
    	}
   		$this->set('personas',$personas);
		if($this->request->is('ajax'))    	
		{

			$this->render('/personas/index');
		}
	}

	function lista_asociaciones() 
	{
		$select_entrada=NULL;
		$foreign=NULL;
		$asociacion=NULL;
		if(isset($this->request->data['Persona']['tiposusuario_id']))
		{
			if ($this->request->data['Persona']['tiposusuario_id']==1) 
			{
				//Soy un administrador institucional
				$select_entrada=NULL;
				$foreign=NULL;
				$asociacion=NULL;
			}
			else if($this->request->data['Persona']['tiposusuario_id']==2)
			{
				//Soy un administrador de facultad
				$select_entrada=$this->Facultad->find('list');
				$foreign="facultad_id";
				$asociacion="Facultad";
			}
			else if($this->request->data['Persona']['tiposusuario_id']==3 || $this->request->data['Persona']['tiposusuario_id']==4 || $this->request->data['Persona']['tiposusuario_id']==5)
			{
				//Soy un administrador de programa
				$select_entrada=$this->Programa->find('list');
				$foreign="programa_id";
				$asociacion="Programa";

			}
			else
			{
				//No es ninguno posible hack!!

			}
			$this->set("asociacion",$asociacion);
			$this->set("foreign",$foreign);
			$this->set(compact('select_entrada'));
		}
		$this->render('/personas/lista_asociaciones');
	}

	public function view($id = null) {
		if (!$this->Persona->exists($id)) {
			throw new NotFoundException(__('Invalid persona'));
		}
		$options = array(
			'joins' => array(
		        array(
		            'table' => 'users',
		            'alias' => 'User',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Persona.id = User.persona_id'
		            	)
		        	),
		        array(
		            'table' => 'niveles',
		            'alias' => 'Nivel',
		            'type' => 'INNER',
		            'conditions' => 
		            array(
		                'Nivel.id = User.nivel_id'
		            	)
		        	)
    		),
			'conditions' => array(
				'Persona.' . $this->Persona->primaryKey => $id),
			'fields'=>array(
				'Persona.*','Programa.*','Facultad.*','Tiposusuario.*','Nivel.*'
			),
			'recursive'=>0);
		$this->set('persona', $this->Persona->find('first', $options));
	}

}
