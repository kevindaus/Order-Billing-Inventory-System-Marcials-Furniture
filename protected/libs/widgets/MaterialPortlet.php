<?php
Yii::import('zii.widgets.CPortlet');

/**
 * Class MaterialPortlet
 * @property $material_model Material
 */
class MaterialPortlet extends CPortlet
{
    public $material_model;

    public function init()
    {
        
        $updateLink = CHtml::link('<i class="icon-pencil"></i> Update', array('update', 'id' => $this->material_model->id), array());
        $deleteLink = CHtml::link('<i class="icon-trash"></i> Delete', array('delete', 'id' => $this->material_model->id), array('confirm'=>"Are you sure you want to delete this record ?"));
        $this->title = <<<EOL
    <div>
        <div class="btn-group" style="float:right">
          <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="icon-cog"></span><span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
                $updateLink
            </li>
            <li>
                $deleteLink
            </li>
          </ul>
        </div>
        <div class='clearfix'></div>
    </div>
EOL;
        parent::init();
    }

}