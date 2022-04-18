<?php

use App\Models\IndustriesModel;

function per_page()
{
    return 15;
}

function getIndustryName($id)
{
    $data = IndustriesModel::where('id', $id)->first();

    return isset($data) ? $data->name : '';
}
