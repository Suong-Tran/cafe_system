<?php

function populateDropdown($cats, $select = ""){
    $html_dropdown = "";
    foreach ($cats as $cat) {
        $selected = $select == $cat->id ? "selected" : "";
        $name = ucfirst($cat->name);
        $html_dropdown .= "<option $selected value='$cat->id'>$name</option>";
    }

    return $html_dropdown;
}
?>

