<?php echo "<?php\n"; ?>
class IndexAction extends CAction
{
    //Reemplazar Model por el modelo que corresponda al modulo
    public function run()
    {                           
        

        $this->controller->render('index',array(

        ));
    }
}

