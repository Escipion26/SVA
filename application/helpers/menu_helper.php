<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function  menu_categorias (){
	$html = "";

	$html .="<div class='panel-group category-products' id='accordian'><!--category-productsr-->
			<div class='panel panel-default'>
    			<div class='panel-heading'>
    				<h4 class='panel-title'>
    				<a data-toggle='collapse' data-parent='#accordian' href='#sportswear'>
    				<span class='badge pull-right'><i class='fa fa-plus'></i></span>Sportswear
					</a>
    				</h4>
    			</div>
    		<div id='sportswear' class='panel-collapse collapse'>
    			<div class='panel-body'>
    			<ul>
        			<li><a href='#''>Nike </a></li>
        			<li><a href='#''>Under Armour </a></li>
        			<li><a href='#''>Adidas </a></li>
        			<li><a href='#''>Puma</a></li>
        			<li><a href='#''>ASICS </a></li>
        			<li><a href='#''>lalala </a></li>
        			<li><a href='#''>lelelele </a></li>
    			</ul>
    		</div>
    		</div>
    		</div>
    		</div><!--/category-products-->";

    	return $html;	



}