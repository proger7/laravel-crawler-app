<?php

namespace App\Http\Controllers\Web;

use App\Models\Logs;
use App\Models\User;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;


class StatisticController extends Controller
{

	/**
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Logs::count() > 0) {
			// Line chart
		    $chart_options = [
			    'chart_title' => __('account.chart_title_1'),
			    'chart_type' => 'line',
			    'report_type' => 'group_by_date',
			    'model' => 'App\Models\Logs',

			    'group_by_field' => 'created_at',
			    'group_by_period' => 'day',

			    'aggregate_function' => 'count',
			    'aggregate_field' => 'n_parsed_qua',
			    
			    'filter_field' => 'created_at',
			    'filter_days' => 30, // show only transactions for last 30 days
			    'filter_period' => 'week', // show only transactions for this week
			    'continuous_time' => true, // show continuous timeline including dates without data
		    ];
		    $chart1 = new LaravelChart($chart_options);


			// Bar chart
		    $chart_options = [
			    'chart_title' => __('account.chart_title_2'),
			    'chart_type' => 'bar',
			    'report_type' => 'group_by_date',
			    'model' => 'App\Models\Logs',

			    'group_by_field' => 'created_at',
			    'group_by_period' => 'day',

			    'aggregate_function' => 'count',
			    'aggregate_field' => 'n_parsed_qua',
			    
			    'filter_field' => 'created_at',
			    'filter_days' => 30, // show only transactions for last 30 days
			    'filter_period' => 'week', // show only transactions for this week
			    'continuous_time' => true, // show continuous timeline including dates without data
		    ];
		    $chart2 = new LaravelChart($chart_options);


			// Pie chart
		    $chart_options = [
			    'chart_title' => __('account.chart_title_3'),
			    'chart_type' => 'pie',
			    'report_type' => 'group_by_date',
			    'model' => 'App\Models\Logs',

			    'group_by_field' => 'created_at',
			    'group_by_period' => 'day',

			    'aggregate_function' => 'count',
			    'aggregate_field' => 'n_parsed_qua',
			    
			    'filter_field' => 'created_at',
			    'filter_days' => 30, // show only transactions for last 30 days
			    'filter_period' => 'week', // show only transactions for this week
			    'continuous_time' => true, // show continuous timeline including dates without data
		    ];
		    $chart3 = new LaravelChart($chart_options);

		    // Line chart
		    $chart_options = [
			    'chart_title' => __('account.chart_title_4'),
			    'chart_type' => 'line',
			    'report_type' => 'group_by_date',
			    'model' => 'App\Models\Configurations',

			    'group_by_field' => 'created_at',
			    'group_by_period' => 'day',
			    
			    'filter_field' => 'v_site_url',
			    'filter_days' => 30, // show only transactions for last 30 days
			    'filter_period' => 'week', // show only transactions for this week
			    'continuous_time' => true, // show continuous timeline including dates without data
		    ];
		    $chart4 = new LaravelChart($chart_options);

		    // Bar chart
		    $chart_options = [
			    'chart_title' => __('account.chart_title_5'),
			    'chart_type' => 'bar',
			    'report_type' => 'group_by_date',
			    'model' => 'App\Models\Configurations',

			    'group_by_field' => 'created_at',
			    'group_by_period' => 'day',
			    
			    'filter_field' => 'v_site_url',
			    'filter_days' => 30, // show only transactions for last 30 days
			    'filter_period' => 'week', // show only transactions for this week
			    'continuous_time' => true, // show continuous timeline including dates without data
		    ];
		    $chart5 = new LaravelChart($chart_options);

		    // Pie chart
		    $chart_options = [
			    'chart_title' => __('account.chart_title_6'),
			    'chart_type' => 'pie',
			    'report_type' => 'group_by_date',
			    'model' => 'App\Models\Configurations',

			    'group_by_field' => 'created_at',
			    'group_by_period' => 'day',
			    
			    'filter_field' => 'v_site_url',
			    'filter_days' => 30, // show only transactions for last 30 days
			    'filter_period' => 'week', // show only transactions for this week
			    'continuous_time' => true, // show continuous timeline including dates without data
		    ];
		    $chart6 = new LaravelChart($chart_options);

		    return view('statistics.index', compact('chart1', 'chart2', 'chart3', 'chart4', 'chart5', 'chart6'));
		} else {
			return view('layouts.app');
		}
	}

}
