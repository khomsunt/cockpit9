<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
class chartController extends Controller
{
    public function index(){
    $chart = Charts::create('pie', 'fusioncharts')
        ->title('Pie Chart')
        ->colors(['#FFD700','#33CC33','#FF6347','#0000CD','#006400','#FF3399'])
        ->labels(['First', 'Second', 'Third', 'Quad', 'Peta'])
        ->values([5,10,20,10,3])
        ->dimensions(1000,500)
        ->responsive(false);

    $chart2 = Charts::create('bar', 'fusioncharts')
        ->title('Bar Chart')
        ->colors(['#FFCC00'])
        ->elementLabel('Testing')
        ->labels(['First', 'Second', 'Third', 'Fifth'])
        ->values([10,7,5,19])
        ->dimensions(1000,500)
        ->responsive(false)->library('highcharts');

    $chart_mul = Charts::multi('bar', 'fusioncharts')
        ->title("Multi Chart")
        ->dimensions(0, 400)
        // ->template("material")
        ->colors(['#FFD700','#33CC33','#FF6347','#0000CD','#006400','#FF3399'])
        ->dataset('Element 1', [100,20,100])
        ->dataset('Element 2', [15,30,80])
        ->dataset('Element 3', [25,5,40])
        ->dataset('Element 4', [8,100,50])
        ->dataset('Element 5', [25,30,6])
        ->labels(['One', 'Two', 'Three']);

    $chart_donut = Charts::create('donut', 'fusioncharts')
        ->title('Donut Chart')
        ->labels(['First', 'Second', 'Third'])
        ->values([5,10,20])
        ->dimensions(1000,500)
        ->responsive(false);

    $chart_line = Charts::create('line', 'fusioncharts')
        ->title('Line Chart')
        ->elementLabel('My nice label')
        ->labels(['First', 'Second', 'Third','Fourth','Fifth','Sixth','Seventh'])
        ->values([0,5,2,20,15])
        ->dimensions(1000,500)
        ->responsive(false);

    $areaspline = Charts::multi('areaspline', 'highcharts')
        ->title('Areaspline Chart')
        ->colors(['#FF4500', '#00FF00', '#00FFFF'])
        ->labels(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday','Saturday', 'Sunday'])
        ->dataset('John', [3, 4, 3, 5, 4, 10, 12])
        ->dataset('Jane',  [1, 3, 4, 3, 10, 5, 4])
        ->dataset('Jejee',  [5, 12, 2, 7, 3, 5, 4]);


    return view('test.chart', ['chart' => $chart, 'chart2' => $chart2, 'chart_donut' => $chart_donut, 'chart_line' => $chart_line, 'areaspline' => $areaspline, 'chart_mul' => $chart_mul]);
    }
}
