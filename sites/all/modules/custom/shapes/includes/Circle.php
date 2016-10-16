<?php
require_once('Shape.php');

/**
 * Class for defining Circle shape model. Extends from Shape.php.
 *
 * The coordinates for a Circla are it's center (X,Y) and it's radius r.
 * The formula for calculating a Circle area is a=PI*r^2.
 * 
 * @author Enrique Worwa <eworwa@gmail.com>
 *
 * @version 1.0
 *
 * @var double	$x	circle center X coordinate
 * @var double	$y	circle center Y coordinate
 * @var double	$r	circle radius
 *
 */
class Circle extends Shape{

	private $x=0;
	private $y=0;
	private $r=0;
	
	function Circle($coordinates){
		$this->name="Circle";
		$this->argsAmount=3;
		
		$this->preProcessCoords($coordinates);
		if(count($this->coords)==$this->argsAmount){
			$this->x=$this->coords[0];
			$this->y=$this->coords[1];
			$this->r=$this->coords[2];
		
			$this->area=round($this->calculateArea(),2);
		}
		
		$this->msg=$this->getResultMessage();
	}
	
	public function calculateArea(){
		return M_PI*pow(floatval($this->r),2);
	}
	
	public function getResultMessage(){
		$msg="Circle with center at (".$this->x.",".$this->y.") and radius ".$this->r.". Area ".$this->area.".";
		return $msg;
	}
}
?>
