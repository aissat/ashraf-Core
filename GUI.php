<?php
//LOCATION OF THIS FILE : begin/view/visual_items.
//Definition Of The Element Used In The Interface.
/**
 * 
 **/
class GUI
{

	public $type='';
	public $name='';
	public $placeholder='';
	public $value='';

	
	function __construct()
	{
		// . . . 
	}
	// ::TEXT EDIT :: Choose the TYPE and the NAME of the textField # THIS is obligation.
	public function lineEdit($name,$type,$placeholder=NULL,$id=NULL,$value=NULL)
	{
		$this->name=$name;
		$this->type=$type;
		$this->placeholder=$placeholder;
		$this->value=$value;
		return '<input name="'.$this->name.'" type="'.$this->type.'" placeholder="'.$this->placeholder.'" value="'.$this->value.'" id="'.$id.'"/>';
	}

	public function textArea($name,$type,$placeholder=NULL,$id=NULL,$value=NULL)
	{
		$this->name=$name;
		$this->type=$type;
		$this->placeholder=$placeholder;
		$this->value=$value;
		if($value === NULL)
			return '<textarea name="'.$this->name.'" type="'.$this->type.'" placeholder="'.$this->placeholder.'" id="'.$id.'"></textarea>';
		else
			return '<textarea name="'.$this->name.'" type="'.$this->type.'" placeholder="'.$this->placeholder.'" id="'.$id.'">'.$this->value.'</textarea>';
	}
	// give the list of the element to display.
	public function comboBox($name,array $list,$id=NULL)
	{
		$list = (array)$list;
		$var=NULL;

		for($i=1; $i<=count($list); $i++){
			$var = $var.'<option value="'.$i.'" >'.$list[$i-1].'</option>';
		}
		 return '<select name="'.$name.'" id="'.$id.'">'.$var.'</select>';
		 
	}
	/*just the NAME and the 
	// - and you can add more options like Id for (JavaScript).
	*/
	public function pushButton($value,$id=NULL)
	{
		return '<input type="submit" value="'.$value.'" id="'.$id.'" />';
	}

	// CheckBox .
	public function checkBox()
	{
		return 0;
	}

	// RadioButton.
	public function RadioButton()
	{
		return 0;
	}

	// widget : color, height, width, 
	public function div()
	{

	}


}
?>