<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Crawl;
use App\PortfolioStatistic;
use App\Metric;
use App\AnnualReturn;
use App\MonthlyReturn;
use App\TimingPeriod;
use App\DrawdownsTimingPortfolio;
use App\DrawdownsVanguard500IndexFund;
use App\DrawdownsEqualWeightPortfolio;
use Goutte;

class IndexController extends Controller
{
    public function index(Request $request){
    	if($request->isMethod('post')){    		
    		$this->validate($request, [
    			'name' => 'required',
    			'slug' => 'required|unique:types,slug',
    			'link' => 'required|unique:types,link',
    		]);
    		$data = $request->input();
    		Type::create($data);
    		return redirect(url()->current())->with('status', 'Added a new type successful!');
    	}
    	$data['types'] = Type::all();
    	return view('form.create_type', $data);
    }

    public function get_types(Request $request){
    	$result = Type::all();
    	if($result){
    		$data['result'] = $result->toArray();
    		$data['status'] = 'success';    		
    	}else{
    		$data['status'] = 'fail';
    	}
    	return response()->json($data, 200, array(), JSON_PRETTY_PRINT);
    }

    public function get_data($id, Request $request){
    	$result = Crawl::where('id', $id)->first();
    	if($result){
    		$result->type->toArray();    		
    		$data['result'] = $result->toArray();
    		$data['status'] = 'success';    		
    	}else{
    		$data['status'] = 'fail';
    	}
    	return response()->json($data, 200, array(), JSON_PRETTY_PRINT);
    }

    public function crawl_part($crawler, $part_id = ''){
    	$result = array();
    	$header = $crawler->filter($part_id . ' thead tr');
    	$rows = $crawler->filter($part_id . ' tbody tr');				
		$result['headers'] = $header->children()->extract(array('_text'));    			
	    $rows->each(function ($node) use(&$result) {			    	
	    	$result['rows'][] = $node->children()->extract(array('_text'));
	    });

	    return json_encode($result);
    }

    public function crawl_all($slug, Request $request){
    	$data['type'] = Type::where('slug', $slug)->first();
    	$type_id = $data['type']->id;
    	if($request->isMethod('post')){   
    		$input = $request->input();    		
    		$crawler = Goutte::request('GET', $data['type']->link);		
    		if(isset($input['crawl_all'])){    			
			    Crawl::where('type', $type_id)->delete();	
			    $crawl['type_id'] = $type_id;
			    $drawdowns = [
					'drawdowns_timing_portfolio',
					'drawdowns_equal_weight_portfolio',
					'drawdowns_vanguard_500_index_fund'
				];
				$table = $crawler->filter('#drawdowns table');
				$controller = $this;
				$table->each(function ($children, $i) use(&$crawl, $drawdowns, $controller){					
					$crawl[$drawdowns[$i]] = $this->crawl_part($children);
				});				
    			$crawl['portfolio_statistic'] = $this->crawl_part($crawler, '#statistics');
    			$crawl['metrics'] = $this->crawl_part($crawler, '#metrics');
    			$crawl['annual_returns'] = $this->crawl_part($crawler, '#yearlyReturns');
    			$crawl['monthly_returns'] = $this->crawl_part($crawler, '#monthlyReturns');
    			$crawl['timing_periods'] = $this->crawl_part($crawler, '#timingPeriods');
    			Crawl::create($crawl);
    			return redirect(url()->current())->with('status', 'Crawled data successful!');
    		}
    	}
    	$data['crawl'] = Crawl::where('type', $type_id)->first();
    	return view('form.crawl_all', $data);
    }

