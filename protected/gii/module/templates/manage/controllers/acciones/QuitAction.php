<?php echo "<?php\n"; ?>
class QuitAction extends CAction
{
    public function run()
    {        
        $item = $_GET['item'];
        Model::model()->deleteByPk($item);//Reemplazar Model por Modelo trabajado
        $this->controller->redirect(array('index'));
    }
}
<?php echo "?>\n"; ?>

