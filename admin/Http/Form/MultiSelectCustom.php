<?php

namespace Admin\Form\Element;

use SleepingOwl\Admin\Form\Element\MultiSelect;

class MultiSelectCustom extends MultiSelect
{
    public function __construct($path, $label = null, $options = [])
    {
        $this->setView('admin::forms.multiselect');
        parent::__construct($path, $label, $options );
    }
}