    public function crawl($slug, Request $request){
    	$data['type'] = Type::where('slug', $slug)->first();
    	$type_id = $data['type']->id;
    	$data['portfolio_statistic_keys'] = [
	        'portfolio', 
	        'initial_balance', 
	        'final_balance', 
	        'CAGR', 
	        'std_dev', 
	        'best_year', 
	        'worst_year', 
	        'max_drawdown', 
	        'sharpe_ratio', 
	        'sortino_ratio', 
	        'us_mkt_correlation', 
	        'type', 
	    ];
	    $data['metric_keys'] = [
	        'metric', 
	        'timing_model', 
	        'equal_weight_portfolio', 
	        'vanguard_500_index_fund', 
	        'type', 
	    ];
	    $data['annual_returns_keys'] = [
	        'year', 
	        'timing_return', 
	        'equal_weight_portfolio_return', 
	        'vanguard_500_index_fund_return', 
	        'VFINX', 
	        'VGTSX', 
	        'VEIEX', 
	        'VGSIX', 
	        'VGPMX', 
	        'VGENX', 
	        'VCVSX', 
	        'VWEHX', 
	        'VWAHX', 
	        'VFIIX', 
	        'VWESX', 
	        'VFISX', 
	        'VFITX', 
	        'VFICX', 
	        'VUSTX', 
	        'timing_balance', 
	        'equal_weight_portfolio_balance', 
	        'vanguard_500_index_fund_balance', 
	        'type', 
	    ];
	    $data['monthly_returns_keys'] = [
	        'year', 
	        'month', 
	        'timing_return', 
	        'equal_weight_portfolio_return', 
	        'vanguard_500_index_fund_return', 
	        'VFINX', 
	        'VGTSX', 
	        'VEIEX', 
	        'VGSIX', 
	        'VGPMX', 
	        'VGENX', 
	        'VCVSX', 
	        'VWEHX', 
	        'VWAHX', 
	        'VFIIX', 
	        'VWESX', 
	        'VFISX', 
	        'VFITX', 
	        'VFICX', 
	        'VUSTX', 
	        'timing_balance', 
	        'equal_weight_portfolio_balance', 
	        'vanguard_500_index_fund_balance', 
	        'type', 
	    ];
	    $data['drawdowns_keys'] = [
	        'rank', 	        
	        'drawdown_start', 
	        'drawdown_end', 
	        'drawdown_length', 
	        'recovery_by', 
	        'recovery_time', 
	        'drawdown', 
	        'type', 
	    ];/*
	    $data['drawdowns_equal_weight_portfolio_keys'] = [
	        'rank', 	        
	        'drawdown_start', 
	        'drawdown_end', 
	        'drawdown_length', 
	        'recovery_by', 
	        'recovery_time', 
	        'drawdown', 
	        'type', 
	    ];
	    $data['drawdowns_vanguard_500_index_fund_keys'] = [
	        'rank', 	        
	        'drawdown_start', 
	        'drawdown_end', 
	        'drawdown_length', 
	        'recovery_by', 
	        'recovery_time', 
	        'drawdown', 
	        'type', 
	    ];*/
	    $data['timing_periods_keys'] = [
	        'start', 	        
	        'end', 
	        'months', 
	        'assets', 
	        'asset_performance', 
	        'timing_portfolio', 
	        'equal_weight_portfolio', 
	        'vanguard_500_index_fund', 
	        'type', 
	    ];
    	if($request->isMethod('post')){   
    		$input = $request->input();    		
    		$crawler = Goutte::request('GET', $data['type']->link);		
    		if(isset($input['portfolio_statistics']) || isset($input['crawl_all'])){
			    $children = $crawler->filter('#statistics tbody tr');
			    PortfolioStatistic::where('type', $type_id)->delete();
			    $children->each(function ($node) use ($data, $type_id) {
			    	$child_data = $node->children()->extract(array('_text'));
			    	$child_data[] = $type_id;		    	
				    $row = array_combine($data['portfolio_statistic_keys'], $child_data);
			    	PortfolioStatistic::create($row);
			    });
			}
			if(isset($input['metrics']) || isset($input['crawl_all'])){
				$children = $crawler->filter('#metrics tbody tr');		
				Metric::where('type', $type_id)->delete();    
			    $children->each(function ($node) use ($data, $type_id) {
			    	$child_data = $node->children()->extract(array('_text'));
			    	$child_data[] = $type_id;		    	
				    $row = array_combine($data['metric_keys'], $child_data);
			    	Metric::create($row);
			    });
    		}
    		
    		if(isset($input['annual_returns']) || isset($input['crawl_all'])){
				$children = $crawler->filter('#yearlyReturns tbody tr');		
				AnnualReturn::where('type', $type_id)->delete();    				
			    $children->each(function ($node) use ($data, $type_id) {
			    	$child_data = $node->children()->extract(array('_text'));
			    	$child_data[] = $type_id;			    	
				    $row = array_combine($data['annual_returns_keys'], $child_data);
			    	AnnualReturn::create($row);
			    });
    		}

    		if(isset($input['monthly_returns']) || isset($input['crawl_all'])){
				$children = $crawler->filter('#monthlyReturns tbody tr');		
				MonthlyReturn::where('type', $type_id)->delete();    				
			    $children->each(function ($node) use ($data, $type_id) {
			    	$child_data = $node->children()->extract(array('_text'));
			    	$child_data[] = $type_id;		    	
				    $row = array_combine($data['monthly_returns_keys'], $child_data);
			    	MonthlyReturn::create($row);
			    });
    		}

    		if(isset($input['drawdowns']) || isset($input['crawl_all'])){
				$table = $crawler->filter('#drawdowns table');		
				DrawdownsTimingPortfolio::where('type', $type_id)->delete();    	
				DrawdownsVanguard500IndexFund::where('type', $type_id)->delete();    	
				DrawdownsEqualWeightPortfolio::where('type', $type_id)->delete();    	
				$drawdowns = [
					0 => new DrawdownsTimingPortfolio,
					1 => new DrawdownsEqualWeightPortfolio,
					2 => new DrawdownsVanguard500IndexFund,
				];
				$table->each(function ($children, $i) use($data, $type_id, $drawdowns){					
					$children = $children->filter('tbody tr');
					$model = $drawdowns[$i];
				    $children->each(function ($node) use ($data, $type_id, $model) {
				    	$child_data = $node->children()->extract(array('_text'));				    	
				    	$child_data[] = $type_id;
					    $row = array_combine($data['drawdowns_keys'], $child_data);
				    	$model::create($row);
				    });
				});
    		}

    		if(isset($input['timing_periods']) || isset($input['crawl_all'])){
				$children = $crawler->filter('#timingPeriods tbody tr');		
				TimingPeriod::where('type', $type_id)->delete();    				
			    $children->each(function ($node) use ($data, $type_id) {
			    	$child_data = $node->children()->extract(array('_text'));
			    	$child_data[] = $type_id;
			    	unset($child_data[0]);
				    $row = array_combine($data['timing_periods_keys'], $child_data);
			    	TimingPeriod::create($row);
			    });
    		}
		    
    		return redirect(url()->current())->with('status', 'Crawled data successful!');
    	}    	
    	unset($data['portfolio_statistic_keys'][count($data['portfolio_statistic_keys']) - 1]);
    	unset($data['metric_keys'][count($data['metric_keys']) - 1]);
    	unset($data['annual_returns_keys'][count($data['annual_returns_keys']) - 1]);
    	unset($data['monthly_returns_keys'][count($data['monthly_returns_keys']) - 1]);
    	unset($data['timing_periods_keys'][count($data['timing_periods_keys']) - 1]);
    	unset($data['drawdowns_keys'][count($data['timing_periods_keys']) - 1]);
    	$data['portfolio_statistics'] = PortfolioStatistic::where('type', $type_id)->get()->toArray();
    	$data['metrics'] = Metric::where('type', $type_id)->get()->toArray();
    	$data['annual_returns'] = AnnualReturn::where('type', $type_id)->get()->toArray();
    	$data['monthly_returns'] = MonthlyReturn::where('type', $type_id)->get()->toArray();
    	$data['timing_periods'] = TimingPeriod::where('type', $type_id)->get()->toArray();
    	$data['drawdowns_timing_portfolio'] = DrawdownsTimingPortfolio::where('type', $type_id)->get()->toArray();
    	$data['drawdowns_equal_weight_portfolio'] = DrawdownsEqualWeightPortfolio::where('type', $type_id)->get()->toArray();
    	$data['drawdowns_vanguard_500_index_fund'] = DrawdownsVanguard500IndexFund::where('type', $type_id)->get()->toArray();
    	
    	return view('form.crawl', $data);
    }
}
