<?php
require_once('Shape.php');

/**
 * Class for defining Triangle shape model. Extends from Shape.php.
 *
 * The coordinates for a Triangle are it's vertices coordinates (Xn,Yn).
 * The formula for calculating a Triangle area is a=sqrt(S*(S-mod(SIDE1))*(S-mod(SIDE2))*(S-mod(SIDE3)))
 * been
 * - S		semiperimeter
 * - SIDEn	n side of triangle
 * 
 * @author Enrique Worwa <eworwa@gmail.com>
 *
 * @version 1.0
 *
 * @var double	$x1	vertice 1 X coordinate
 * @var double	$y1	vertice 1 Y coordinate
 * @var double	$x2	vertice 2 X coordinate
 * @var double	$y2	vertice 2 Y coordinate
 * @var double	$x3	vertice 3 X coordinate
 * @var double	$y3	vertice 3 Y coordinate
 *
 */
class Triangle extends Shape{

	private $x1=0;
	private $y1=0;
	private $x2=0;
	private $y2=0;
	private $x3=0;
	private $y3=0;
	
	function Triangle($coordinates){
		$this->name="Triangle";
		$this->argsAmount=6;
		
		$this->preProcessCoords($coordinates);
		if(count($this->coords)==$this->argsAmount){
			$this->x1=$this->coords[0];
			$this->y1=$this->coords[1];
			$this->x2=$this->coords[2];
			$this->y2=$this->coords[3];
			$this->x3=$this->coords[4];
			$this->y3=$this->coords[5];
		
			$this->area=round($this->calculateArea(),2);
		}
		
		$this->msg=$this->getResultMessage();
	}
	
	public function calculateArea(){
		// first we must calculate the semiperimeter
		$a=$this->modLine($this->x1, $this->y1, $this->x2, $this->y2);
		$b=$this->modLine($this->x2, $this->y2, $this->x3, $this->y3);
		$c=$this->modLine($this->x3, $this->y3, $this->x1, $this->y1);
		$p=($a+$b+$c)/2;
		
		return sqrt($p*($p-$a)*($p-$b)*($p-$c));
	}
	
	public function getResultMessage(){
		$msg="Triangle with vertices at (".$this->x1.",".$this->y1."),(".$this->x2.",".$this->y2."),(".$this->x3.",".$this->y3."). ";
		$msg.="Area ".$this->area.".";
		return $msg;
	}
}
?>
