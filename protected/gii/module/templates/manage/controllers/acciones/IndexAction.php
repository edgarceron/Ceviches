<?php echo "<?php"; ?>
/**
 * Rederiza la vista Index del manejador dependiendo del 
 * modulo ingresado.
 * @package +++ Reemplazar por el paquete principal
 * @subpackage +++ Reemplazar por el subpaquete
 * @author Edgar Mauricio Ceron / Module generator
 * @author +++ Reemplazar con el autor que realice modificaciones adicionales
 */

class IndexAction extends CAction
{
    /**
     * Corre la accion IndexAction. 
     * Aqui descripcion
     * @uses $_POST['empresa']
     */
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        if(!isset($_GET['item']))
        {
            $model = new Model;
        }
        else
        {
            $model = Model::model()->findByPk($_GET['item']);
            if(empty($model))
            {
                $model = new Model;
            }
        }
    
        
        $modelview=new Model('search'); //Reemplaze Model por el modelo adecuado para este modulo
        $modelview->unsetAttributes();  // clear any default values
        if(isset($_GET['Model']))//Reemplaze Model por el modelo adecuado para este modulo
                $modelview->attributes=$_GET['Model'];//Reemplaze Model por el modelo adecuado para este modulo

        $this->controller->render('index',array(
                'model'=>$model,
                'modelview'=>$modelview,
        ));
    }
    
    /**
     * Retorna un String con un los campos de busqueda correspondiente a un
     * arreglo de atributos. 
     * @param static[] $atributos array con los atributos de un modelo
     * @return String con el codigo php y html del search a generar
     */
    public function generarSearch($atributos){
        $campos = '';
        foreach($atributos as $campo){
            $campos = $campos.'<div class="col-lg-6">'; //Clase responsive para el from control
            $campos = $campos.'<?php echo $form->label($model,"'.$campo.'", array("class"=>"label label-neutra")); ?>';
            $campos = $campos.'$form->textField($model,"'.$campo.'",array("class"=>"form-control"));';
            $campos = $campos.'</td>';
        }
    }
}
<?php echo "?>"; ?>

