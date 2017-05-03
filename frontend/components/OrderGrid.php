<?php
Yii::import('zii.widgets.grid.CGridView');

class OrderGrid extends CGridView{
    public function renderTableFooter()
    {
        echo "<tfoot>\n";


        $total = Yii::app()->cart->total(null,true);
        $subTotal = Yii::app()->cart->total();
        $shipping = Yii::app()->cart->shipping();


        // Сумма без учета доставки
        echo "<tr>\n";

        echo "<td>";
        echo "Товар";
        echo "</td>\n";

        echo "<td>";
        echo "&nbsp;";
        echo "</td>\n";

        echo "<td>";
        echo $subTotal['price']. 'р.';
        echo "</td>\n";

        echo "</tr>\n";

        // Стоимость доставки
        echo "<tr>\n";

        echo "<td id='shipping'>";
        echo "Доставка <span class='title'>".$shipping['name']."</span>";
        echo "</td>\n";

        echo "<td>";
        echo "&nbsp;";
        echo "</td>\n";

        echo "<td>";
        echo $shipping['price']. 'р.';
        echo "</td>\n";

        echo "</tr>\n";

        /// Сумма с учетом доставки
        echo "<tr>\n";

        echo "<td>";
        echo "Итого";
        echo "</td>\n";

        echo "<td>";
        echo "&nbsp;";
        echo "</td>\n";

        echo "<td>";
        echo $total['price']. 'р.';
        echo "</td>\n";

        echo "</tr>\n";
        echo "</tfoot>\n";
    }
}