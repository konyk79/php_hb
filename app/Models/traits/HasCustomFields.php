<?php
namespace App;

trait HasCustomFields
{
    public function setFillable($data)
    {
//        $fields = \Schema::getColumnListing('table_name_here');

        $this->fillable[] = $data;
    }

}