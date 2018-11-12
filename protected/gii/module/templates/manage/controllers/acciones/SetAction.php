<?php echo "<?php\n"; ?>
class SetAction extends CAction
{
    public function run()
    {        
        $model = Model::model()->findByPk($_POST['Model']['ID']);//Reemplazar con el modelo que corresponda con el modulo
        
        if(empty($model))
        {
            $model=new Model; //Reemplazar con el modelo que corresponda con el modulo
        }
        
        
        if(isset($_POST['Model']))//Reemplazar con el modelo que corresponda con el modulo
        {
            $model->attributes=$_POST['Model'];//Reemplazar con el modelo que corresponda con el modulo
            if($model->validate())
            {
                if($model->save())
                    {
                        $this->controller->redirect(array('index'));
                    }
            }
        }
    }
}
<?php echo "?>\n"; ?>