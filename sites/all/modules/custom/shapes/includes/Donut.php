<?php
require_once('Shape.php');

/**
 * Class for defining Donut shape model. Extends from Shape.php.
 *
 * The coordinates for a Donut are it's center (X,Y), it's inner 
 * radius r1 and it's outer radius r2.
 * The formula for calculating a Donut area is a=(PI*r2^2) - (PI*r1^2).
 * 
 * @author Enrique Worwa <eworwa@gmail.com>
 *
 * @version 1.0
 *
 * @var double	$x	donut center X coordinate
 * @var double	$y	donut center Y coordinate
 * @var double	$r1	donut inner radius
 * @var double	$r2	donut outer radius
 *
 */
class Donut extends Shape{

	private $x=0;
	private $y=0;
	private $r1=0;
	private $r2=0;
	
	function Donut($coordinates){
		$this->name="Donut";
		$this->argsAmount=4;
		
		$this->preProcessCoords($coordinates);
		if(count($this->coords)==$this->argsAmount){
			$this->x=$this->coords[0];
			$this->y=$this->coords[1];
		
			// we ensure r1 to be the inner radius and r2 the outer one
			if($this->coords[2]<$this->coords[3]){
				$this->r1=$this->coords[2];
				$this->r2=$this->coords[3];
			}else{
				$this->r1=$this->coords[3];
				$this->r2=$this->coords[2];
			}
			$this->area=round($this->calculateArea(),2);
		}
		
		$this->msg=$this->getResultMessage();
	}
	
	public function calculateArea(){
		$innerArea=M_PI*pow(floatval($this->r1),2);
		$outerArea=M_PI*pow(floatval($this->r2),2);
		return abs($outerArea-$innerArea);
	}
	
	public function getResultMessage(){
		$msg="Donut with center at (".$this->x.",".$this->y.") and inner radius ".$this->r1." and outer radius ".$this->r2.". ";
		$msg.="Area ".$this->area.".";
		return $msg;
	}
}
?>
