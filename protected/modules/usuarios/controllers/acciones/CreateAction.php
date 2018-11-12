<?php
class CreateAction extends CAction
{
    public function run()
    {
        $model=new SofintUsers;

            // uncomment the following code to enable ajax-based validation
            /*
            if(isset($_POST['ajax']) && $_POST['ajax']==='sofint-users-_form-form')
            {
                echo CActiveForm::validate($model);
                Yii::app()->end();
            }
            */

            if(isset($_POST['SofintUsers']))
            {
                $model->attributes=$_POST['SofintUsers'];
                if($model->validate())
                {
                    // form inputs are valid, do something here
                    return;
                }
            }
            $this->controller->render('_form',array('model'=>$model));
    }
}
?>
