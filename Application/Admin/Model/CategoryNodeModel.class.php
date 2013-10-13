<?php
namespace Admin\Model;
/**
 * 
 */
class CategoryNodeModel {
	
	public $hasChild     = false;
	
	public $categoryId   = '';
	
	public $categoryName = '';
	
	public $status       = 0;
	
	public $depth        = 0;

	public $childs       = array();
	

}