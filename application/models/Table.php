<?php

namespace application\models;

use application\core\Model;

class Table extends Model
{
    public function drawTable($rows, $cols, $color)
    {
        $table = "";
        if ($rows == "") $rows = 10;
        if ($cols == "") $cols = 10;
        if ($color == "") $color = 'yellow';

        $table .= "<table border=\"1\" class=\"table table-bordered\">";
        for ($tr = 1; $tr <= $rows; $tr++) {
            $table .= "<tr>";
            for ($td = 1; $td <= $cols; $td++) {
                if ($tr == 1 or $td == 1) {
                    $table .= "<td style=\"background-color: $color;\">" . $tr * $td . "</td>";
                } else {
                    $table .= "<td>" . $tr * $td . "</td>";
                }
            }
            $table .= "</tr>";
        }
        $table .= "</table>";

        return $table;
    }
}

