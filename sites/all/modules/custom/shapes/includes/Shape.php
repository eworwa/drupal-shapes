<?php
/**
 * Abstract Class for defining Shape model.
 *
 * @author Enrique Worwa <eworwa@gmail.com>
 *
 * @version 1.0
 *
 * @var double[]	$coords			array containing shape coordinates
 * @var string		$name			shape name
 * @var double		$area			shape calculated area
 * @var string		$msg			shape result message
 * @var integer		$argsAmount		valid amount of arguments for the current shape
 */
abstract class Shape{
	protected $coords;
	protected $name;
	protected $area;
	protected $msg;
	public $argsAmount;
	
	/**
	 * Functiong for calculating the area for current shape
	 */
	abstract protected function calculateArea();
	
	/**
	 * Function for retrieving the result message for current shape
	 */
	abstract protected function getResultMessage();
	
	/**
	 * Function for processing coordinates in string format into array
	 */
	protected function preProcessCoords($coordinates){
		$this->coords=trim($coordinates);
		$this->coords=preg_replace('/\s+/',' ',$coordinates);
		$this->coords=explode(" ",$this->coords);
	}
	
	/**
	 * Function for calculating the mod of a line
	 */
	protected function modLine($x1, $y1, $x2, $y2){
		$mod=pow(($x2-$x1),2)+pow(($y2-$y1),2);
		$mod=sqrt($mod);
		return $mod;
	}
	
	/**
	 * Function for recording a new shape record into DB
	 */
	public function saveRecord($shape=0){
		$record=array(
			'shape_n_value' => $shape,
			'shape_t_value' => $this->name,
			'coordinates' => implode(" ", $this->coords),
			'area' => $this->area,
		);
		drupal_write_record('shapes', $record);
	}
	
	/**
	 * Function for validate given arguments of a shape
	 */
	public function validateArgs(){
		$msg="";
		
		// validate that all arguments are numbers
		foreach($this->coords as $num){
			$num=trim($num);
			if(!is_numeric($num)){
				$msg.="<li>".$num." is not a valid number.</li>";
			}
		}

		// validate the right amount of arguments
		if(count($this->coords)<=1){
			$msg.="<li>You must introduce at least two parameters.</li>";
		}else if(count($this->coords)!=$this->argsAmount){
			$msg.="<li>You must introduce the right number of parameters. ";
			$msg.="For ".$this->name." the right amount of parameters is ".$this->argsAmount."</li>";
		}
		
		return $msg;
	}
	
	/**
	 * Function for listing the differents shapes stored in DB
	 */
	public static function listStoredShapes(){
		$header = array(
			array('data' => 'Shape'),
			array('data' => 'Coordinates'),
			array('data' => 'Area', 'field' => 'type', 'sort' => 'asc'),
			);

		$result = db_select('shapes', 's')
			->fields('s',array(
				'shape_t_value',
				'coordinates',
				'area',
				))
			->execute();
		$rows=array();
		
		foreach ($result as $record){
			$rows[]=array($record->shape_t_value,$record->coordinates,$record->area);
		}
		
		$table=array('header' => $header, 'rows' => $rows);
		
		return theme('table', 
			array(
				'header' => $header,
				'rows'=>$rows,
				'empty' => 'No records stored...',
			)
		);
	}
}
?>
